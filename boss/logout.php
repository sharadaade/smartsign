<?php
session_start();
$_SESSION['user']="";
session_destroy();
unset($_SESSION['user']);
header("location:Login.php");
?>
