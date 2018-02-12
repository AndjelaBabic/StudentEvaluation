<?php
session_start();
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";
require_once $siteRoot . "Models/Student.php";

use Models\Student as Student;
use Repository\StudentRepository as StudentRepository;

$studentRepository = new StudentRepository();

if(isset($_GET['id'])) {
    $studentRepository->deleteStudent($_GET['id']);
    header("Location: ../index.php");
}

if(isset($_GET['id2'])) {
    if(!empty($_GET['id2']) && !empty($_GET['grade'])) {
//        $ocena = explode("-", $_GET['id2']); // id, pa grade
        $parameters = array($_GET['grade'], $_GET['id2']); // pa menjamo ovde
        $studentRepository->updateStudent($parameters);
        header("Location: ../index.php");
    }
}