<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 03-Feb-18
 * Time: 07:57 PM
 */

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot."Repository\StudentRepository.php";
require_once $siteRoot."Models\Student.php";

use Repository\StudentRepository as StudentRepository;
use Models\Student as Student;

$studentRepository = new StudentRepository();
//$student = $studentRepository->getStudentById($_SESSION["login_user-student"]);

if(isset($_GET['idOfStudent'])) {

    echo $_GET['idOfStudent'];
    echo "nest";
}