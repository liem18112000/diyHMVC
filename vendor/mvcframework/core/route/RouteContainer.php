<?php

namespace Framework\Core\Route;

use Framework\Exception\ExceptionHandler as ExceptionHandler;

use Framework\Core\Route\RouteContainerInterface as RouteContainerInterface;

use Framework\Core\Route\Route as Route;

class RouteContainer implements RouteContainerInterface
{
    static private $__Instance = null;

    static private $__listOfRoutes = [];

    protected function __construct()
    {
        unset(self::$__listOfRoutes);
    }

    static public function getInstance()
    {

        if (self::$__Instance == null) {
            self::$__Instance = new self();
        }

        return self::$__Instance;
    }

    static public function addRoute(Route $route)
    {
        if (!self::checkRoute($route->routeName))
        {
            self::$__listOfRoutes[$route->routeName] = $route;
        }
            
    }

    static public function removeRoute($routeName)
    {
        if(self::checkRoute($routeName))
        {
            unset(self::$__listOfRoutes[$routeName]);
        }
    }

    static public function getRoutes($name)
    {
        if (self::checkRoute($name)) 
        {
            return self::$__listOfRoutes[$name];
        }

        ExceptionHandler::throwException('Route "' . $name . '" not found');
    }

    static public function route($name, $params = [])
    {
        if (self::checkRoute($name)) 
        {
            return self::$__listOfRoutes[$name]->getURL();
        }

        ExceptionHandler::throwException('Route "' . $name . '" not found');
    }

    static public function checkRoute($name)
    {
        return array_key_exists($name, self::$__listOfRoutes);
    }
}