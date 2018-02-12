<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 05-Feb-18
 * Time: 04:34 AM
 */

namespace Models;


class Files
{
    private $id;
    private $name;
    private $type;
    private $size;
    private $id_student;


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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getIdStudent()
    {
        return $this->id_student;
    }

    /**
     * @param mixed $id_student
     */
    public function setIdStudent($id_student)
    {
        $this->id_student = $id_student;
    }


}