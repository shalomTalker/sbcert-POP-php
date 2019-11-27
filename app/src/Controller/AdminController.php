<?php

namespace Tutorial\Controller;

use Pop\Application;
use Pop\Controller\AbstractController;
use Pop\Filter\Filter;
use Pop\Http\Request;
use Pop\Http\Response;
use Pop\View\View;
use Tutorial\Form;
use Tutorial\Model;

class AdminController extends AbstractController
{

    protected $application;
    protected $request;
    protected $response;
    protected $mainView;

    public function __construct(Application $application, Request $request, Response $response)
    {
        $this->application = $application;
        $this->request     = $request;
        $this->response    = $response;
        $this->mainView = __DIR__ . '/../../view/index.phtml';
    }

    public function admin()
    {
        $user = new Model\User();

        $view = new View($this->mainView);
        $view->title = 'Welcome';
        $view->contentName = 'admin';
        $formData = new Form\Admin();
        $view->form =$formData;

        if ($this->request->isPost()) {
            $view->form->addFilter(new Filter('strip_tags'))
                    ->addFilter(new Filter('htmlentities', [ENT_QUOTES, 'UTF-8']))
                    ->setFieldValues($this->request->getPost());

            if ($view->form->isValid()) {
                $view->form->clearFilters()
                        ->addFilter(new Filter('html_entity_decode', [ENT_QUOTES, 'UTF-8']));

                $user = new Model\User();
                $user_id = $user->save($view->form);
                if ($user_id) {
                    $token = new Model\Token($view->form['email']);
                    $view->token = $token->save($user_id);
                }
            }
        }else {
            $view->token = '';
        }

        $this->response->setBody($view->render());
        $this->response->send();
    }


   

}
