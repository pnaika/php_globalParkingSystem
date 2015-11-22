<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 8:19 PM
 */

namespace pnaika\finals;


class Employee
{
    private $empId = '';
    private $employeeName = '';
    private $empEmail = '';
    private $empPhoneNumber = '';
    private $empLastUpdate = '';
    private $empAddress = '';
    private $password = '';

    /**
     * @return string
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    /**
     * @param string $empId
     */
    public function setEmpId($empId)
    {
        $this->empId = $empId;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * @return string
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * @param string $employeeName
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return string
     */
    public function getEmpEmail()
    {
        return $this->empEmail;
    }

    /**
     * @param string $empEmail
     */
    public function setEmpEmail($empEmail)
    {
        $this->empEmail = $empEmail;
    }

    /**
     * @return string
     */
    public function getEmpPhoneNumber()
    {
        return $this->empPhoneNumber;
    }

    /**
     * @param string $empPhoneNumber
     */
    public function setEmpPhoneNumber($empPhoneNumber)
    {
        $this->empPhoneNumber = $empPhoneNumber;
    }

    /**
     * @return string
     */
    public function getEmpLastUpdate()
    {
        return $this->empLastUpdate;
    }

    /**
     * @param string $empLastUpdate
     */
    public function setEmpLastUpdate($empLastUpdate)
    {
        $this->empLastUpdate = $empLastUpdate;
    }

    /**
     * @return string
     */
    public function getEmpAddress()
    {
        return $this->empAddress;
    }

    /**
     * @param string $empAddress
     */
    public function setEmpAddress($empAddress)
    {
        $this->empAddress = $empAddress;
    }



}