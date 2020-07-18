<?php

namespace Customer\Controller;

use Framework\Core\Controller\AbstractController as AbstractController;
use Framework\Core\Database\MySQLI_DB as MySQLI_DB;
use Framework\Core\Registry\Registry as Registry;
use Framework\Exception\ExceptionHandler as ExceptionHandler;

class VisualizeController extends AbstractController{

    protected $db;

    public function __construct()
    {

        Registry::setInstance('Customer/VisualizeController', $this);

        $this->db = new MySQLI_DB(Customer['db']['user'], Customer['db']['pass'], Customer['db']['dbname'], Customer['db']['host']);

        $this->db->connectDatabase();
    }

    private function setTimezone($format)
    {
        $from = new \DateTimeZone('GMT');
        $to   = new \DateTimeZone('Asia/Ho_Chi_Minh');
        $currDate     = new \DateTime('now', $from);
        $currDate->setTimezone($to);
        return $currDate->format($format);
    }

    public function dataByMonth($month){

        if(isset($_POST['apply'])){
            $month = $_POST['month'];
        }

        // Query data
        $stm = "SELECT cs.date AS Date, SUM(cost) AS Revenue, COUNT(*) AS NumberOfCustomer

                FROM customer_service AS cs ";

        if($month == 'current'){

            $stm .= "WHERE MONTH(cs.date) = MONTH(CURDATE()) ";

        }else{

            $stm .= "WHERE MONTH(cs.date) = '$month' ";

        }
        
        $stm .= "GROUP BY cs.date ";

        $rows = MySQLI_DB::fetchAll($this->db->query($stm));

        // Prepare data
        $revenuesByMonth = [];

        $numberOfCustomersByMonth = [];

        foreach($rows as $row){
            $revenuesByMonth[] = [
                "y"     => $row['Revenue'], 
                "label" => $row['Date'],
            ];
            $numberOfCustomersByMonth[] = [
                "y"     => $row['NumberOfCustomer'],
                "label" => $row['Date'],
            ];  
        }

        // Bind data
        $data = [
            'revenue'   => $revenuesByMonth,
            'customer'  => $numberOfCustomersByMonth,
        ];

        $this->view('visualize/dataByMonth', 'layout/mainLayout', 'Customer', $data);

    }

    public function dataByYear($year){

        if (isset($_POST['apply'])) {
            $year = $_POST['year'];
        }

        // Query data
        $stm = "SELECT MONTH(cs.date) AS Month, SUM(cost) AS Revenue, COUNT(*) AS NumberOfCustomer

                FROM customer_service AS cs ";

        if($year == 'current'){
            $stm .= "WHERE YEAR(cs.date) = YEAR(CURDATE()) ";
        }else{
            $stm .= "WHERE YEAR(cs.date) = '$year' ";
        }
                
        $stm .= "GROUP BY MONTH(cs.date) ";

        $rows = MySQLI_DB::fetchAll($this->db->query($stm));

        // Prepare data
        $revenuesByMonth = [];

        $numberOfCustomersByMonth = [];

        foreach($rows as $row){
            
            $revenuesByMonth[] = [
                "y"     => $row['Revenue'], 
                "label" => 'Tháng ' . $row['Month'],
            ];
            $numberOfCustomersByMonth[] = [
                "y"     => $row['NumberOfCustomer'],
                "label" => 'Tháng ' . $row['Month'],
            ];  
        }

        // Bind data
        $data = [
            'revenue'   => $revenuesByMonth,
            'customer'  => $numberOfCustomersByMonth,
        ];

        $this->view('visualize/dataByYear', 'layout/mainLayout', 'Customer', $data);

    }

    public function dataOverall(){

        // Query data
        $stm = "SELECT YEAR(cs.date) AS Year, SUM(cost) AS Revenue, COUNT(*) AS NumberOfCustomer

                FROM customer_service AS cs
                
                GROUP BY YEAR(cs.date)";

        $rows = MySQLI_DB::fetchAll($this->db->query($stm));

        // Prepare data
        $revenuesByMonth = [];

        $numberOfCustomersByMonth = [];

        foreach($rows as $row){

            $revenuesByMonth[] = [
                "y"     => $row['Revenue'], 
                "label" => 'Năm ' . $row['Year'],
            ];
            $numberOfCustomersByMonth[] = [
                "y"     => $row['NumberOfCustomer'],
                "label" => 'Năm ' . $row['Year'],
            ];  
        }

        // Bind data
        $data = [
            'revenue'   => $revenuesByMonth,
            'customer'  => $numberOfCustomersByMonth,
        ];

        $this->view('visualize/dataOverall', 'layout/mainLayout', 'Customer', $data);
    }
}