<?php
session_start();
if(isset($_SESSION['show-student']))
unset($_SESSION['show-student']);

if(isset($_SESSION['sucessfull']))
    unset($_SESSION['sucessfull']);

$_SESSION['submit'] = true;

header("Location: ../index.php");