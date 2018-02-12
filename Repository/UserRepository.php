<?php
namespace Repository;
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Connector/DatabaseConnector.php";
require_once $siteRoot. "Models/User.php";

use Connector\DatabaseConnector as DatabaseConnector;
use Models\User as User;

class UserRepository {
	private $dbConnector;

	public function __construct() {
		$this->dbConnector = new DatabaseConnector("root", "", "student_base", "localhost");
	}

	/**
	 * [Get user from database by Email]
	 * @param  [type] $email [User's email]
	 * @return [type]        [Return user if user is found, otherwise null]
	 */
	public function getUserByEmail($email) {
		$sql = "SELECT * FROM user WHERE email=?";
		$result = $this->dbConnector->singleSelect($sql, $email);

		if($result == null)
			return null;
		else {
			$user = new User();
			$user->setId($result["id"]);
			$user->setName($result["name"]);
			$user->setSurname($result["surname"]);
			$user->setEmail($result["email"]);
			$user->setPassword($result["password"]);

			return $user;
		}
	}

	/**
	 * [Get user from database by ID]
	 * @param  [type] $id [User's ID]
	 * @return [type]     [Return user if user is found, otherwise null]
	 */
	public function getUserByID($id) {
		$sql = "SELECT * FROM user WHERE id=?";
		$result = $this->dbConnector->singleSelect($sql, $id);
		
		if($result == null)
			return null;
		else {
			$user = new User();
			$user->setId($result["id"]);
			$user->setName($result["name"]);
			$user->setSurname($result["surname"]);
			$user->setEmail($result["email"]);
			$user->setPassword($result["password"]);

			return $user;
		}
	}

	/**
	 * [Create a new user]
	 * @param  [type] $name     [User's name]
	 * @param  [type] $surname  [User's surname]
	 * @param  [type] $email    [User's email]
	 * @param  [type] $password [User's password]
	 * @return [type]           [Return true if insert was successfull, otherwise false]
	 */
	public function insertUser($name, $surname, $email, $password) {
		$sql = "INSERT INTO user VALUES(NULL, ?, ?, ?, ?)";
		$parameters = array($name, $surname, $email, $password);
		$result = $this->dbConnector->insertUser($sql, $parameters);
		return $result;
	}
}