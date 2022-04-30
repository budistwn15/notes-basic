<?php 
session_start();
unset($_SESSION['email']);
$_SESSION['success'] = "You have logged out";
header("Location: index.php");