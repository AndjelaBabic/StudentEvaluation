<?php
/**
 * Created by PhpStorm.
 * User: Jovana
 * Date: 11.2.2018
 * Time: 18:58
 */
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";
require_once $siteRoot . "Models/Student.php";

use Models\Student as Student;
use Repository\StudentRepository as StudentRepository;
$studentRepository = new StudentRepository();

if(!isset($_SESSION['id'])){
    if(! isset($_SESSION['file'])) {

        $id = $_GET['id'];
        $url = 'http://localhost/StudentEvaluation2/ws/student/' . $id;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);
        $json_objekat = json_decode($curl_odgovor);
    }
}else{
    unset($_SESSION['file']);
}
    header("Location: ../index.php");
?>
