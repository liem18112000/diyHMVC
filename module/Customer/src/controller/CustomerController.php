<?php

namespace Customer\Controller;

use Framework\Core\Controller\AbstractController as AbstractController;
use Framework\Core\Database\MySQLI_DB as MySQLI_DB;
use Framework\Core\Registry\Registry as Registry;
use Framework\Core\Middleware\csrfPreventer as csrfPreventer;
use Framework\Form\Form AS Form;
use Framework\Core\Middleware\htmlXSS as htmlXSS;
use Framework\Exception\ExceptionHandler as ExceptionHandler;
use Framework\Translator\SimpleTranslator as Translator;
use Customer\Model\Customer as Customer;
use Customer\Model\Attendance as Attendance;


class CustomerController extends AbstractController
{

    protected $db;

    private function setTimezone($format){
        $from = new \DateTimeZone('GMT');
        $to   = new \DateTimeZone('Asia/Ho_Chi_Minh');
        $currDate     = new \DateTime('now', $from);
        $currDate->setTimezone($to);
        return $currDate->format($format);
    }

    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        Registry::setInstance('Customer/CustomerController', $this);

        $this->db = new MySQLI_DB(Customer['db']['user'], Customer['db']['pass'], Customer['db']['dbname'], Customer['db']['host']);

        $this->db->connectDatabase();
    }

    // ------------------- Customer ------------------

    public function addCustomer(){

        if($_SESSION['authority'] < 3){
            $_SESSION['msg'][] = '<h3>'.Translator::translate('Authority violation').'</h3>';
            $_SESSION['msg'][] = '<h5>'.Translator::translate('User is not allowed to carry out this operation').'</h5>';
            $_SESSION['msg_class'] = 'waring';
        }

        $data = [];

        if(isset($_POST[str_replace(" ", "_", Translator::translate('add customer'))])){

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST[Translator::translate('add customer')]);
                $this->addCustomer();
                return;
            }

            $customer = new Customer(
                htmlXSS::purify($_POST['name'], ENT_QUOTES),
                htmlXSS::purify($_POST['duration'], ENT_QUOTES),
                htmlXSS::purify($_POST['gender'], ENT_QUOTES),
                htmlXSS::purify($_POST['notes'], ENT_QUOTES),
                $this->db    
            );

            if($customer->addCustomer()){
                $this->getCustomers();
                return;
            }

        }

        $form = new Form([
            'action'        => Customer['paths']['url'] . '/customer/addCustomer',
            'formName'      => Translator::translate('add customer'),
            'component'     => [
                Translator::translate('name')      => [
                    'type'      => 'text',
                    'value'     => '',
                    'require'   => 'required',
                    'name'      => 'name',
                    'holder'    => Translator::translate('name'),
                ],
                Translator::translate('duration')       => [
                    'type'      => 'number',
                    'value'     => '',
                    'require'   => 'required',
                    'name'      => 'duration',
                    'holder'    => Translator::translate('duration'),
                ],
                Translator::translate('gender')    => [
                    'name' => 'gender',
                    'type' => 'select',
                    'rows' => [
                        'Other' => '3',
                        'Female'=> '2',
                        'Male'  => '1',
                    ],
                    'require'   => 'required'
                ],
                Translator::translate('notes')     => [
                    'type'      => 'textarea',
                    'value'     => null,
                    'require'   => 'required',
                    'rows'       => 4,
                    'name'      => 'notes',
                ],
            ],
            'validator'      => '<input type="hidden" value="' . csrfPreventer::generateToken() . '" name="token">',

        ]);

        $data['form'] = $form->generateForm();

        $this->view('customer/addCustomer', 'layout/mainLayout', 'Customer', $data);
    }

    public function getCustomers($offset = 0, $limit = 100){

        $customer = new Customer(null,null,null, null, $this->db);

        $_SESSION['query']['getCustomers'] = "SELECT * FROM customer";

        $data['customers'] = $customer->getCustomers($offset, $limit);

        $this->view('customer/getCustomers', 'layout/mainLayout', 'Customer', $data);

    }

    public function updateCustomer($id){

        if ($_SESSION['authority'] < 3) {
            $_SESSION['msg'][] = '<h3>' . Translator::translate('Authority violation') . '</h3>';
            $_SESSION['msg'][] = '<h5>' . Translator::translate('User is not allowed to carry out this operation') . '</h5>';
            $_SESSION['msg_class'] = 'warning';
            $this->view('index/index', 'layout/mainLayout', 'Application', []);
            return;
        }

        $data = [];

        if(isset($_POST[str_replace(" ", "_", Translator::translate('update customer'))])){

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST['update_customer']);
                $this->updateCustomer($id);
                return;
            }

            $customer = new Customer(
                htmlXSS::purify($_POST['name'], ENT_QUOTES),
                htmlXSS::purify($_POST['duration'], ENT_QUOTES),
                htmlXSS::purify($_POST['gender'], ENT_QUOTES),
                htmlXSS::purify($_POST['notes'], ENT_QUOTES),
                $this->db
            );

            if($customer->updateCustomer($id)){
                $this->getCustomers();
                return;
            }

        }

        $customer = new Customer(null, null, null, null, $this->db);

        $oldData = $customer->getCustomer($id);

        $form = new Form([
            'action'        => Customer['paths']['url'] . '/customer/updateCustomer/' . $id,
            'formName'      => Translator::translate('update customer'),
            'component'     => [
                Translator::translate('name')      => [
                    'type'      => 'text',
                    'value'     => $oldData['name'],
                    'require'   => 'required',
                    'name'      => 'name',
                    'holder'    => Translator::translate('name'),
                ],
                Translator::translate('duration')       => [
                    'type'      => 'number',
                    'value'     => $oldData['duration'],
                    'require'   => 'required',
                    'name'      => 'duration',
                    'holder'    => Translator::translate('duration'),
                ],
                Translator::translate('gender')    => [
                    'name' => 'gender',
                    'type' => 'select',
                    'rows' => [
                        'Other' => '3',
                        'Female' => '2',
                        'Male'  => '1',
                    ],
                    'require'   => 'required'
                ],
                Translator::translate('notes')     => [
                    'type'      => 'textarea',
                    'value'     => $oldData['notes'],
                    'require'   => 'required',
                    'rows'       => 4,
                    'name'      => 'notes',
                ],
            ],
            'validator'      => '<input type="hidden" value="' . csrfPreventer::generateToken() . '" name="token">',

        ]);

        $data['form'] = $form->generateForm();

        $this->view('customer/updateCustomer', 'layout/mainLayout', 'Customer', $data);

    }

    public function deleteCustomer(){

        if ($_SESSION['authority'] < 3) {
            $_SESSION['msg'][] = '<h3>' . Translator::translate('Authority violation') . '</h3>';
            $_SESSION['msg'][] = '<h5>' . Translator::translate('User is not allowed to carry out this operation') . '</h5>';
            $_SESSION['msg_class'] = 'warning';
            $this->view('index/index', 'layout/mainLayout', 'Application', []);
            return;
        }

        if (isset($_POST['delete_customer'])) {

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST['delete_customer']);
                $this->deleteCustomer();
                return;
            }

            $customer = new Customer(
                null,
                null,
                null,
                null,
                $this->db
            );

            if ($customer->deleteCustomer($_POST['customer_id'])) {
                $this->getCustomers();
                return;
            }
        }
    }

    public function search(){

        $data = [];

        $data['date'] = 'CURDATE()';

        if(isset($_POST['search'])){

            $customer = new Customer(null, null, null, null, $this->db);

            $data['customers'] = $customer->search($_POST['pattern'], $_POST['from']);

        }

        $this->view($_POST['request'], 'layout/mainLayout', 'Customer', $data);
    }


    // ------------------- Customer ------------------



    // ------------------- Attendance -------------------

    public function checkAttendance($date){

        if(isset($_POST['search-date'])){

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST['search-date']);
                $this->checkAttendance('current');
                return;
            }

            $date = $_POST['date'];
        }

        if($date == 'current'){
            $date = 'CURDATE()';
        }

        $stm =
            "SELECT DISTINCT c.id AS customer_id, c.name AS name, c.gender AS gender, age, LIST.Quantity
            FROM customer AS c
            LEFT JOIN (
                SELECT customer_id, COUNT(DATE) AS Quantity
                FROM customer_service
                GROUP BY customer_id
            ) AS LIST ON LIST.customer_id = c.id
            LEFT JOIN customer_service AS cs ON c.id = cs.customer_id
            WHERE cs.date IS NULL OR cs.date != $date
            ORDER BY LIST.Quantity DESC";

        $_SESSION['query']['checkAttendance'] = $stm;

        $data['customers'] = MySQLI_DB::fetchAll($this->db->query($stm));

        $data['date'] = $date;

        $this->view('customer/checkAttendance', 'layout/mainLayout', 'Customer', $data);

    }

    public function addAttendance(){

        if ($_SESSION['authority'] < 3) {
            $_SESSION['msg'][] = '<h3>' . Translator::translate('Authority violation') . '</h3>';
            $_SESSION['msg'][] = '<h5>' . Translator::translate('User is not allowed to carry out this operation') . '</h5>';
            $_SESSION['msg_class'] = 'warning';
            $this->view('index/index', 'layout/mainLayout', 'Application', []);
            return;
        }

        if (isset($_POST['add_attendance'])) {

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST['add_attendance']);
                $this->addAttendance();
                return;
            }

            $attendance = new Attendance(
                $_POST['customer_id'],
                $_POST['service_id'], 
                $_POST['date'],
                $_POST['duration'],
                $_POST['cost'],
                $this->db
            );

            $attendance->addAttendance();
            $this->checkAttendance('current');
            return;

        }

        ExceptionHandler::throwException("POST variable is not set!");
        return;
        
    }

    public function searchAttendance(){

        $data = [];

        if ($_POST['search']) {

            $attendance = new Attendance(null, null, null, null, null, $this->db);

            $data['customers'] = $attendance->search($_POST['pattern']);
        }

        $this->view('customer/checkAttendance', 'layout/mainLayout', 'Customer', $data);
    }

    public function getAttendances(){

        $attendance = new Attendance(null, null, null, null, null, $this->db);

        $data['pattern'] = isset($_POST['pattern']) ? $_POST['pattern'] : '';

        $stm = 
        "SELECT DISTINCT c.id AS customer_id, c.name AS name, c.gender AS gender, c.duration AS duration, cs.date AS date
                FROM customer AS c
                LEFT JOIN customer_service AS cs ON c.id = cs.customer_id
                WHERE cs.date IS NULL OR cs.date != CURDATE()";

        $_SESSION['query']['getAttendance'] = $stm;

        $data['dates'] = $attendance->getAttendances();

        $this->view('customer/getAttendances', 'layout/mainLayout', 'Customer', $data);
    }

    public function updateAttendance($customer_id, $service_id, $date){

        if ($_SESSION['authority'] < 3) {
            $_SESSION['msg'][] = '<h3>' . Translator::translate('Authority violation') . '</h3>';
            $_SESSION['msg'][] = '<h5>' . Translator::translate('User is not allowed to carry out this operation') . '</h5>';
            $_SESSION['msg_class'] = 'warning';
            $this->view('index/index', 'layout/mainLayout', 'Application', []);
            return;
        }

        $data = [];

        if (isset($_POST[str_replace(" ", "_", Translator::translate('update attendance'))])) {

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST[str_replace(" ", "_", Translator::translate('update attendance'))]);
                $this->updateAttendance($customer_id, $service_id, $date);
                return;
            }

            $attendance = new Attendance(
                htmlXSS::purify($customer_id, ENT_QUOTES),
                htmlXSS::purify($service_id, ENT_QUOTES),
                htmlXSS::purify($date, ENT_QUOTES),
                htmlXSS::purify($_POST['duration'], ENT_QUOTES),
                htmlXSS::purify($_POST['cost'], ENT_QUOTES),
                $this->db
            );

            if ($attendance->updateAttendance($customer_id, $service_id, $date)) {
                $this->getAttendances();
                return;
            }
        }

        $attendance = new Attendance(null, null, null, null, null, $this->db);

        $oldData = MySQLI_DB::fetchAssoc($this->db->query(
            "SELECT cs.cost AS cost, cs.date AS date, cs.duration AS duration, c.name AS name 
            FROM customer_service AS cs JOIN customer AS c ON c.id = cs.customer_id 
            WHERE cs.customer_id = '$customer_id' AND cs.service_id = '$service_id' AND cs.date = '$date'"
        ));

        $form = new Form([
            'action'        => Customer['paths']['url'] . '/customer/updateAttendance/' . $customer_id . '/' . $service_id . '/' . $date,
            'formName'      => Translator::translate('update attendance'),
            'component'     => [
                Translator::translate('name')      => [
                    'type'      => 'text',
                    'value'     => $oldData['name'],
                    'require'   => 'required',
                    'name'      => 'name',
                    'holder'    => Translator::translate('name'),
                ],
                Translator::translate('cost')      => [
                    'type'      => 'number',
                    'value'     => $oldData['cost'],
                    'require'   => 'required',
                    'name'      => 'cost',
                    'holder'    => Translator::translate('cost'),
                ],
                Translator::translate('duration')       => [
                    'type'      => 'number',
                    'value'     => $oldData['duration'],
                    'require'   => 'required',
                    'name'      => 'duration',
                    'holder'    => Translator::translate('duration'),
                ],
            ],
            'validator'      => '<input type="hidden" value="' . csrfPreventer::generateToken() . '" name="token">',

        ]);

        $data['form'] = $form->generateForm();

        $this->view('customer/updateAttendance', 'layout/mainLayout', 'Customer', $data);
    }

    public function deleteAttendance(){

        if ($_SESSION['authority'] < 3) {
            $_SESSION['msg'][] = '<h3>' . Translator::translate('Authority violation') . '</h3>';
            $_SESSION['msg'][] = '<h5>' . Translator::translate('User is not allowed to carry out this operation') . '</h5>';
            $_SESSION['msg_class'] = 'warning';
            $this->view('index/index', 'layout/mainLayout', 'Application', []);
            return;
        }

        if (isset($_POST['delete_attendance'])) {

            if (!csrfPreventer::csrfCheckForm()) {
                unset($_POST['delete_attendance']);
                $this->deleteCustomer();
                return;
            }

            $attendance = new Attendance(
                null,
                null,
                null,
                null,
                null,
                $this->db
            );

            $attendance->deleteAttendance($_POST['customer_id'], $_POST['service_id'], $_POST['date']);

            $this->getAttendances();
            return;
        }
    }

    // ------------------- Attendance -------------------
}
