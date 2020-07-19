<?php

namespace Framework\Core\Route;

use Framework\Core\Route\Route as Route;

/**
 * Route Container Interface
 */

interface RouteContainerInterface
{
    static public function addRoute(Route $route);

    static public function removeRoute($name);

    static public function getRoutes($name);

    static public function route($name, $params = []);

    static public function checkRoute($name);

}