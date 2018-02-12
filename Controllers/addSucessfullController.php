<?php
/**
 * Created by PhpStorm.
 * User: Andjela Babic
 * Date: 07-Feb-18
 * Time: 02:45 AM
 */
session_start();
if(isset($_SESSION['show-student']))
    unset($_SESSION['show-student']);

if(isset($_SESSION['submit']))
    unset($_SESSION['submit']);

if(isset($_SESSION['add-student']))
    unset($_SESSION['add-student']);


$_SESSION['sucessfull'] = true;

header("Location: ../index.php");