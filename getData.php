<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 09-Feb-18
 * Time: 06:59 PM
 */

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/StudentRepository.php";

use Repository\StudentRepository as StudentRepository;

$studentRepository = new StudentRepository();

$array = $studentRepository->getArrayStats();


$data = array();
// Structure data for google visualization API
$data['cols'] = array(
    array('id' => '1', 'label' => 'Grade', 'type' => 'string'),
    array('id' => '2', 'label' => 'Number', 'type' => 'number'),
);

$rows = array();
foreach ($array as $key => $value) {
    $temp = array();
    //Values
    $temp[] = array('v' => (string)$key);
    $temp[] = array('v' => (int)$value);
    $rows[] = array('c' => $temp);
    //Values
}


$data['rows'] = $rows;

echo json_encode($data, true);