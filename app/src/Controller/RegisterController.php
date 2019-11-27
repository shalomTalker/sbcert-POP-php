<?php

namespace Tutorial\Controller;

use Pop\Application;
use Pop\Controller\AbstractController;
use Pop\Http\Request;
use Pop\Http\Response;
use Pop\View\View;
use Tutorial\Form;
use Tutorial\Model;


class RegisterController extends AbstractController
{
    protected $application;
    protected $request;
    protected $response;
    protected $mainView;

    public function __construct(Application $application, Request $request, Response $response)
    {
        $this->application = $application;
        $this->request = $request;
        $this->response = $response;
        $this->mainView = __DIR__ . '/../../view/index.phtml';
    }

    public function register()
    {
        $view = new View($this->mainView);

        $view->title = 'please complete your details';
        $view->contentName = 'register';
        $view->reserved = TRUE;

        if ($this->request->isGet()) {
            $token = $this->request->getQuery('token');

            if ($token) {
                $user_id = Model\Token::getUserId($token);
                if ($user_id) {
                    $view->reserved = FALSE;
                    $user = Model\User::getById($user_id);

                    $view->form = new Form\Register();
                    $view->form->generateDynamicText($user->type);
                }
            }
        }
        elseif ($this->request->isPost()) {
            $view->reserved = FALSE;

            $view->form = new Form\Register();
            $view->form->setFieldValues($this->request->getPost());

            if ($view->form->isValid()) {
                $view->form->clearFilters();

                $token = $this->request->getQuery('token');

                if ($token) {
                    $user_id = Model\Token::getUserId($token);
                    if ($user_id) {
                        $user = new Model\User();
                        $user->save($view->form, $user_id);
                        $user_type = Model\User::getById($user_id)->type;

                        $view->form->generateDynamicText($user_type);
                    }
                }
            }
        }

        $this->response->setBody($view->render());
        $this->response->send();
    }

}