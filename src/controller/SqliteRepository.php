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
require_once $_SERVER['DOCUMENT_ROOT'].'/src/model/Admin.php';

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

        $this->db-> exec("CREATE TABLE IF NOT EXISTS Admin (
            id	INTEGER PRIMARY KEY AUTOINCREMENT,
            adminUserName	TEXT,
            password TEXT,
            userType	TEXT DEFAULT 'admin'
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
        $stmh = $this->db->prepare("SELECT * from Customer WHERE customerName = :userName LIMIT 1");
        $stmh->bindParam(':userName', $userName);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);

        if ($row = $stmh->fetch()) {
            $custDetails = new Customer();
            $custDetails->setPassword($row['password']);
            $isValid = password_verify($password, $custDetails->getPassword());
            if($isValid){
                $custDetails->setId($row['id']);
                $custDetails->setCustomerName($row['customerName']);
                $custDetails->setEmail($row['email']);
                $custDetails->setPhoneNumber($row['phoneNumber']);
                $custDetails->setAddress($row['address']);
                $custDetails->setPassword($row['password']);
                $custDetails->setLastUpdate($row['lastUpdate']);
                return $custDetails;
            } else {
                return new Customer();
            }
        } else {
            return new Customer();
        }
    }

    public function getEmployeeDetails($userName , $password){
        $stmh = $this->db->prepare("SELECT * from Employee WHERE employeeName = :userName  LIMIT 1");
        $stmh->bindParam(':userName', $userName);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);
        if ($row = $stmh->fetch()) {
            $empDetails = new Employee();
            $empDetails->setPassword($row['password']);
            $isValid = password_verify($password, $empDetails->getPassword());
            if($isValid){
                $empDetails->setEmpId($row['empId']);
                $empDetails->setEmployeeName($row['employeeName']);
                $empDetails->setEmpEmail($row['empEmail']);
                $empDetails->setEmpPhoneNumber($row['empPhoneNumber']);
                $empDetails->setEmpAddress($row['empAddress']);
                $empDetails->setEmpLastUpdate($row['empLastUpdate']);
                return $empDetails;
            } else {
                return new Employee();
            }
        } else {
            return new Employee();
        }
    }

    public function getAdminDetails($userName , $password){
        $stmh = $this->db->prepare("SELECT * from Admin WHERE adminUserName = :userName AND password = :password");
        $stmh->bindParam(':userName', $userName);
        $stmh->bindParam(':password', $password);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);
        if ($row = $stmh->fetch()) {
            $adminDetails = new Admin();
            $adminDetails->setAdminUserName($row['adminUserName']);
            $adminDetails->setId($row['id']);
            $adminDetails->setPassword($row['password']);
            return $adminDetails;
        } else {
            return new Admin();
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
            $custDetails->setLastUpdate($row['lastUpdate']);
            return $custDetails;
        } else {
            return new Customer();
        }
    }

    public function getEmployeeById($empId){
        $stmh = $this->db->prepare("SELECT * from Employee WHERE empId = :id");
        $sid = intval($empId);
        $stmh->bindParam(':id', $sid);
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
            $empDetails->setEmpLastUpdate($row['empLastUpdate']);
            return $empDetails;
        } else {
            return new Employee();
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

    public function getPaymentByCustId($custId)
    {
        $paymentList = array();
        $result = $this->db->prepare('SELECT * FROM Payment WHERE customerId = :custId');
        $sid = intval($custId);
        $result->bindParam(':custId', $sid);
        $result->execute();
        foreach($result as $row) {
            $paymentData = new Payment();
            $paymentData->setPaymentDate($row['paymentDate']);
            $paymentData->setHours($row['hours']);
            $paymentData->setPaymentId($row['paymentId']);
            $paymentData->setPaymentAmount($row['paymentAmount']);
            $paymentData->setCustomerId($row['customerId']);
            $paymentList[$paymentData->getPaymentId()] = $paymentData;
        }
        return $paymentList;
    }

    public function getAllPayments()
    {
        $paymentList = array();
        $result = $this->db->query('SELECT * FROM Payment');
        foreach($result as $row) {
            $paymentData = new Payment();
            $paymentData->setPaymentDate($row['paymentDate']);
            $paymentData->setHours($row['hours']);
            $paymentData->setPaymentId($row['paymentId']);
            $paymentData->setPaymentAmount($row['paymentAmount']);
            $paymentData->setCustomerId($row['customerId']);
            $paymentList[$paymentData->getPaymentId()] = $paymentData;
        }
        return $paymentList;
    }

    public function getAllEmployees()
    {
        $employeeList = array();
        $result = $this->db->query('SELECT * FROM Employee');
        foreach($result as $row) {
            $empDetails = new Employee();
            $empDetails->setEmpId($row['empId']);
            $empDetails->setEmployeeName($row['employeeName']);
            $empDetails->setEmpEmail($row['empEmail']);
            $empDetails->setEmpPhoneNumber($row['empPhoneNumber']);
            $empDetails->setEmpAddress($row['empAddress']);
            $empDetails->setPassword($row['password']);
            $empDetails->setEmpLastUpdate($row['empLastUpdate']);
            $employeeList[$empDetails->getEmpId()] = $empDetails;
        }
        return $employeeList;
    }

    public function getAllCustomers()
    {
        $customerList = array();
        $result = $this->db->query('SELECT * FROM Customer');
        foreach($result as $row) {
            $custDetails = new Customer();
            $custDetails->setId($row['id']);
            $custDetails->setCustomerName($row['customerName']);
            $custDetails->setEmail($row['email']);
            $custDetails->setPhoneNumber($row['phoneNumber']);
            $custDetails->setAddress($row['address']);
            $custDetails->setPassword($row['password']);
            $custDetails->setLastUpdate($row['lastUpdate']);
            $customerList[$custDetails->getId()] = $custDetails;
        }
        return $customerList;
    }

    public function getPaymentById($payId){
        $stmh = $this->db->prepare("SELECT * from Payment WHERE paymentId = :id");
        $sid = intval($payId);
        $stmh->bindParam(':id', $sid);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);

        if ($row = $stmh->fetch()) {
            $paymentData = new Payment();
            $paymentData->setPaymentDate($row['paymentDate']);
            $paymentData->setHours($row['hours']);
            $paymentData->setPaymentId($row['paymentId']);
            $paymentData->setPaymentAmount($row['paymentAmount']);
            $paymentData->setCustomerId($row['customerId']);
            return $paymentData;
        } else {
            return new Payment();
        }
    }

    public function saveCustomer($customer){
        if ($customer->getId() != '') {
            //Update
            $stmh = $this->db->prepare("UPDATE Customer SET
                                        customerName = :customerName,
                                        email = :email ,
                                        phoneNumber = :phoneNumber ,
                                        address= :address ,
                                        password = :password ,
                                        lastUpdate = :lastUpdate
                                        WHERE Id = :id");
            $stmh->bindParam(':customerName', $customer->getCustomerName());
            $stmh->bindParam(':email', $customer->getEmail());
            $stmh->bindParam(':phoneNumber', $customer->getPhoneNumber());
            $stmh->bindParam(':address', $customer->getAddress());
            $stmh->bindParam(':password', $customer->getPassword());
            $stmh->bindParam(':lastUpdate', $customer->getLastUpdate());
            $stmh->bindParam(':id', $customer->getId());
            $stmh->execute();
        } else {
            //Insert
            $stmh = $this->db->prepare("INSERT into Customer (customerName, email, phoneNumber, address, password, lastUpdate) values
                                        (:customerName, :email, :phoneNumber,:address , :password, :lastUpdate)");
            $stmh->bindParam(':customerName', $customer->getCustomerName());
            $stmh->bindParam(':email', $customer->getEmail());
            $stmh->bindParam(':phoneNumber', $customer->getPhoneNumber());
            $stmh->bindParam(':address', $customer->getAddress());
            $stmh->bindParam(':password', $customer->getPassword());
            $stmh->bindParam(':lastUpdate', $customer->getLastUpdate());
            $stmh->execute();
        }
    }

    public function saveEmployee($employee){
        if ($employee->getEmpId() != '') {
            //Update
            $stmh = $this->db->prepare("UPDATE Employee SET
                                        employeeName = :employeeName,
                                        empEmail = :empEmail ,
                                        empPhoneNumber = :empPhoneNumber ,
                                        empAddress= :empAddress ,
                                        password = :password ,
                                        empLastUpdate = :empLastUpdate
                                        WHERE empId = :empId");
            $stmh->bindParam(':employeeName', $employee->getEmployeeName());
            $stmh->bindParam(':empEmail', $employee->getEmpEmail());
            $stmh->bindParam(':empPhoneNumber', $employee->getEmpPhoneNumber());
            $stmh->bindParam(':empAddress', $employee->getEmpAddress());
            $stmh->bindParam(':password', $employee->getPassword());
            $stmh->bindParam(':empLastUpdate', $employee->getEmpLastUpdate());
            $stmh->bindParam(':empId', $employee->getEmpId());
            $stmh->execute();
        } else {
            //Insert
            $stmh = $this->db->prepare("INSERT into Employee (employeeName, empEmail, empPhoneNumber, empAddress, password, empLastUpdate) values
                                        (:employeeName, :empEmail, :empPhoneNumber,:empAddress , :password, :empLastUpdate)");
            $stmh->bindParam(':employeeName', $employee->getEmployeeName());
            $stmh->bindParam(':empEmail', $employee->getEmpEmail());
            $stmh->bindParam(':empPhoneNumber', $employee->getEmpPhoneNumber());
            $stmh->bindParam(':empAddress', $employee->getEmpAddress());
            $stmh->bindParam(':password', $employee->getPassword());
            $stmh->bindParam(':empLastUpdate', $employee->getEmpLastUpdate());
            $stmh->execute();
        }
    }

    public function deletePayment($paymentId){
        $stmh = $this->db->prepare("DELETE FROM Payment WHERE paymentId = :paymentId");
        $stmh->bindParam(':paymentId', intval($paymentId));
        $stmh->execute();

    }

    public function deleteEmployee($empId){
        $stmh = $this->db->prepare("DELETE FROM Employee WHERE empId = :empId");
        $stmh->bindParam(':empId', intval($empId));
        $stmh->execute();
    }

    public function deleteCustomer($custId){
        $stmh = $this->db->prepare("DELETE FROM Payment WHERE customerId = :custId");
        $stmh->bindParam(':custId', intval($custId));
        $stmh->execute();
        $stmh = $this->db->prepare("DELETE FROM Customer WHERE id = :custId");
        $stmh->bindParam(':custId', intval($custId));
        $stmh->execute();
    }


}