<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 02-Feb-18
 * Time: 06:32 PM
 */

namespace Repository;
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Connector/DatabaseConnector.php";
require_once $siteRoot. "Models/UserStudent.php";

use Connector\DatabaseConnector as DatabaseConnector;
use Models\UserStudent as UserStudent;

class UserStudentRepository
{

    private $dbConnector;

    public function __construct() {
        $this->dbConnector = DatabaseConnector::getInstance();
    }


    public function getUserStudentByEmail($email) {
        $sql = "SELECT * FROM user_student WHERE email=?";
        $result = $this->dbConnector->singleSelect($sql, $email);

        if($result == null)
            return null;
        else {
            $user_student = new UserStudent();
            $user_student->setIdUserStudent($result["id_user_student"]);
            $user_student->setId($result["id"]);
            $user_student->setPassword($result["password"]);
            $user_student->setEmail($result["email"]);


            return $user_student;
        }
    }

    /**
     * [Get user from database by ID]
     * @param  [type] $id [User's ID]
     * @return [type]     [Return user if user is found, otherwise null]
     */
    public function getUserStudentByID($id) {
        $sql = "SELECT * FROM user_student WHERE id=?";
        $result = $this->dbConnector->singleSelect($sql, $id);

        if($result == null)
            return null;
        else {
            $user_student = new UserStudent();
            $user_student->setIdUserStudent($result["id_user_student"]);
            $user_student->setId($result["id"]);
            $user_student->setPassword($result["password"]);
            $user_student->setEmail($result["email"]);

            return $user_student;
        }
    }

    /**
     * [Create a new user]
     * @param  [type] $name     [User's name]
     * @param  [type] $surname  [User's surname]
     * @param  [type] $email    [User's email]
     * @param  [type] $password [User's password]
     * @return [type]           [Return true if insert was successfull, otherwise false]
     */
    public function insertUserStudent($id, $password, $email) {
        $sql = "INSERT INTO user_student VALUES(NULL, ?,?,?)";
        $parameters = array($id, $password, $email);
        $result = $this->dbConnector->insertUserStudent($sql, $parameters);
        return $result;
    }

    // funkcija ,sql upit, trazimo da nam vrati koliko ima studenta sa ocenom koju prosledimo

    // funckiju, koja ce da pozeve 5 puta, 6,7,8,9,10, i onda sve to spakuje u niz

}