<?php
if(!isset($_SESSION['login_user']) && !isset($_COOKIE['remember_me']))
	session_start();

$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";
require_once $siteRoot . "Repository/UserRepository.php";
require_once $siteRoot . "Models/User.php";

require_once $siteRoot . "Repository/UserStudentRepository.php";
require_once $siteRoot . "Models/UserStudent.php";

use Models\User as User;
use Repository\UserRepository as UserRepository;

use Models\UserStudent as UserStudent;
use Repository\UserStudentRepository as UserStudentRepository;

$userRepository = new UserRepository();

if(isset($_COOKIE['remember_me']) && !isset($_SESSION['login_user'])) {
    $user = $userRepository->getUserByID($_COOKIE['remember_me']);
    $_SESSION['login_user'] = $user->getId();
}

if(isset($_POST['login'])) {
    $user = $userRepository->getUserByEmail($_POST['email']);

    if($user != null && strcmp($user->getPassword(), $_POST['password']) == 0) {
        if(isset($_POST['remember_me'])) {
            setcookie("remember_me", $user->getId(), time() + (86400 * 30), "/");
        }
        $_SESSION['login_user'] = $user->getId();
        if(isset($_SESSION['login-error']))
            unset($_SESSION['login-error']);

        header("Location: ../index.php");
    } else{
        $_SESSION['login-error'] = "Invalid email or password";
        header("Location: ../index.php");
    }
}

// __________________________

$userStudentRepository = new UserStudentRepository();

if(isset($_COOKIE['remember_me-student']) && !isset($_SESSION['login_user-student'])) {
    $user = $userStudentRepository->getUserStudentByID($_COOKIE['remember_me-student']);
    $_SESSION['login_user-student'] = $user->getId();
}

if(isset($_POST['login-student'])) {
    $user = $userStudentRepository->getUserStudentByEmail($_POST['email-student']);

    if($user != null && strcmp($user->getPassword(), $_POST['password-student']) == 0) {
        if(isset($_POST['remember_me-student'])) {
            setcookie("remember_me-student", $user->getId(), time() + (86400 * 30), "/");
            $_SESSION['login_user-student'] = $user->getId();
        }
        else{
            $_SESSION['login_user-student'] = $user->getId();
        }

        if(isset($_SESSION['login-error-student']))
            unset($_SESSION['login-error-student']);

        header("Location: ../index.php");
    } else{
        $_SESSION['login-error-student'] = "Invalid email or password";
        header("Location: ../index.php");
    }
}