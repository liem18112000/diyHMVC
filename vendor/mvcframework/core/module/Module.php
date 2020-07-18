<?php

namespace Framework\Core\Module;

use Framework\Core\Module\AbstractModule as AbstractModule;

class Module extends AbstractModule{

    private $name;

    public function __construct($moduleName){

        // Initialize module
        $this->name = ucwords($moduleName);

        // Load Config
        $this->getConfig();

    }

    public function getModuleName(){
        return $this->name;
    }

    public function getConfig(){
        return include dirname(__DIR__, 4) . "/module/$this->name/config/module.config.php";
    }
}