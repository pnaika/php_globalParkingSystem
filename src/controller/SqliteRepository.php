<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 8:21 PM
 */

namespace pnaika\finals;

require_once 'IGPSInterface.php';
require_once '../model/Employee.php';
require_once '../model/Customer.php';
require_once '../model/Payment.php';

class SqliteRepository
{
    private $dbFile = '../model/gps_db_pdo.sqlite';
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
    }

    public function getCustomerDetails($userName , $password){
        echo 'here' ;
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

}

$u = new SqliteRepository();