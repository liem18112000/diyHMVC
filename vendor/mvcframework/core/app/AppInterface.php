<?php

namespace Framework\Core\App;

/**
 * AppInterface
 */

interface AppInterface{

    public function operate($url);

    public function analyseURL($url);

    public function getRoute($url);

    static public function getInstance();

    static public function getConfig($key); 

}
