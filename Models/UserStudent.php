<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 02-Feb-18
 * Time: 06:28 PM
 */

namespace Models;


class UserStudent
{
    private $id_user_student;
    private $id;
    private $password;
    private $email;

    /**
     * @return mixed
     */
    public function getIdUserStudent()
    {
        return $this->id_user_student;
    }

    /**
     * @param mixed $id_user_student
     */
    public function setIdUserStudent($id_user_student)
    {
        $this->id_user_student = $id_user_student;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}