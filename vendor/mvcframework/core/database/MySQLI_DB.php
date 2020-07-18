<?php

namespace Framework\Core\Database;

use Framework\Core\Database\Database as Database;

class MySQLI_DB extends Database
{

    protected $port, $socket;

    public function __construct($username, $password, $database, $host, $port = null, $socket = null)
    {
        parent::__construct($username, $password, $host, $database);
        $this->port = $port;
        $this->socket = $socket;
    }

    public function connectDatabase()
    {
        $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->database, $this->port, $this->socket);

        if (!$this->con) {
            echo '<h1>Database connect failed!</h1>';
            echo '<pre>';
            echo $this->con->connect_error();
            echo '</pre>';
        }
    }

    static public function encode($arr, $type){

        switch(strtolower($type)){
            
            case 'json':
                return json_encode($arr);
            break;

            case 'base64':
                return base64_encode($arr);
            break;

            default: 
                return $arr;
            break;
        }

    }

    static public function decode($arr, $type){

        switch (strtolower($type)) {

            case 'json':
                return json_decode($arr);
            break;

            case 'base64':
                return base64_decode($arr);
            break;

            default:
                return $arr;
                break;
        }
    }

    public function query($stm){
        return $this->con->query($stm);
    }

    public static function fetchAll($result){
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function fetchAssoc($result){
        return mysqli_fetch_assoc($result);
    }

    public static function countRow($result){
        return mysqli_num_rows($result);
    }

}
