<?php

namespace Framework\Core\Database;

abstract class Database
{
    protected $username, $password, $host, $database;

    public $con;

    public function __construct($username, $password, $host, $database)
    {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->database = $database;
        $this->connectDatabase();
    }

    abstract public function connectDatabase();

    abstract public function query($stm);

    abstract static public function encode($arr, $type);

    abstract static public function decode($arr, $type);

    abstract static public function fetchAll($result);

    abstract static public function fetchAssoc($result);

    abstract static public function countRow($result);

}
