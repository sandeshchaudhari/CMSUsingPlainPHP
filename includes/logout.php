<?php include "db.php";?>
<?php session_start();?>
<?php
$_SESSION['user_username'] = $user_username;
$_SESSION['user_first_name'] = null;
$_SESSION['user_last_name'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_role'] = null;
header("Location:../index.php");
?>