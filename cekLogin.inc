<?php 
require_once "includes/header.php";
require_once "includes/navbar.php";
	session_start();
	if (!isset($_SESSION['isUser'])) {
		echo "Harus Login Terlebih Dahulu";
		echo "<a href='login.php'>login</a>";
		exit();
	}

 ?>