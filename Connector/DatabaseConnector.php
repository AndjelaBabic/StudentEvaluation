<?php

namespace Connector;

use \PDO;

class DatabaseConnector
{
    private $userName;
    private $password;
    private $database;
    private $server;
    private $connection;
    private static $instance;

    private $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    private function __construct($userName, $password, $database, $server)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
        $this->server = $server;
        $this->openConnection();
    }

    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance = new DatabaseConnector("root", "", "student_base", "localhost");
        }
        return self::$instance;
    }

    /**
     * [Open new Connection]
     * @return [type] [description]
     */
    public function openConnection()
    {
        try {
            $connectionString = "mysql:host=" . $this->server . ";dbname=" . $this->database . ";charset=utf8";
            $this->connection = new PDO($connectionString, $this->userName, $this->password, $this->opt);
        } catch (PDOException $e) {
            echo "Problem connecting to a database.";
        }
    }

    /**
     * [Close opened connection]
     * @return [type] [description]
     */
    public function closeConnection()
    {
        $connection = null;
    }

    /**
     * [Select single row from a database]
     * @param  [type] $sql         [SQL query]
     * @param  [type] $requirement [Variable which must satisfy qurey requirement(WHERE)]
     * @return [type]              [description]
     */
    public function singleSelect($sql, $requirement)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute([$requirement]);

        $result = $statement->fetch();
        $this->closeConnection();

        return $result;
    }

    public function insertUserStudent($sql, $parameters)
    {
        $result = $this->singleSelect("SELECT * FROM user_student WHERE email= ?", $parameters[2]);
        if ($result == null) {

            $statement = $this->connection->prepare($sql);
            $statement->execute([$parameters[0], $parameters[1], $parameters[2]]);
            $this->closeConnection();
            return true;
        } else {
            return false;
        }
    }

    public function insertUser($sql, $parameters)
    {
        $result = $this->singleSelect("SELECT * FROM user WHERE email = ?", $parameters[2]);
        // if result is null, than we don't have a user in database with that email, so it is ok
        // to insert user
        if ($result == null) {

            $statement = $this->connection->prepare($sql);
            $statement->execute([$parameters[0], $parameters[1], $parameters[2], $parameters[3]]);
            $this->closeConnection();
            return true;
        } else {
            return false;
        }
    }

// odavde


    /**
     * [Select more than one column from a database]
     * @param  [type] $sql         [SQL query]
     * @param  [type] $requirement [Variable which must satisfy qurey requirement(WHERE)]
     * @return [type]              [description]
     */
    public function multipleSelect($sql)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        $this->closeConnection();

        return $result;
    }

    /**
     * [Select more than one column from a datebase]
     * @param $sql [SQL query]
     * @param $text []
     * @return mixed
     */
    public function partialMultipleSelect($sql, $text)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute([$text]);

        $result = $statement->fetchAll();
        $this->closeConnection();

        return $result;
    }

    public function insertFile($sql, $parameters)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute([$parameters[0], $parameters[1], $parameters[2], $parameters[3]]);
        $this->closeConnection();
        return true;
    }

    public function insertStudent($sql, $parameters)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute([$parameters[0], $parameters[1], $parameters[2], $parameters[3], $parameters[4],
            $parameters[5]]);
        $this->closeConnection();
        return true;
    }

    public function deleteStudent($sql, $id)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        $this->closeConnection();
    }

    public function updateStudent($sql, $parameters)
    {

        $statement = $this->connection->prepare($sql);
        $statement->execute([$parameters[0],
            $parameters[1]]);
        $this->closeConnection();
    }

    public function getNumber($sql, $grade)
    {

        $statement = $this->connection->prepare($sql);
        if($grade == null){
            $statement->execute();
        } else{
            $statement->execute([$grade]);
        }
        $result = $statement->fetch();
        $this->closeConnection();
        return $result;
    }

    function select($table = "student", $columns = '*', $join_table = " ", $join_key1 = " ", $join_key2 = " ", $where = null, $order = null)
    {
        $q = 'SELECT ' . $columns . ' FROM ' . $table;
        if ($join_table != null)
            $q .= ' JOIN ' . $join_table . ' ON ' . $table . '.' . $join_key1 . ' = ' . $join_table . '.' . $join_key2;
        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;
        $statement = $this->connection->prepare($q);
        $statement->execute();

        $result = $statement->fetchAll();
        $this->closeConnection();
        return $result;

    }

    function update($table, $id, $keys, $values) {
        $update = "UPDATE ". $table ." SET ". $keys[0] ." = '". $values[0] ."' WHERE id=". $id;
        if($this->ExecuteQuery($update)){
            return true;
        }else{
            return false;
        }
    }

    function delete($table = "student", $keys, $values) {
        $delete = "DELETE FROM ". $table ." WHERE ". $keys[0] ." = '". $values[0] ."'";
        if ($this->ExecuteQuery($delete))
            return true;
        else
            return false;
    }

    function insert($table = "student", $rows = "id, name, surname, student_id, year, assignment_status, grade", $values) {
        $query_values = implode(',',$values);
        $insert = 'INSERT INTO '. $table;
        if($rows != null) {
            $insert .= ' ('. $rows .')';
        }
        $insert .= ' VALUES ('. $query_values .')';

        if($this->ExecuteQuery($insert)){
            return true;
        } else{
            return false;
        }
    }

    function ExecuteQuery($sql)
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $this->closeConnection();
        return true;
    }


}