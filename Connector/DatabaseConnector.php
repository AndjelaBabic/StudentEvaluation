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
//1. da se pisu sve greske
    private $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    public function __construct($userName, $password, $database, $server)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
        $this->server = $server;
    }

    /**
     * [Open new Connection]
     * @return [type] [description]
     */
    //PDO-rad sa bazom, za oo programiranje
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
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$requirement]);

        $result = $statement->fetch();
        $this->closeConnection();

        return $result;
    }

    public function insertUserStudent($sql, $parameters){
        $result=$this->singleSelect("SELECT * FROM user_student WHERE email= ?", $parameters[2]);
        if($result==null){
            $this->openConnection();
            $statement = $this->connection->prepare($sql);
            $statement->execute([$parameters[0], $parameters[1], $parameters[2]]);
            $this->closeConnection();
            return true;
        }else{
            return false;
        }


    }


    public function insertUser($sql, $parameters)
    {
        $result = $this->singleSelect("SELECT * FROM user WHERE email = ?", $parameters[2]);
        // if result is null, than we don't have a user in database with that email, so it is ok
        // to insert user
        if ($result == null) {
            $this->openConnection();
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
        $this->openConnection();
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
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$text]);

        $result = $statement->fetchAll();
        $this->closeConnection();

        return $result;
    }

    public function insertFile($sql, $parameters)
    {
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$parameters[0], $parameters[1], $parameters[2], $parameters[3]]);
        $this->closeConnection();
        return true;
    }

    public function insertStudent($sql, $parameters)
    {
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$parameters[0], $parameters[1], $parameters[2], $parameters[3], $parameters[4],
            $parameters[5]]);
        $this->closeConnection();
        return true;
    }

    public function deleteStudent($sql, $id)
    {
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        $this->closeConnection();
    }

    public function updateStudent($sql, $parameters)
    {
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$parameters[0],
            $parameters[1]]);
        $this->closeConnection();
    }
    public function getNumber($sql, $grade)
    {
        $this->openConnection();
        $statement = $this->connection->prepare($sql);
        $statement->execute([$grade]);
        $result = $statement->fetch();
        $this->closeConnection();
        return $result;
    }
}