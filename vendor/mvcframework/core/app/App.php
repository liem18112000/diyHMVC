<?php
/*
* App Class
* Creates URL and loads core Controller
* Url format - module/controller/method/params
*/

namespace Framework\Core\App;

use Framework\Core\App\AbstractApp as AbstractApp;
use Framework\Exception\ExceptionHandler as ExceptionHandler;
use Framework\Translator\SimpleTranslator as Translator;

class App extends AbstractApp
{
    static private $__Instance = null;

    protected function __construct()
    {
    }

    static public function getInstance()
    {

        if (self::$__Instance == null) {
            self::$__Instance = new self();
        }

        return self::$__Instance;
    }

    static public function initialize()
    {
        ob_start();
    }

    public function analyseURL($url)
    {
        if ($url != null) {
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
        }
        return $url;
    }

    public function getRoute($url)
    {

        if ($url == null) {

            // set module
            $this->currentModule = ucwords(ROUTES['default']['module']);

            // set controller
            $this->currentController = ucwords(ROUTES['default']['controller']) . 'Controller';

            // require controller
            require_once dirname(dirname(__FILE__), 4) . '/module/' .
                $this->currentModule . '/src/controller/' . $this->currentController . '.php';

            $className = "\\$this->currentModule\Controller\\$this->currentController";

            // instantiate controller
            $this->currentController = new $className;

            // set method
            $this->currentMethod = ROUTES['default']['method'];

            // set params
            $this->currentParams = ROUTES['default']['params'];

        }else{

            // Set module
            if (!isset($url[0]) || !in_array($url[0], MODULES) ) {
                $module = $url[0];
                ExceptionHandler::throwException("Module '$module' is not found!");
                return;
               
            }else{

                $this->currentModule = ucwords($url[0]);

            }

            $controllerFile = '';

            // Check controller
            if (isset($url[1])) {

                $controllerFile = dirname(dirname(__FILE__), 4) . '/module/' .
                    $this->currentModule . '/src/controller/' . ucwords($url[1]) . 'Controller' . '.php';

                //looks in app/controller to see if controller exists
                if (file_exists($controllerFile)) {

                    //if the contoller exists set to current controllers
                    $this->currentController = ucwords($url[1]) . 'Controller';

                } else {
                    $controller = $url[1];
                    ExceptionHandler::throwException("Controller '$controller' is not found!");
                    return;
                }
            } else {

                $controllerFile = dirname(dirname(__FILE__), 4) . '/module/' .
                    $this->currentModule . '/src/controller/' . ucwords($this->currentController) . 'Controller' . '.php';

                $this->currentController = ucwords($this->currentController) . 'Controller';
            }

            // require controller
            require_once($controllerFile);

            $className = "\\$this->currentModule\Controller\\$this->currentController";

            // instantiate controller
            $this->currentController = new $className;

            //check for second part of url
            if (isset($url[2])) {

                if (method_exists($this->currentController, $url[2])) {

                    $this->currentMethod = $url[2];

                } else {
                    $method = $url[2];
                    ExceptionHandler::throwException("Method '$method' is not found!");
                    return ;
                }
            }

            unset($url[0]);
            unset($url[1]);
            unset($url[2]);

            // get $params
            $this->params = $url ? array_values($url) : [];

        }

        // call back if array has $params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
}
