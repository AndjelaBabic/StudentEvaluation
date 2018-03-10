<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 16-Feb-18
 * Time: 03:31 AM
 */

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";
require_once $siteRoot . "Models/Student.php";

use Models\Student as Student;
use Repository\StudentRepository as StudentRepository;
$studentRepository = new StudentRepository();

$studentUpdate;
if(isset($_SESSION['login_user-student'])) {

    $id = $_SESSION['login_user-student'];

        if (isset($_POST['email'])) {
            $studentUpdate = '{"email": "'. $_POST['email'] .'"}';
        } else {

            $studentUpdate = '{"You have not inserted email!"}';
        }
        $url = 'http://localhost/StudentEvaluation2/ws/student/' . $id;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $studentUpdate);
        $curl_odgovor = curl_exec($curl);
        curl_close($curl);
        $json_objekat = json_decode($curl_odgovor);
        header("Location: ../index.php");
}

?>

