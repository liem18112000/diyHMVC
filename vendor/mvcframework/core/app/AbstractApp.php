<?php

namespace Framework\Core\App;

abstract class AbstractApp implements AppInterface{

    protected $currentModule;
    protected $currentController;
    protected $currentMethod;
    protected $params = [];

    public function operate($url){

        // Find Route
        $this->getRoute($this->analyseURL($url));
    }

    abstract public function analyseURL($url);

    abstract public function getRoute($url);

    abstract static public function getInstance();

    abstract static public function initialize();

    static public function getConfig($key){
        foreach(INFORMATION['auth']['key'] as $hash)
            if(password_verify($key, $hash))
                return INFORMATION;
        
        throw new \Exception('You are not authorized to access config information');
        return;
    }
    
}