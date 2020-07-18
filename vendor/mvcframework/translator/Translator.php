<?php

namespace Framework\Translator;

use Framework\Exception\ExceptionHandler as ExceptionHandler;

class SimpleTranslator
{
    static private $TYPE = [
        'en-vi',
        'fr-vi',
        'jp-vi',
        'origin',
    ];

    private function __construct(){}

    private function __clone(){}

    static public function isValidTranslateType($type)
    {
        return in_array($type, self::$TYPE);
    }

    static public function initTranslator($tranlateFile, $type = 'vi')
    {
        $_SESSION['translator']['language'] = $type;

        if($_SESSION['translator']['language'] == 'origin'){
            return true;
        }

        if (!file_exists($tranlateFile)) {
            ExceptionHandler::throwException("File '$tranlateFile' is not found!");
            return false;
        }

        if (!self::isValidTranslateType($type)) {
            ExceptionHandler::throwException("'$type' is invalid!");
            return false;
        }

        $arr = explode('-', trim($type));

        // en

        $_SESSION['translator']['translated'] = strtolower($arr[0]);

        // vi

        $_SESSION['translator']['translating'] = strtolower($arr[1]);

        $fileSource = include_once($tranlateFile);

        $_SESSION['translator']['fileSource'] = $fileSource['source'];

        return true;
    }

    static public function translate($inputs)
    {
        if($_SESSION['translator']['language'] == 'origin'){

            return $inputs;

        }

        $result = $inputs;

        if($inputs == null){

            return $result;

        }

        foreach ((array)$_SESSION['translator']['fileSource'] as $translatedText) {

            if(is_array($inputs)){

                $result = [];

                foreach ($inputs as $key => $text) {

                    if (strtolower($text) == strtolower($translatedText[$_SESSION['translator']['translated']])) {

                        $result[] = [
                            $key => $translatedText[$_SESSION['translator']['translating']],
                        ];
                    }
                }

            }else{

                if (strtolower($inputs) == strtolower($translatedText[$_SESSION['translator']['translated']])) {

                    return $translatedText[$_SESSION['translator']['translating']];

                }
            }
        }

        return $result;
    }
}
