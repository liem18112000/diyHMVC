<?php

namespace Framework\Core\Registry;

use Framework\Exception\ExceptionHandler as ExceptionHandler;

class Registry{

    private static $__Instances;

    private function __construct(){

    }

    private function __clone(){

    }

    static public function isInstanceExist($name){
        return isset(self::$__Instances[$name]);
    }

    static public function getInstance($name){
        if(!self::isInstanceExist($name)){
            ExceptionHandler::throwException("Instace of '$name' is not found!");
            return;
        }
        return self::$__Instances['name'];
    }

    static public function setInstance($name, $value){
        if(self::isInstanceExist($name)){
            ExceptionHandler::throwException("Instace of '$name' is existed!");
            return;
        }

        self::updateInstance($name, $value);
    }

    static public function updateInstance($name, $value){
        self::$__Instances[$name] = $value;
    }

    static public function unsetInstance($name){
        if(!self::isInstanceExist($name)){
            unset(self::$__Instances[$name]);
        }
    }


}