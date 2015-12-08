<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 11:49 PM
 */

namespace pnaika\finals;


interface IGPSInterface
{
    public function getCustomerDetails($username , $password);
    public function getEmployeeDetails($username , $password);
    public function getAdminDetails($username , $password);
    public function getCustomerById($custId);
    public function savePayments($payment);
    public function getPaymentByCustId($custId);
    public function getPaymentById($payId);
    public function saveCustomer($customer);
    public function getAllPayments();
    public function saveEmployee($employee);
    public function getAllCustomers();
    public function getAllEmployees();
    public function deletePayment($paymentId);
    public function deleteEmployee($empId);
    public function deleteCustomer($custId);
}