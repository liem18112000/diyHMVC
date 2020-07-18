<?php

namespace Framework\Core\Controller;

use Framework\Core\View\View as View;

abstract class AbstractController
{
    protected $defautController = 'User';
    protected $defautMethod = 'login';

    public function model($model)
    {
        //require model file
        require_once '../app/model/' . $model . '.php';
        return new $model();
    }

    //load viewport
    public function view($view, $layout = null, $module = null, $data = [])
    {
        $viewModel = new View([
            'module'    => $module,
            'layout'    => $layout,
            'view'      => $view,
            'data'      => $data
        ]);

        $viewModel->getView();
    }
}
