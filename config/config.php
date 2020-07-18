<?php

define('MODULES', [
    'Application',
    'Customer',
]);

define('ROUTES', [

    'default' => [
        'module'     => 'Application',
        'controller' => 'index',
        'method'     => 'index',
        'layout'     => 'layout/mainLayout',
        'params'     => []
    ],

    'gaurd' => [
        'module'     => 'Application',
        'controller' => 'auth',
        'method'     => 'login',
        'layout'     => 'layout/authLayout',
        'params'     => []
    ],

    'allow' => [
        'Application/auth/register',
        'Application/auth/login',
        'Application/index/index',
        'Application/index/about',
    ]

]);

define('PUBLICS', [
    'img'   => 'http://localhost/diyHmvc/public/img',
    'css'   => 'http://localhost/diyHmvc/public/css',
    'js'    => 'http://localhost/diyHmvc/public/js',
    'url'   => 'http://localhost/diyHmvc',
]);

// define(
//     'DB',
//     [
//         'Application'   => [
//             'host'  => 'sql212.epizy.com',
//             'user'  => 'epiz_25382080',
//             'pass'  => 'svA30tq7mmVlB',
//             'dbname' => 'epiz_25382080_application',
//             'port'  => '3306',
//         ],
//         'Customer'      => [
//             'host'  => 'sql212.epizy.com',
//             'user'  => 'epiz_25382080',
//             'pass'  => 'svA30tq7mmVlB',
//             'dbname' => 'epiz_25382080_application',
//             'port'  => '3306',
//         ]
//     ]
// );

define('DB',
[
]);

define('ROOTS', 
[
    'app' => dirname(__DIR__),
    'img' => dirname(__DIR__) . '/public/img',
]);

// ALL GLOBAL VARIABLES
define('INFORMATION', [

    'config'    => [

        'module'    => MODULES,

        'vendors'   => include_once(ROOTS['app'] . '\vendor\composer\autoload_classmap.php'),

        'routes'    => ROUTES,

        'publics'   => PUBLICS,

        'roots'     => ROOTS,
    ],

    'author'    => [
        'group' => [
            'Web Architecture - Backend Developer'  => [
                'name'  => 'Đoàn Văn Thanh Liêm',
                'email' => 'liemdev18112000@gmail.com',
            ],
        ],
    ],

    'version'   => [
        'lastest' => 'HMVC Beta version 2'
    ],

    'auth' => [
        'cmd'   => [
            'access config',
            'access_config',
            'access-config'
        ],
        'key'   => [
            '$2y$12$4dCzv3LlJNpSfbpOr7shSeRXazicEFoaLi0AgyNTnlKYOMG96pQ3O'
        ]
    ]

]);

define('WEB_NAME', 'TokyoHealth');
