<?php

namespace Framework\Validator;

class Validator{
    private $min_length, $max_length;

    public $err_message = [];

    public function __construct($min_length, $max_length){
        $this->min_length = $min_length;
        $this->max_length = $max_length;
    }

    private function isExist($atr_name, $atr_value, $db){
        $result = $db->countRow('user', $atr_name, $atr_value);
        if($result> 0){
            $this->err_message["$atr_name"] = $atr_name . ' is exist';
            return true;
        }

        return false;
        
    }

    private function lengthCheck($atr_name, $atr_value){
        if (strlen($atr_value) > $this->max_length) {
            $this->err_message["$atr_name"] = $atr_name . ' is too long and must at most ' . $this->max_length . ' characters';
            return false;
        }


        if (strlen($atr_value) < $this->min_length) {
            $this->err_message["$atr_name"] = $atr_name . ' is too short and must at least ' . $this->min_length . ' characters';
            return false;
        }

        return true;
    }

    public function validate($atr_name, $atr_value, $db = null, $checkExist = false){

        $this->db = $db;

        $result = false;

        //Length Check
        $result = $this->lengthCheck($atr_name, $atr_value);

        //Check Exist
        if($checkExist)
            $result = $result && !$this->isExist($atr_name, $atr_value, $db);

        return $result;

    }
}


?>