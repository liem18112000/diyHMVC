<?php

namespace Application\Controller;

use Framework\Core\Controller\AbstractController    as AbstractController;
use Framework\Core\Database\MySQLI_DB               as MySQLI_DB;
use Framework\Core\Registry\Registry                as Registry;
use Framework\Exception\ExceptionHandler            as ExceptionHandler;
use Framework\Translator\SimpleTranslator           as Translator;

class IndexController extends AbstractController
{

    // ------------------- Fundamental ------------------

    protected $db;

    public function __construct()
    {

        Registry::setInstance('Application/IndexController', $this);

        $this->db = new MySQLI_DB(Application['db']['user'], Application['db']['pass'], Application['db']['dbname'], Application['db']['host']);

        $this->db->connectDatabase();

        if (!isset($_SESSION['language'])) {
            $_SESSION['language'] = 'vi';
            $_SESSION['language_img'] = PUBLICS['img'] . '/flags/vietnam.png';
            Translator::initTranslator(ROOTS['app'] . '/raw/tranlate/en-vi.php', 'en-vi');
        }
    }

    public function index()
    {
        $this->view("index/index", 'layout/mainLayout', 'Application',[]);
    }

    // ------------------- Fundamental ------------------

    public function language()
    {
        if (!isset($_SESSION['language'])) {
            $_SESSION['language'] = 'vi';
            $_SESSION['language_img'] = PUBLICS['img'] . '/flags/vietnam.png';
            Translator::initTranslator(ROOTS['app'] . '/raw/tranlate/en-vi.php', 'en-vi');
        }else{
            switch ($_POST['language']) {
                case 'en':
                    Translator::initTranslator(ROOTS['app'] . '/raw/tranlate/en-vi.php', 'en-vi');
                    $_SESSION['language'] = 'vi';
                    $_SESSION['language_img'] = PUBLICS['img'] . '/flags/vietnam.png';
                    break;

                case 'vi':
                    Translator::initTranslator(ROOTS['app'] . '/raw/tranlate/en-vi.php', 'origin');
                    $_SESSION['language'] = 'en';
                    $_SESSION['language_img'] = PUBLICS['img'] . '/flags/uk.png';
                    break;

                default:
                    ExceptionHandler::throwException('Unknown language!');
                    break;
            }
        }

        $link = isset($_POST['link']) ? $_POST['link'] : PUBLICS['url'];

        header('Location: ' . $link);
    }

}
