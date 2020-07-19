<?php

namespace Framework\Core\Route;

use Framework\Exception\ExceptionHandler as ExceptionHandler;

/**
 * Route
 */

class Route
{
    public $routeName = null;
    protected $module;
    protected $controller;
    protected $action;
    protected $params = [];
    protected $constrains = [];

    public function __construct($module, $controller, $action, $params = [], $constrains = [])
    {
        $this->module = $module;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->constrains = $constrains;
    }

    public function matchRouteName($routeName)
    {
        return $routeName == $this->routeName;
    }

    public function getURL($params = [])
    {
        if(count($params) == 0)
        {
            return PUBLICS['url'] . '/' . $this->routeName;
        }

        $url = PUBLICS['url'];

        foreach($params as $param)
        {
            $url .= '/' . $param;
        }

        return $url;
    }

    public function translateRoute()
    {
        $arr = [];
        $arr[] = $this->module;
        $arr[] = $this->controller;
        $arr[] = $this->action;
        $arr[] = $this->params;
        return $arr;
    }
}