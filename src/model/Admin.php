<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 12/2/2015
 * Time: 8:26 PM
 */

namespace pnaika\finals;


class Admin
{
    private $id = '';
    private $adminUserName;
    private $password = '';

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAdminUserName()
    {
        return $this->adminUserName;
    }

    /**
     * @param mixed $adminUserName
     */
    public function setAdminUserName($adminUserName)
    {
        $this->adminUserName = $adminUserName;
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



}