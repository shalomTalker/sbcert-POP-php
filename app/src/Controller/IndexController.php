<?php

namespace Tutorial\Controller;

use Pop\Application;
use Pop\Controller\AbstractController;
use Pop\Http\Request;
use Pop\Http\Response;
use Pop\View\View;
use Tutorial\Form;
use Tutorial\Model;

class IndexController extends AbstractController
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

     public function error()
    {
        $view = new View($this->mainView);
        $view->title = 'Error - Page Not Found';
        $view->contentName = 'error';

        $this->response->setBody($view->render());
        $this->response->send(404);
    }
   

}
