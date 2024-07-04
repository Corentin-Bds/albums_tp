<?php 
session_start();

unset($_SESSION["auth"]);
header("Location: index.php");
//print_r($_SESSION);
?>