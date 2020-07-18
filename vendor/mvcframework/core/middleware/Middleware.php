<?php
namespace Framework\Core;

use Framework\Core\Middleware\csrfPreventer as CSRFPreventer;
use Framework\Form\Form as Form;
use Framework\Translator\SimpleTranslator as Translator;

class Middleware{
    public function gaurdLogin($module, $view, $layout, $data){
        if ((!isset($_SESSION['login']) || !$_SESSION['login'])
            && !in_array($module . '/' . $view, ROUTES['allow'])
        ) {
            $view   = ROUTES['gaurd']['controller'] . '/' . ROUTES['gaurd']['method'];
            $layout = ROUTES['gaurd']['layout']; 
            $module = ROUTES['gaurd']['module'];
            $usernameText = Translator::translate('username');

            $passwordText = Translator::translate('password');

            $formName = ucwords(Translator::translate('login form'));

            $form = new Form([
                'action'        => Application['paths']['url'] . '/auth/login',
                'formName'      => 'login',
                'component'     => [
                    'username'      => [
                        'type'      => 'text',
                        'value'     => null,
                        'require'   => 'required',
                        'name'      => 'username',
                        'holder'    => $usernameText,
                    ],
                    'password'      => [
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
        
        return [
            'view' => $view,
            'layout' => $layout,
            'module' => $module,
            'data'  => $data
        ];
    }

}