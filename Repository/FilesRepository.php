<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 05-Feb-18
 * Time: 04:37 AM
 */

namespace Repository;

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot. "Connector/DatabaseConnector.php";
require_once $siteRoot. "Models/Files.php";

use Connector\DatabaseConnector as DatabaseConnector;
use Models\Files as Files;

class FilesRepository
{
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = DatabaseConnector::getInstance();
    }

    public function insertFile($name, $type, $size, $id_student)
    {
        $sql = "INSERT INTO files VALUES(NULL, ?, ?, ?, ?)";
        $parameters = array($name, $type, $size, $id_student);
        $result = $this->dbConnector->insertFile($sql, $parameters);
        return $result;
    }

    public function getFileByID($id) {
        $sql = "SELECT * FROM files WHERE id_student=?";
        $result = $this->dbConnector->singleSelect($sql, $id);

        if($result == null)
            return null;
        else {
            $file = new Files();
            $file->setId($result["id"]);
            $file->setName($result["name"]);
            $file->setType($result["type"]);
            $file->setSize($result["size"]);
            $file->setIdStudent($result["id_student"]);

            return $file;
        }
    }

}