<?php

return [
    'routes'   => [
        '/admin' => [
            'controller' => 'Tutorial\Controller\AdminController',
            'action'     => 'admin'
        ],
        '/register' => [
            'controller' => 'Tutorial\Controller\RegisterController',
            'action'     => 'register'
        ],
        '*' => [
            'controller' => 'Tutorial\Controller\IndexController',
            'action'     => 'error'
        ]
    ],
    'services' => [
        'database' => [
            'call'   => 'Pop\Db\Db::connect',
            'params' => [
                'adapter' => 'MySQL',
                'options' => [
                    'database' => 'sbcert',
                    'username' => 'root',
                    'password' => '',
                    'host' => 'localhost',                ]
            ]
        ]
    ]
];