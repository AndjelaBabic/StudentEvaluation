<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 14-Feb-18
 * Time: 02:58 AM
 */
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Connector/DatabaseConnector.php";
require 'flight/Flight.php';
require 'jsonindent.php';

use Connector\DatabaseConnector as DatabaseConnector;

$json_podaci = file_get_contents("php://input");
$xml_podaci = file_get_contents("php://input");
$db = DatabaseConnector::getInstance();
Flight::set('json_podaci', $json_podaci);
Flight::set('xml_podaci', $xml_podaci);
Flight::set('db', $db);
//Flight::register('db', 'PDO',  array('mysql:host=localhost;dbname=student_base','root',''));

Flight::route('/neka', function () {
    echo 'hello world!';
});

// return all professors json
Flight::route('GET /professor.json', function () {
    header("Content-Type: application/json; charset=utf-8");

    $db = Flight::get('db');
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);

    $result = $db->select("user ", ' * ', null, "", "", null, null);
    $niz = array();
    $i = 0;
    for ($x = 0; $x < sizeof($result); $x++) {
        $niz[$i]['id'] = $result[$x]['id'];
        $niz[$i]['name'] = $result[$x]['name'];
        $niz[$i]['surname'] = $result[$x]['surname'];
        $niz[$i]['email'] = $result[$x]['email'];
        $niz[$i]['password'] = $result[$x]['password'];
        $i++;
    }

    $json_niz = json_encode($niz, JSON_UNESCAPED_UNICODE);
    echo '{' . '"user":' . indent($json_niz) . ' }';
    return false;

});


// return all professors xml
Flight::route('GET /professor.xml', function () {
    header("Content-Type: application/xml; charset=utf-8");
    $db = Flight::get('db');
    $xml_podaci = Flight::get("xml_podaci");

    $result = $db->select("user ", ' * ', "", "", "", null, null);
    $dom = new DomDocument('1.0', 'utf-8');
    $professors = $dom->appendChild($dom->createElement('professors'));
    if (!$result) {
        $error = $professors->appendChild($dom->createElement('error'));
        $error->appendChild($dom->createTextNode("Error while executing query"));
    } else {
        if (sizeof($result) > 0) {
            for ($x = 0; $x < sizeof($result); $x++) {

                $prof = $professors->appendChild($dom->createElement('user'));

                $id = $prof->appendChild($dom->createElement('id'));
                $id->appendChild($dom->createTextNode($result[$x]['id']));

                $name = $prof->appendChild($dom->createElement('name'));
                $name->appendChild($dom->createTextNode($result[$x]['name']));

                $surname = $prof->appendChild($dom->createElement('surnname'));
                $surname->appendChild($dom->createTextNode($result[$x]['surname']));

                $email = $prof->appendChild($dom->createElement('email'));
                $email->appendChild($dom->createTextNode($result[$x]['email']));

                $password = $prof->appendChild($dom->createElement('password'));
                $password->appendChild($dom->createTextNode($result[$x]['password']));
            }

        } else {
            $error = $professors->appendChild($dom->createElement('error'));
            $error->appendChild($dom->createTextNode("No professors to show"));
        }
    }
    $xml_string = $dom->saveXML();
    echo $xml_string;
    return false;
});

// return all students, with email adress, json
Flight::route('GET /student.json', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::get('db');

    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);

    if (!isset($_GET['search'])) {
        $result = $db->select("student ", ' * ', "user_student", "id", "id", null, null);
    } else {
        $pretraga = $_GET['search'];
        $db->select(" student ", ' * ', "user_student", "id", "id", "user_student.id = " . $pretraga, null);
    }
    $niz = array();
    $i = 0;
    for ($x = 0; $x < sizeof($result); $x++) {
        $niz[$i]['id'] = $result[$x]['id'];
        $niz[$i]['name'] = $result[$x]['name'];
        $niz[$i]['surname'] = $result[$x]['surname'];
        $niz[$i]['student_id'] = $result[$x]['student_id'];
        $niz[$i]['year'] = $result[$x]['year'];
        $niz[$i]['assignment_status'] = $result[$x]['assignment_status'];
        $niz[$i]['grade'] = $result[$x]['grade'];
        $niz[$i]['email'] = $result[$x]['email'];
        $niz[$i]['password'] = $result[$x]['password'];
        $i++;
    }
    $json_niz = json_encode($niz, JSON_UNESCAPED_UNICODE);
    echo '{' . '"student":' . indent($json_niz) . ' }';
    return false;
});


// return all students, with email adress, xml
Flight::route('GET /student.xml', function () {
    header("Content-Type: application/xml; charset=utf-8");
    $db = Flight::get('db');
    $xml_podaci = Flight::get("xml_podaci");

    $result = $db->select("student ", ' * ', "user_student", "id", "id", null, null);
    $dom = new DomDocument('1.0', 'utf-8');
    $students = $dom->appendChild($dom->createElement('students'));
    if (!$result) {
        $error = $students->appendChild($dom->createElement('error'));
        $error->appendChild($dom->createTextNode("Error while executing query"));
    } else {
        if (sizeof($result) > 0) {

            for ($x = 0; $x < sizeof($result); $x++) {

                $stud = $students->appendChild($dom->createElement('student'));

                $id = $stud->appendChild($dom->createElement('id'));
                $id->appendChild($dom->createTextNode($result[$x]['id']));

                $name = $stud->appendChild($dom->createElement('name'));
                $name->appendChild($dom->createTextNode($result[$x]['name']));

                $surname = $stud->appendChild($dom->createElement('surnname'));
                $surname->appendChild($dom->createTextNode($result[$x]['surname']));

                $student_id = $stud->appendChild($dom->createElement('student_id'));
                $student_id->appendChild($dom->createTextNode($result[$x]['student_id']));

                $year = $stud->appendChild($dom->createElement('year'));
                $year->appendChild($dom->createTextNode($result[$x]['year']));

                $assignment_status = $stud->appendChild($dom->createElement('assignment_status'));
                $assignment_status->appendChild($dom->createTextNode($result[$x]['assignment_status']));

                $grade = $stud->appendChild($dom->createElement('grade'));
                $grade->appendChild($dom->createTextNode($result[$x]['grade']));

            }
        } else {
            $error = $students->appendChild($dom->createElement('error'));
            $error->appendChild($dom->createTextNode("No students to show"));
        }
    }
    $xml_string = $dom->saveXML();
    echo $xml_string;
    return false;
});

// return student with specific id, json (join table)
Flight::route('GET /student/@id.json', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::get('db');
    $result = $db->select("student ", ' * ', "user_student", "id", "id", "user_student.id = " . $id, null);
    $niz = array();
    $i = 0;
    if(sizeof($result) >0) {
        $niz['id'] = $result[0]['id'];
        $niz['name'] = $result[0]['name'];
        $niz['surname'] = $result[0]['surname'];
        $niz['email'] = $result[0]['email'];
        $niz['password'] = $result[0]['password'];
        $niz['student_id'] = $result[0]['student_id'];
        $niz['year'] = $result[0]['year'];
        $niz['assignment_status'] = $result[0]['assignment_status'];
        $niz['grade'] = $result[0]['grade'];
    } else{
        $niz = null;
    }
    //JSON_UNESCAPED_UNICODE parametar je uveden u PHP verziji 5.4
    //Omogućava Unicode enkodiranje JSON fajla
    //Bez ovog parametra, vrši se escape Unicode karaktera
    //Na primer, slovo č će biti \u010
    $json_niz = json_encode($niz, JSON_UNESCAPED_UNICODE);
    echo indent($json_niz);
    return false;
});


// return student with specific id, xml
Flight::route('GET /student/@id.xml', function ($id) {
    header("Content-Type: application/xml; charset=utf-8");
    $db = Flight::get('db');
    $xml_podaci = Flight::get("xml_podaci");

    $result = $db->select("student ", ' * ', "user_student", "id", "id", "user_student.id = " . $id, null);
    $dom = new DomDocument('1.0', 'utf-8');
    $students = $dom->appendChild($dom->createElement('students'));

        if (sizeof($result) > 0) {

            for ($x = 0; $x < sizeof($result); $x++) {
                $stud = $students->appendChild($dom->createElement('student'));

                $id = $stud->appendChild($dom->createElement('id'));
                $id->appendChild($dom->createTextNode($result[$x]['id']));

                $name = $stud->appendChild($dom->createElement('name'));
                $name->appendChild($dom->createTextNode($result[$x]['name']));

                $surname = $stud->appendChild($dom->createElement('surnname'));
                $surname->appendChild($dom->createTextNode($result[$x]['surname']));

                $student_id = $stud->appendChild($dom->createElement('student_id'));
                $student_id->appendChild($dom->createTextNode($result[$x]['student_id']));

                $year = $stud->appendChild($dom->createElement('year'));
                $year->appendChild($dom->createTextNode($result[$x]['year']));

                $assignment_status = $stud->appendChild($dom->createElement('assignment_status'));
                $assignment_status->appendChild($dom->createTextNode($result[$x]['assignment_status']));

                $grade = $stud->appendChild($dom->createElement('grade'));
                $grade->appendChild($dom->createTextNode($result[$x]['grade']));

            }
        } else {
            $error = $students->appendChild($dom->createElement('error'));
            $error->appendChild($dom->createTextNode("No students to show"));
        }

    $xml_string = $dom->saveXML();
    echo $xml_string;
    return false;
});

//return all files, json
Flight::route('GET /files.json', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::get('db');

    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);

    if (!isset($_GET['search'])) {
        $result = $db->select("files ", ' * ', "", "", "", null, null);
        $niz = array();
        $i = 0;
        for ($x = 0; $x < sizeof($result); $x++) {
            $niz[$i]['id'] = $result[$x]['id'];
            $niz[$i]['name'] = $result[$x]['name'];
            $niz[$i]['type'] = $result[$x]['type'];
            $niz[$i]['size'] = $result[$x]['size'];
            $niz[$i]['id_student'] = $result[$x]['id_student'];
            $i++;
        }
        $json_niz = json_encode($niz, JSON_UNESCAPED_UNICODE);
        echo '{' . '"files":' . indent($json_niz) . ' }';
        return false;
    }
});
//return all files, xml
Flight::route('GET /files.xml', function () {
    header("Content-Type: application/xml; charset=utf-8");
    $db = Flight::get('db');
    $xml_podaci = Flight::get("xml_podaci");

    $result = $db->select("files ", ' * ', "", "", "", null, null);
    $dom = new DomDocument('1.0', 'utf-8');
    $filess = $dom->appendChild($dom->createElement('filess'));
    if (!$result = $result) {
        $error = $filess->appendChild($dom->createElement('error'));
        $error->appendChild($dom->createTextNode("Error while executing query"));
    } else {
        if (sizeof($result) > 0) {

            for ($x = 0; $x < sizeof($result); $x++) {
                $fil = $filess->appendChild($dom->createElement('student'));

                $id = $fil->appendChild($dom->createElement('id'));
                $id->appendChild($dom->createTextNode($result[$x]['id']));

                $name = $fil->appendChild($dom->createElement('name'));
                $name->appendChild($dom->createTextNode($result[$x]['name']));

                $type = $fil->appendChild($dom->createElement('type'));
                $type->appendChild($dom->createTextNode($result[$x]['type']));

                $size = $fil->appendChild($dom->createElement('size'));
                $size->appendChild($dom->createTextNode($result[$x]['size']));

                $id_student = $fil->appendChild($dom->createElement('id_student'));
                $id_student->appendChild($dom->createTextNode($result[$x]['id_student']));

            }
        } else {
            $error = $filess->appendChild($dom->createElement('error'));
            $error->appendChild($dom->createTextNode("No files to show"));
        }
    }
    $xml_string = $dom->saveXML();
    echo $xml_string;
    return false;
});

// update user_student
Flight::route('PUT /student/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::get('db');
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);

    if ($podaci == null) {
        $odgovor["poruka"] = "No data send!";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
    } else {
        if (!property_exists($podaci, 'email')) {
            $odgovor["poruka"] = "Wrong data passed!";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->update("user_student", $id, array('email'), array($podaci->email))) {
                $odgovor["poruka"] = "Email address updated!";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $odgovor["poruka"] = "Error updating email address!";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            }
        }
    }
});


// insert new student
Flight::route('POST /student', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::get('db');
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);

    if ($podaci == null) {
        $odgovor["poruka"] = "No data send!";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (!property_exists($podaci, 'name') || !property_exists($podaci, 'surname') || !property_exists($podaci, 'student_id')) {
            $odgovor["poruka"] = "Wrong data passed!";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            $podaci_query = array();
            foreach ($podaci as $k => $v) {
                $v = "'" . $v . "'";
                $podaci_query[$k] = $v;
            }
            if ($db->insert("student", "id,name,surname,student_id,year,assignment_status,grade", array($podaci_query['id'], $podaci_query['name'], $podaci_query['surname'], $podaci_query['student_id'], $podaci_query['year'], $podaci_query['assignment_status'], $podaci_query['grade']))) {
                $odgovor["poruka"] = "Item successefuly inserted!";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $odgovor["poruka"] = "Error inserting item in student!";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            }
        }
    }
});


//delete student with specific id
Flight::route('DELETE /student/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::get('db');

    if ($db->delete("student", array("id"), array($id))) {
        $odgovor["poruka"] = "Student deleted successefuly!";
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    } else {
        $odgovor["poruka"] = "Error deleting student!";
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    }
});

Flight::start();
?>

