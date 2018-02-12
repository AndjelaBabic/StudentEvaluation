<?php
session_start();
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

require_once $siteRoot . "Repository/UserRepository.php";
require_once $siteRoot . "Repository/UserStudentRepository.php";

use Repository\UserRepository as UserRepository;
use Repository\UserStudentRepository as UserStudentRepository;


if(isset($_POST['register'])) {
	if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password'])
		&&isset($_POST['confirm-password'])) {
		
		if(strcmp($_POST['password'], $_POST['confirm-password']) == 0) {
			$userRepository = new UserRepository();
			$result = $userRepository->insertUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
			
			if($result == true) {
				$_SESSION['register-success'] = "User registered successfully.";
			} else {
				$_SESSION['register-error'] = "That email address is already in use.";
			}
		} else {
			$_SESSION['register-error'] = "Passwords do not match, please try again.";
		}
	}
	header("Location: ../index.php");
}

if(isset($_POST['register-student'])) {
    if(isset($_POST['id-student']) && isset($_POST['email-student'])  && isset($_POST['password-student']) && isset($_POST['confirm-password-student'])) {

        if(strcmp($_POST['password-student'], $_POST['confirm-password-student']) == 0) {
            $userStudentRepository = new UserStudentRepository();
            $result = $userStudentRepository->insertUserStudent($_POST['id-student'], $_POST['password-student'], $_POST['email-student']);

            if($result == true) {
                $_SESSION['register-success-student'] = "Student registered successfully.";
            } else {
                $_SESSION['register-error-student'] = "That email address is already in use.";
            }
        } else {
            $_SESSION['register-error-student'] = "Passwords do not match, please try again.";
        }
    }
    header("Location: ../index.php");
}