<?php

namespace Framework\Core\Autoload;


class Autoloader{

    static public function initAutoloader(){

        return spl_autoload_register(__CLASS__ . '::autoload');
        
    }

    static public function autoload($class){

        $paths  = explode(PATH_SEPARATOR, get_include_path());

        $file   = strtolower(str_replace("\\", DIRECTORY_SEPARATOR, trim($class, "\\"))) . '.php';

        foreach($paths aS $path){

            $combined = $path.DIRECTORY_SEPARATOR.$file;

            if(file_exists($combined)){

                include($combined);

                return;

            }

        }

        throw new \Exception("{$class} Class not found");
    }
}

// Init Autoloader
Autoloader::initAutoloader();