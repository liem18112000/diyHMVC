<?php

namespace Framework\Core\View;

use Framework\Core\Middleware as Middleware;

class View
{
    public $layout;
    public $view;
    public $data = [];
    private $middleware;

    public function __construct(array $data)
    {
        $this->module   = isset($data['module'])    ? ucwords($data['module'])  : 'Application';
        $this->layout   = isset($data['layout'])    ? $data['layout']           : 'layout/mainLayout';
        $this->view     = isset($data['view'])      ? $data['view']             : 'index/index';
        $this->data     = isset($data['data'])      ? $data['data']             : [];
    }

    public function getView()
    {
        $viewFile = dirname(__FILE__, 5) . '/module/'.$this->module . '/view/' . $this->view . '.php';

        // check for view file
        if (file_exists($viewFile)) {

            // gaurd view
            $this->middleware = new Middleware();
            $gaurd = $this->middleware->gaurdLogin($this->module, $this->view, $this->layout, $this->data);

            // get view
            $this->module = $gaurd['module'];
            $this->view = $gaurd['view'];
            $this->layout = $gaurd['layout'];
            $this->data = $gaurd['data'];

            require_once(dirname(__FILE__, 5) . '/module/' . $this->module . '/view/' . $this->layout . '.php');

        }else{
            // Get back to default


        }
    }
}
