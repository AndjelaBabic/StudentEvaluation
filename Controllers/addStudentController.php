<?php
session_start();
$siteRoot = $_SERVER['DOCUMENT_ROOT'] . "/StudentEvaluation2/";

if(isset($_SESSION['show-student']))
	unset($_SESSION['show-student']);

if(isset($_SESSION['sucessfull']))
    unset($_SESSION['sucessfull']);

$_SESSION['add-student'] = true;
header("Location: ../index.php");