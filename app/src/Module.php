<?php

namespace Tutorial;

use Pop\Application;
use Pop\Console\Console;
use Pop\Db\Record;
use Pop\Http\Request;
use Pop\Http\Response;

class Module extends \Pop\Module\Module
{

    protected $name = 'tutorial';

    public function register(Application $application)
    {
        parent::register($application);

        if (!$this->application->router()->isCli()) {
            $this->application->router()->addControllerParams(
                '*', [
                    'application' => $this->application,
                    'request'     => new Request(),
                    'response'    => new Response()
                ]
            );
        } 

        $this->application->on('app.init', function($application){
            Record::setDb($application->services['database']);
        });
    }

}
