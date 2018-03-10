<?php

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";
require_once $siteRoot . "Models/Student.php";

use Models\Student as Student;
use Repository\StudentRepository as StudentRepository;

$studentRepository = new StudentRepository();


if(isset($_SESSION['add-student']))
    unset($_SESSION['add-student']);
//
//if(isset($_SESSION['submit']))
//    unset($_SESSION['submit']);

if(isset($_SESSION['sucessfull']))
    unset($_SESSION['sucessfull']);

$id = $_SESSION['login_user-student'];
$url = 'http://localhost/StudentEvaluation2/ws/student/'. $id .'.json';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
curl_setopt($curl, CURLOPT_HTTPGET, true);

$curl_odgovor = curl_exec($curl);
curl_close($curl);
$json_objekat = json_decode($curl_odgovor);

?>