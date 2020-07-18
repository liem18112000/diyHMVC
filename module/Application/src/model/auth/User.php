<?php

namespace Application\Model\Auth;

abstract class User{

    protected $id, $username, $hash, $password, $email;

    public function __construct($id, $username, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->hash = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getHash(){
        return $this->hash;
    }

    // Fundamental methods

    abstract public function login($db);

    abstract public function register($db, $user);

    abstract public function logout();
}

?>