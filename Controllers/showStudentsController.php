<?php
session_start();

if(isset($_SESSION['add-student']))
unset($_SESSION['add-student']);

if(isset($_SESSION['submit']))
    unset($_SESSION['submit']);

if(isset($_SESSION['sucessfull']))
    unset($_SESSION['sucessfull']);

$_SESSION['show-student'] = true;
header("Location: ../index.php");