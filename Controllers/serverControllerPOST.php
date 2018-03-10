<?php
/**
 * Created by PhpStorm.
 * User: Jovana
 * Date: 13.2.2018
 * Time: 12:20
 */
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";
require_once $siteRoot . "Models/Student.php";

use Models\Student as Student;
use Repository\StudentRepository as StudentRepository;


    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['student_id'])  && isset($_POST['year'])) {
        $studentRepos = new StudentRepository();
        $result = $studentRepos->insertStudent($_POST['name'], $_POST['surname'], $_POST['student_id'],  $_POST['year']);
    }
    else {
        $result = '{"Error!"}';
    }

    $url = 'http://localhost/StudentEvaluation2/ws/student';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $result);

    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    $json_objekat = json_decode($curl_odgovor);
        header("Location: ../index.php");

?>
