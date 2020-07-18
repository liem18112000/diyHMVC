<?php

namespace Application\Model\Auth;

use Application\Model\Auth\User as User;

use Framework\Core\Database\MySQLI_DB as MySQLI_DB;

use Framework\Validator\Validator as Validator;

use Framework\Translator\SimpleTranslator as Translator;

class SimpleUser extends User{

    protected $hash;

    public function __construct($id, $username, $password, $email){
        parent::__construct($id, $username, $password, $email);
    }

    //--------------------------------- Ultilty methods ----------------------------------------

    public function isExist($db){

        return (MySQLI_DB::countRow(
            $db->query(
                "SELECT * FROM user WHERE username = '$this->username'"
            )
        ) > 0 );

    }

    public function validate($confirm_password){

        $validator = new Validator(6, 40);

        $_SESSION['register'] = true;

        if (!$validator->validate('username', $this->getUsername())) {
            $_SESSION['register'] = false;
            $_SESSION['msg'][] = '<h3>' . $validator->err_message['username'] . '</h3>';
        }

        if (!$validator->validate('password', $this->getPassword())) {
            $_SESSION['register'] = false;
            $_SESSION['msg'][] = '<h3>' . $validator->err_message['password'] . '</h3>';
        }

        if (!$validator->validate('email', $this->getEmail())) {
            $_SESSION['register'] = false;
            $_SESSION['msg'][] = '<h3>' . $validator->err_message['email'] . '</h3>';
        }

        if (!$validator->validate('confirm_password', $confirm_password)) {
            $_SESSION['register'] = false;
            $_SESSION['msg'][] = '<h3>' . $validator->err_message['confirm_password'] . '</h3>';
        }

        return $_SESSION['register'];

    }

    //--------------------------------- Ultilty methods ----------------------------------------

    //--------------------------------- Fundamental methods ----------------------------------------

    public function login($db){

        // Check exist
        if(!$this->isExist($db)){

            $_SESSION['msg'] = [
                '<h3>'.ucwords(Translator::translate(''.ucwords(Translator::translate('login failed')).'')).'!</h3>',
                '<h5>'.ucwords(Translator::translate('user is not existed')).'!</h5>',
            ];

            $_SESSION['msg_class'] = 'danger';

            return false;

        }

        // Get user data
        $user = MySQLI_DB::fetchAssoc($db->query("SELECT * FROM user WHERE username = '$this->username'"));

        // Password match
        if(!password_verify($this->password, $user['password'])){

            $_SESSION['msg'] = [
                '<h3>'.ucwords(Translator::translate('login failed')).'</h3>',
                '<h5>'.ucwords(Translator::translate('username or password is invalid')).'!</h5>'
            ];

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        // Set session variables
        $_SESSION['msg'] = [
            '<h3>'.ucwords(Translator::translate('login success')).'</h3>',
            '<h5>'. ucwords(Translator::translate('welcome back ')) . $this->username . '!</h5>'
        ];

        $_SESSION['msg_class'] = 'success';

        $_SESSION['login'] = true;

        $_SESSION['username'] = $this->username;

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['authority'] = $user['authority'];

        return true;

    }

    public function register($db, $confirm_password){

        // Check password
        if($confirm_password != $this->password){

            $_SESSION['msg'] = [
                '<h3>'.ucwords(Translator::translate('register failed')).'!</h3>',
                '<h5>'.ucwords(Translator::translate('confirm password not match')).'</h5>'
            ];

            $_SESSION['msg_class'] = 'danger';

            return false;
        }
        
        // Validate All Fields
        $check = $this->validate($confirm_password);

        if(!$check){

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        // Check user exist
        if($this->isExist($db)){

            $_SESSION['msg'] = [
                '<h3>'.ucwords(Translator::translate('register failed')).'!</h3>',
                '<h5>'.ucwords(Translator::translate('user is already existed')).'</h5>'
            ];

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        // Insert user
        if(!$db->query("INSERT INTO user(username, password, email) VALUES('$this->username', '$this->hash', '$this->email')")){

            $_SESSION['msg'] = [
                '<h3>'.ucwords(Translator::translate('register failed')).'!</h3>',
                '<h5>'.ucwords(Translator::translate('system error : add user failed')).'</h5>'
            ];

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'] = [
            '<h3>'.ucwords(Translator::translate('register success')).'!</h3>',
        ];

        $_SESSION['msg_class'] = 'success';

        return true;

    }

    public function logout(){

        unset($_SESSION['login']);

        $_SESSION['msg'] = [
            '<h3>'.ucwords(Translator::translate('logout success')).'</h3>'
        ];

        $_SESSION['msg_class'] = 'success';

        return true;

    }

    //--------------------------------- Fundamental methods ----------------------------------------
}


?>