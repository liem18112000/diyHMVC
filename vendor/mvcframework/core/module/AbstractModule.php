<?php

namespace Framework\Core\Module;

use Framework\Core\Module\ModuleInterface as ModuleInterface;

abstract class AbstractModule implements ModuleInterface{

    abstract public function getConfig();

}