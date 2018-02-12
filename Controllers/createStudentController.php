
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 24-Dec-17
 * Time: 12:42 AM
 */
<?php
session_start();
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";

use Repository\StudentRepository as StudentRepository;

if(isset($_POST['create-student'])) {
    if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['student_id']) && !empty($_POST['year'])) {
        $studentRepos = new StudentRepository();
        $result = $studentRepos->insertStudent($_POST['name'], $_POST['surname'], $_POST['student_id'],  $_POST['year']);

        $_SESSION['create-success'] = "New student added successfully";
    }
    else
        $_SESSION['create-error'] = "Please fill out all the required fields!";

    header("Location: ../index.php");
}
