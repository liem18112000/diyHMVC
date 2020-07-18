<?php

namespace Framework\File;

class ImageUpload{

    protected $db;
    protected $image;
    public $new_name;
    public $authoe;

    public function __construct($db, $image, $author){

        $this->db = $db;
        $this->db->connectDatabase();
        $this->image = $image;
        $this->author = $author;
    }

    public function makeDir($dir){
        if (!is_dir($dir)) {
            return mkdir($dir);
        }

        return false;
    }

    public function moveImage($sub = null){

        $this->makeDir(ROOTS['img'] . '/user/' . $this->author);

        $new_name = '';

        if($sub == null){

            $this->makeDir(ROOTS['img'] . '/user/' . $this->author);

            $new_name = ROOTS['img'] . '/user/' . $this->author . '/' . uniqid('upload', true) . '.' . $this->image->ext;

        }
            
        else{

            $this->makeDir(ROOTS['img'] . '/user/' . $this->author . '/' . $sub . '/');

            $new_name = ROOTS['img'] . '/user/' . $this->author . '/' . $sub . '/' . uniqid('upload', true) . '.' . $this->image->ext;

        }
            
        $this->new_name = $new_name;

        return move_uploaded_file($this->image->tmp_name, $new_name);
    }


}
