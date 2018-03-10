<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 24-Dec-17
 * Time: 12:46 AM
 */

namespace Repository;
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Connector/DatabaseConnector.php";
require_once $siteRoot . "Models/Student.php";

use Connector\DatabaseConnector as DatabaseConnector;
use Models\Student as Student;


class StudentRepository
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = DatabaseConnector::getInstance();
    }


    public function insertStudent($name, $surname, $student_id, $year)
    {
        $sql = "INSERT INTO student VALUES(NULL, ?, ?, ?, ?, ?, ?)";
        $parameters = array($name, $surname, $student_id, $year, "Unsubmitted", NULL);
        $result = $this->dbConnector->insertStudent($sql, $parameters);
        return $result;
    }

    //odavde

    public function selectAllStudents()
    {
        $sql = "SELECT `student`.id, `student`.name, `student`.surname, `student`.student_id, `student`.year, `student`.assignment_status, `student`.grade 
        FROM `student`";

        $result = $this->dbConnector->multipleSelect($sql);
        return $result;
    }

    public function partialSearch($text)
    {
        $sql = "SELECT `student`.id, `student`.name, `student`.surname, `student`.student_id, `student`.year, `student`.assignment_status, `student`.grade FROM `student` WHERE  `student`.name LIKE ?";
        $result = $this->dbConnector->partialMultipleSelect($sql, $text);
        return $result;
    }

    public function getStudentById($id)
    {
        $sql = "SELECT `student`.id, `student`.name, `student`.surname, `student`.student_id, `student`.year, `student`.assignment_status, `student`.grade
                FROM `student` WHERE  `student`.id = ?";
        $result = $this->dbConnector->singleSelect($sql, $id);

        if ($result == null) {
            return null;
        } else {
            $st = new Student();
            $st->setId($result["id"]);
            $st->setName($result["name"]);
            $st->setSurname($result["surname"]);
            $st->setStudentId($result["student_id"]);
            $st->setYear($result["year"]);
            $st->setAssignmentStatus($result["assignment_status"]);
            $st->setGrade($result["grade"]);
            return $result;
        }
    }

    // delete ok
    public function deleteStudent($id)
    {
        $sql = "DELETE FROM student WHERE id = ?";
        $this->dbConnector->deleteStudent($sql, $id);
    }

    // update-ujemo tako sto uzmemo id studenta i samo mu ocenu unesemo promenimo
    public function updateStudent($parameters)
    {
        $sql = "UPDATE `student` SET `grade`=? WHERE id=?";
        $this->dbConnector->updateStudent($sql, $parameters);
    }

    public function getNumberWithThisGrade($grade)
    {
        if($grade===null){
            $sql = "SELECT COUNT(id) FROM `student` WHERE grade IS NULL";
        } else{
            $sql = "SELECT COUNT(id) FROM `student` WHERE grade=?";
        }
        $result = $this->dbConnector->getNumber($sql, $grade);
        // Array ( [COUNT(id)] => 0 ) u ovom obliku je svaki koji baza vrati
        return $result['COUNT(id)'];
    }

    public function getArrayStats()
    {
        $arrayStats = array('Ungraded' => $this->getNumberWithThisGrade(null),
            '5' => $this->getNumberWithThisGrade(5),
            '6' => $this->getNumberWithThisGrade(6),
            '7' => $this->getNumberWithThisGrade(7),
            '8' => $this->getNumberWithThisGrade(8),
            '9' => $this->getNumberWithThisGrade(9),
            '10'=> $this->getNumberWithThisGrade(10));
//        $array['Ungraded'] = $this->getNumberWithThisGrade(null);
//        $array['5'] = $this->getNumberWithThisGrade(5);
//        $array['6'] = $this->getNumberWithThisGrade(6);
//        $array['7'] = $this->getNumberWithThisGrade(7);
//        $array['8'] = $this->getNumberWithThisGrade(8);
//        $array['9'] = $this->getNumberWithThisGrade(9);
//        $array['10'] = $this->getNumberWithThisGrade(10);

        return $arrayStats;
    }

}