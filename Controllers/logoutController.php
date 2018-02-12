<?php
session_start();

setcookie("remember_me", "", time() - (86400 * 31), "/");
header("Location: ../index.php");
session_destroy();