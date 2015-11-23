<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 8:21 PM
 */

namespace pnaika\finals;

require_once 'IGPSInterface.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/model/Employee.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/model/Customer.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/model/Payment.php';

class SqliteRepository implements IGPSInterface
{
    private $dbFile = 'gps_db_pdo.sqlite';
    private $db;

    public function __construct(){
        $this->db = new \PDO('sqlite:' . $this->dbFile);

        $this->db-> exec("CREATE TABLE IF NOT EXISTS Customer (
            id	INTEGER PRIMARY KEY AUTOINCREMENT,
            customerName	TEXT,
            password TEXT,
            email	TEXT,
            phoneNumber	TEXT,
            lastUpdate	TEXT,
            address	TEXT,
            userType	TEXT DEFAULT 'customer'
        )");

        $this->db-> exec("CREATE TABLE IF NOT EXISTS Employee (
            empId	INTEGER PRIMARY KEY AUTOINCREMENT,
            employeeName	TEXT,
            password TEXT,
            empEmail	TEXT,
            empPhoneNumber	TEXT,
            empLastUpdate	TEXT,
            empAddress	TEXT,
            userType	TEXT DEFAULT 'employee'
        )");

        $this->db-> exec("CREATE TABLE IF NOT EXISTS Payment (
            paymentId	INTEGER PRIMARY KEY AUTOINCREMENT,
            paymentAmount	INTEGER,
            paymentDate	TEXT,
            hours	INTEGER,
            customerId	INTEGER,
            FOREIGN KEY(customerId) REFERENCES Customer(id)
        )");

//        $this->db-> exec("INSERT INTO Customer ('customerName', 'password')
//            VALUES ('prashanth','password'
//        )");
    }

    public function getCustomerDetails($userName , $password){
        $stmh = $this->db->prepare("SELECT * from Customer WHERE customerName = :userName AND password = :password");
        $stmh->bindParam(':userName', $userName);
        $stmh->bindParam(':password', $password);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);

        if ($row = $stmh->fetch()) {
            $custDetails = new Customer();
            $custDetails->setId($row['id']);
            $custDetails->setCustomerName($row['customerName']);
            $custDetails->setEmail($row['email']);
            $custDetails->setPhoneNumber($row['phoneNumber']);
            $custDetails->setAddress($row['address']);
            $custDetails->setPassword($row['password']);
            return $custDetails;
        } else {
            return new Customer();
        }
    }

    public function getEmployeeDetails($userName , $password){
        $stmh = $this->db->prepare("SELECT * from Employee WHERE employeeName = :userName AND password = :password");
        $stmh->bindParam(':userName', $userName);
        $stmh->bindParam(':password', $password);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);
        if ($row = $stmh->fetch()) {
            $empDetails = new Employee();
            $empDetails->setEmpId($row['empId']);
            $empDetails->setEmployeeName($row['employeeName']);
            $empDetails->setEmpEmail($row['empEmail']);
            $empDetails->setEmpPhoneNumber($row['empPhoneNumber']);
            $empDetails->setEmpAddress($row['empAddress']);
            $empDetails->setPassword($row['password']);

            return $empDetails;
        } else {
            return new Employee();
        }
    }

    public function getCustomerById($custId){
        $stmh = $this->db->prepare("SELECT * from Customer WHERE id = :id");
        $sid = intval($custId);
        $stmh->bindParam(':id', $sid);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);

        if ($row = $stmh->fetch()) {
            $custDetails = new Customer();
            $custDetails->setId($row['id']);
            $custDetails->setCustomerName($row['customerName']);
            $custDetails->setEmail($row['email']);
            $custDetails->setPhoneNumber($row['phoneNumber']);
            $custDetails->setAddress($row['address']);
            $custDetails->setPassword($row['password']);
            return $custDetails;
        } else {
            return new Customer();
        }
    }

    public function savePayments($payment){
        if ($payment->getPaymentId() != '') {
            //Update
            $stmh = $this->db->prepare("UPDATE Payment SET
                  paymentAmount = :paymentAmount,
                  paymentDate = :paymentDate ,
                  hours = :hours ,
                  customerId= :customerId
                  WHERE paymentId = :id");
            $stmh->bindParam(':paymentAmount', $payment->getPaymentAmount());
            $stmh->bindParam(':paymentDate', $payment->getPaymentDate());
            $stmh->bindParam(':hours', $payment->getHours());
            $stmh->bindParam(':customerId', $payment->getCustomerId());
            $stmh->bindParam(':id', $payment->getPaymentId());
            $stmh->execute();
        } else {
            //Insert
            $stmh = $this->db->prepare("INSERT into Payment (paymentAmount, paymentDate, hours, customerId)
                  VALUES (:paymentAmount, :paymentDate, :hours,:customerId)");
            $stmh->bindParam(':paymentAmount', $payment->getPaymentAmount());
            $stmh->bindParam(':paymentDate', $payment->getPaymentDate());
            $stmh->bindParam(':hours', $payment->getHours());
            $stmh->bindParam(':customerId', $payment->getCustomerId());
            $stmh->execute();
        }

    }

}