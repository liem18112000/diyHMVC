<?php

namespace Framework\Core\Middleware;

class csrfPreventer
{

    // Genrate Token
    static public function generateToken()
    {

        $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);

        return  password_hash($_SESSION['token'], PASSWORD_DEFAULT);
        
    }

    // Validate Token
    static public function validateToken($tokenValue)
    {
        if (isset($_SESSION['token'])) {

            if (password_verify($_SESSION['token'], $tokenValue)) {

                return true;

            }
        }

        return false;
    }


    static public function csrfCheckForm(){

        if (isset($_POST['token'])) {

            if (!csrfPreventer::validateToken($_POST['token'])){

                $_SESSION['msg'] = [

                    '<h3>CSRF Token is invalid!</h3>',

                    "<h5>You must leave page for your own sake</h5>",
                ];

                $_SESSION['msg_class'] = 'danger';

                return false;

            }

        }else{

            $_SESSION['msg'] = [

                "<h3><b>This section is not protected by CSRF Preventer</b></h3>",

                "<h5>You must leave this page for your own sake</h5>",
            ];

            $_SESSION['msg_class'] = 'warning';

            return false;
        }

        return true;

    }
}
