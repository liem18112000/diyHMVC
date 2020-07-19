<?php

// Name of the module
define('Application',
[
    // Sitename
    'sitename' => 'Application',

    // Controller - Make sure you must register Controllera
    'controllers' => [
        'IndexController',
        'AuthController'
    ],

    // Models - - Make sure you must register Models
    'models' => [
        'auth/User',
        'auth/SimpleUser',
    ],

    // !!! Route : under experiment
    'routes' => [
        
    ],

    // Path
    /**
     * URL must be declared 
     */
    'paths' => [
        'app'   => dirname(dirname(__FILE__)),
        'url'   => PUBLICS['url'] . '/Application',
    ],

    // Database Configuration
    'db' => [
        'host'      => isset(DB['Application']['host'])     ? DB['Application']['host']     : 'localhost',
        'user'      => isset(DB['Application']['user'])     ? DB['Application']['user']     : 'root',
        'pass'      => isset(DB['Application']['pass'])     ? DB['Application']['pass']     : '',
        'dbname'    => isset(DB['Application']['dbname'])   ? DB['Application']['dbname']   : 'application',
        'port'      => isset(DB['Application']['port'])     ? DB['Application']['port']     : '3306',
    ],
]);