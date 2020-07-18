<?php

// Name of th module
define('Customer',
[
    // Sitename
    'sitename' => 'Customer',

    // Controller - Make sure you must register Controllera
    'controllers' => [
        'IndexController',
    ],

    // Models - Make sure you must register Models
    'models' => [
        
    ],

    // Path
    /**
     * URL must be declared 
     */
    'paths' => [
        'app'   => dirname(dirname(__FILE__)),
        'url'   => PUBLICS['url'] . '/Customer',
    ],

    // Database Configuration
    'db' => [
        'host'      => isset(DB['Customer']['host'])    ? DB['Customer']['host']    : 'localhost',
        'user'      => isset(DB['Customer']['user'])    ? DB['Customer']['user']    : 'root',
        'pass'      => isset(DB['Customer']['pass'])    ? DB['Customer']['pass']    : '',
        'dbname'    => isset(DB['Customer']['dbname'])  ? DB['Customer']['dbname']  : 'application',
        'port'      => isset(DB['Customer']['port'])    ? DB['Customer']['port']    : '3306',
    ],
]);