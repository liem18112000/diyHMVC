<?php

namespace Application\Controller;

use Framework\Core\Controller\AbstractController    as AbstractController;
use Framework\Core\Database\MySQLI_DB               as MySQLI_DB;
use Framework\Form\Form                             as Form;
use Framework\Validator\Validator                   as Validator;
use Framework\Core\Middleware\csrfPreventer         as csrfPreventer;
use Framework\Core\Middleware\htmlXSS               as htmlXSS;
use Framework\Core\Registry\Registry                as Registry;
use Application\Model\Auth\SimpleUser               as SimpleUser;
use Framework\Translator\SimpleTranslator           as Translator;

class AuthController extends AbstractController
{

    protected $db;

    public function __construct(){

        Registry::setInstance('Application/AuthController', $this);

        $this->db = new MySQLI_DB(
            Application['db']['user'], 
            Application['db']['pass'], 
            Application['db']['dbname'], 
            Application['db']['host']
        );

        $this->db->connectDatabase();
    }

    //----------------------- Fundamental ------------------------

    public function login()
    {
        $data = [];

        if(isset($_SESSION['login'])){
            if($_SESSION['login']){
                header('Location: ' . PUBLICS['url']);
            }
        }

        if (isset($_POST[str_replace(" ", "_", Translator::translate('login'))])) {

            if(!csrfPreventer::csrfCheckForm()){
                unset($_POST[str_replace(" ", "_", Translator::translate('login'))]);
                $this->login();
                return;
            }

            $user = new SimpleUser(null, htmlXSS::purify($_POST['username'], ENT_QUOTES), $_POST['password'], null);

            if(!$user->login($this->db)){
                unset($_POST[str_replace(" ", "_", Translator::translate('login'))]);
                $this->login();
                return;

            }else{
                $this->view("index/index", 'layout/mainLayout', 'Application', $data);
                return ;
            }

        }else{

            $usernameText = Translator::translate('username');

            $passwordText = Translator::translate('password');

            $formName = ucwords(Translator::translate('login form'));
            
            $form = new Form([
                'action'        => Application['paths']['url'] . '/auth/login',
                'formName'      => Translator::translate('login'),
                'component'     => [
                    $usernameText      => [
                        'type'      => 'text',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'username',
                        'holder'    => $usernameText,
                    ],
                    $passwordText      => [
                        'type'      => 'password',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'password',
                        'holder'    => $passwordText,
                    ]
                ],
                'validator'      => '<input type="hidden" value="' . csrfPreventer::generateToken() . '" name="token">',

            ]);

            $data['form'] = $form->generateForm();

            $data['title'] = $formName;
        }

        $this->view("auth/login", 'layout/authLayout', 'Application', $data);
    }

    public function logout()
    {
        $user = new SimpleUser(null, null, null, null);

        if($user->logout()){

            $this->view("index/index", 'layout/mainLayout', 'Application', []);

        }
           
    }

    public function register()
    {
        $data = [];

        if(isset($_POST[str_replace(" ", "_", Translator::translate('sign up'))])){

            $_SESSION['msg'] = [];
            $_SESSION['register'] = true;

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST[str_replace(" ", "_", Translator::translate('sign up'))]);
                $this->register();
                return;
            }

            $user = new SimpleUser(
                null, 
                htmlXSS::purify($_POST['username'], ENT_QUOTES), 
                htmlXSS::purify($_POST['password'], ENT_QUOTES), 
                htmlXSS::purify($_POST['email'], ENT_QUOTES)
            );

            if(!$user->register($this->db, htmlXSS::purify($_POST['confirm_password'], ENT_QUOTES))){
                unset($_POST[str_replace(" ", "_", Translator::translate('sign up'))]);
                $this->register();
                return;
            }else{
                $this->login();
                return;
            }
            
        }else{
            
            $usernameText = Translator::translate('username');

            $passwordText = Translator::translate('password');

            $confirm_passwordText = Translator::translate('confirm_password');

            $emailText = Translator::translate('email');

            $formName =Translator::translate('sign up');

            $form = new Form([
                'action'        => Application['paths']['url'] . '/auth/register',
                'formName'      => $formName,
                'component'     => [
                    $usernameText      => [
                        'type'      => 'text',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'username',
                        'holder'    => $usernameText,
                    ],
                    $passwordText      => [
                        'type'      => 'password',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'password',
                        'holder'    => $passwordText,
                    ],
                    $confirm_passwordText  => [
                        'type'      => 'password',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'confirm_password',
                        'holder'    => $confirm_passwordText,
                    ],
                    $emailText             => [
                        'type'      => 'email',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'email',
                        'holder'    => $emailText,
                    ],
                ],
                'validator'      => '<input type="hidden" value="' . csrfPreventer::generateToken() . '" name="token">',

            ]);

            $data['form'] = $form->generateForm();

            $data['title'] = $formName;
        }

        $this->view('auth/register', 'layout/authLayout', 'Application', $data);
    }

    //----------------------- Fundamental --------------------------

}
