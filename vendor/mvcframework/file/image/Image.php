<?php

namespace Framework\File;

class Image{
    public $ALLOW_EXT = [
        'jpg',
        'png',
        'jpeg',
        'gif',
        'bmp',
        'tif',
        'bmp'
    ];

    public $err_message = [];

    public $name, $ext, $size, $tmp_name;

    public function __construct($data){
        $this->separateNameExt($data['name']);

        if($this->checkSize($data['size']))
            $this->size = $data['size'];
        else
            $this->err_message[] = 'File size must be less than 100 MB';

        if($this->checkTmp($data['tmp_name']))
            $this->tmp_name = $data['tmp_name'];
        else
            $this->err_message[] = 'Tmp name is invalid or not existed';
    }

    protected function separateNameExt($name){
        $arr = explode('.', $name);

        if($this->checkExt($arr[count($arr) - 1]))
            $this->ext  = $arr[count($arr) - 1];
        else
            $this->err_message[] = 'File extension is invalid';

        array_pop($arr);

        $this->name = implode('.', $arr);

        if($this->name == null){
            $this->name = 'untitled';
        }
    }

    protected function checkExt($ext) {
        return in_array($ext,$this->ALLOW_EXT);
    }

    protected function checkSize($size){
        return $size < 100000000; // 100 MB
    }

    protected function checkTmp($tmp){
        return file_exists($tmp);
    }

}


?>