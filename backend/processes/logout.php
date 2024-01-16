<?php 
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['administrator']);
	header("Location:../index.php");
?>