<?php

//$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";
//
//require_once $siteRoot . "Connector/DatabaseConnector.php";
//
//use Connector\DatabaseConnector as DatabaseConnector;
$db_user = "root";
$db_pass = "";
$db_db = "student_base";
$db_server = "localhost";

$table = "student";
$primaryKey = 'id';

// Niz sa nazivima kolona iz baze. Prvi niz dodaje id atribut u svaki <tr>
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            return $d;
        }
    ),
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'name',  'dt' => 1 ),
    array( 'db' => 'surname',   'dt' => 2 ),
    array( 'db' => 'student_id',     'dt' => 3 ),
    array( 'db' => 'year',     'dt' => 4 ),
    array( 'db' => 'assignment_status', 'dt' => 5 ),
    array( 'db' => 'grade', 'dt' => 6),
);

// SQL server connection information
$sql_details = array(
    'user' => $db_user,
    'pass' => $db_pass,
    'db'   => $db_db,
    'host' => $db_server
);


//Treba postaviti putanju do ssp.class.php (proveriti folder gde se nalazi DataTables)
require('DataTables-1.10.4/examples/server_side/scripts/ssp.class.php');

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

