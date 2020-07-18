<?php

namespace Customer\Model;

use Framework\Core\Database\MySQLI_DB as Database;
use Framework\Translator\SimpleTranslator as Translator;

class Attendance{

    protected $customer_id, $service_id, $date, $duration, $cost, $db;

    public function __construct($customer_id, $service_id, $date, $duration, $cost, $db)
    {
        $this->customer_id = $customer_id;
        $this->service_id = $service_id;
        $this->date = $date;
        $this->duration = $duration;
        $this->cost = $cost;

        $this->db = $db;
    }

    public function addAttendance(){

        $stm = "INSERT INTO customer_service(customer_id, service_id, date, duration, cost) 
            VALUES('$this->customer_id', '$this->service_id', '$this->date', '$this->duration', '$this->cost')";

        if (!$this->db->query($stm)) 
        {

            $_SESSION['msg'][] = '<h3>'. Translator::translate('Attendance add failed').'</h3>';

            $_SESSION['msg'][] = '<p>'.$stm.'</p>';

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'][] = '<h3>'. Translator::translate('Attendance add sucessfully').'</h3>';

        $_SESSION['msg_class'] = 'success';

        return true;
    }

    public function getAttendances(){

        $dates = "SELECT DISTINCT date FROM customer_service ORDER BY date DESC";

        $dates = Database::fetchAll($this->db->query($dates));

        return $dates;

    }

    public function getAttendance($customer_id, $service_id, $date){
        return 
        Database::fetchAssoc($this->db->query("SELECT * FROM customer_service WHERE customer_id = '$customer_id' AND service_id = '$service_id' AND date = '$date'"));
    }

    public function search($pattern){

        $from = "SELECT DISTINCT c.id AS customer_id, c.name AS name, c.gender AS gender, c.age AS age 
                FROM customer AS c
                LEFT JOIN customer_service AS cs ON c.id = cs.customer_id
                WHERE cs.date IS NULL OR cs.date != CURDATE()";

        $stm = "SELECT * FROM ($from) WHERE name LIKE '%$pattern%'";

        if (!$this->db->query($stm)) {
            $_SESSION['msg'][] = '<h3>'. Translator::translate('There is no result') .'</h3>';
            $_SESSION['msg_class'] = "warning";
        }

        return Database::fetchAll($this->db->query($stm));

    }

    public function updateAttendance(){

        $stm = "UPDATE customer_service SET duration='$this->duration', cost='$this->cost' 
            WHERE customer_id = '$this->customer_id' AND service_id = '$this->service_id' AND date='$this->date'";

        if (!$this->db->query($stm)) {

            $_SESSION['msg'][] = '<h3>' . Translator::translate('Attendance update failed') . '</h3>';

            $_SESSION['msg'][] = '<h5>' . $stm . '</h5>';

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'][] = '<h3>' . Translator::translate('Attendance update sucessfully') . '</h3>';

        $_SESSION['msg_class'] = 'success';

        return true;
    }

    public function deleteAttendance($customer_id, $service_id, $date){

        $stm = "DELETE FROM customer_service WHERE customer_id = '$customer_id' AND service_id = '$service_id' AND date = '$date'";

        if (!$this->db->query($stm)) {

            $_SESSION['msg'][] = '<h3>' . Translator::translate('Attendance delete failed') . '</h3>';

            $_SESSION['msg'][] = '<h5>' . $stm . '</h5>';

            $_SESSION['msg_class'] = 'danger';

            return false;
        }

        $_SESSION['msg'][] = '<h3>' . Translator::translate('Attedance delete sucessfully') . '</h3>';

        $_SESSION['msg_class'] = 'success';

        return true;
    }
}