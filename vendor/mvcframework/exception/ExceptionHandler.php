<?php

namespace Framework\Exception;

class ExceptionHandler{

    static private $exception = null;

    public static function throwException($msg){

        self::$exception =  new \Exception($msg);

        self::showExcpetion();

        self::$exception = null;
    }

    public static function showExcpetion()
    {
        ob_clean();

        require_once('view\exception.php');
    }
}