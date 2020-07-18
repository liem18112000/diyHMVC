<?php

namespace Customer\Model;

use Framework\Core\Database\MySQLI_DB as Database;

use Framework\Translator\SimpleTranslator as Translator;

class Customer{

    protected $name, $age, $gender, $notes, $db;

    public function __construct($name, $age, $gender, $notes, $db){
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->notes = $notes;

        $this->db = $db;
    }

    // ------------------------------- Fundamental Methods--------------------------------------

    public function isExist(){
        return (Database::countRow($this->db->query("SELECT * FROM customer WHERE name = '$this->name'")) > 0);
    }

    public function addCustomer(){
        
        if($this->isExist()){

            $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer already exists').'</h3>';

            $_SESSION['msg_class'] = 'danger';

            return false;

        }

        if(!$this->db->query("INSERT INTO customer(name, age, gender, notes) VALUES('$this->name', '$this->age', '$this->gender', '$this->notes')")){

            $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer add failed').'</h3>';

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer add sucessfully').'</h3>';

        $_SESSION['msg_class'] = 'success';

        return true;

    }

    public function deleteCustomer($id){

        $stm = "DELETE FROM customer WHERE id = '$id'";

        if (!$this->db->query($stm)) {

            $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer delete failed').'</h3>';

            $_SESSION['msg'][] = '<h5>'.$stm.'</h5>';

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer delete sucessfully').'</h3>';

        $_SESSION['msg_class'] = 'success';

        return true;
    }

    public function updateCustomer($id){

        if (!$this->db->query("UPDATE customer SET name = '$this->name', age = '$this->age', gender = '$this->gender', notes = '$this->notes' WHERE id = '$id'")) {

            $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer update failed').'</h3>';

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'][] = '<h3>'. Translator::translate('Customer update sucessfully').'</h3>';

        $_SESSION['msg_class'] = 'success';

        return true;
    }

    public function getCustomer($id){
        return Database::fetchAssoc($this->db->query("SELECT * FROM customer WHERE id = '$id'"));
    }

    public function getCustomers($offset = 0, $limit = 100){
        return Database::fetchAll($this->db->query("SELECT * FROM customer LIMIT $limit OFFSET $offset"));
    }

    public function search($pattern, $from)
    {

        $stm = "SELECT * FROM ($from) AS fr WHERE fr.name LIKE '%$pattern%'";

        if (!$this->db->query($stm)) {
            $_SESSION['msg'][] = "<h3>There is no result</h3>";
            $_SESSION['msg_class'] = "warning";
            return null;
        }

        return Database::fetchAll($this->db->query($stm));
    }

    // ------------------------------- Fundamental Methods--------------------------------------



}