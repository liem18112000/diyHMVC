<?php

namespace Framework\Form;

class Form{

    protected $allowedAttributes = [
        'formName',
        'component',
        'method',
        'action',
        'inputWrapperClass',
        'inputClass',
        'validator'
    ];

    protected $flag = false;

    public $formName = 'form';

    public $component = [];

    public $method = 'POST';

    public $acion = '';

    public $inputWrapperClass = 'form-group';

    public $inputClass  = 'form-control';

    public $validator = '';

    public function __construct($array = []){

        if(!is_array($array) && !is_object($array)){

            throw new \Exception('Invalid input in Form Class');

            return;

        }

        foreach($array as $key => $value){

            if(in_array($key, $this->allowedAttributes)){

                if(is_array($value) || is_object($value)){

                    foreach($value as $itemKey => $itemValue)

                        $this->$key[$itemKey] = $itemValue;
                    
                }else{

                    $this->$key = $value;

                }

                $this->flag = true;
                
            }else{

                throw new \Exception("'$key' is not existed in allowed attributes");

            }
            
        }

    }

    public function generateForm(){

        if(!$this->flag){

            throw new \Exception('Form is not initialized!');

            return null;

        }

        $form = "<form action=$this->action method=$this->method enctype='multipart/form-data' roloe='form'>";

        foreach ($this->component as $key => $value) {

            $form .= "<div class='$this->inputWrapperClass'>";

            $form .= "<label for=" . strtolower($value['name']) . ">" . ucwords($key) . "</label>";

            

                switch ($value['type']) {

                    case 'select':

                        $form .= "<select class='$this->inputClass' 
                            name='" . strtolower($value['name']) . "' required='".$value['require']."'>";

                        foreach ($value['rows'] as $rowKey => $rowValue) {

                            $form .= "<option value='$rowValue' selected>$rowKey</option>";

                        }

                        $form .= "</select>";
                    break;

                    case 'textarea':

                        $form .= "<textarea class='$this->inputClass' name='" . strtolower($value['name']) . "' 
                            required='" . $value['require'] . "' rows='" . $value['rows'] . "'>".$value['value']."</textarea>";

                    break;

                    default:
                        $form .= "<input type='" . strtolower($value['type']) . "' name='" . strtolower($value['name']) .
                        "' class = '$this->inputClass' required='".$value['require'] ."' value='" . $value['value'] . 
                        "' placeholder = '" . ucwords($value['holder']) . "...'>";
                    break;
                }

           
                
            

            $form .= "</div>";

        }

        $form .= $this->validator;

        $form .= "<button type='submit' class='btn btn-success btn-block' name='$this->formName'>".ucwords($this->formName)."</button>";

        $form .= '</form>';

        return $form;
    }


}