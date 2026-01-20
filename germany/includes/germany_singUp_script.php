<?php
	
	session_start();
	if (isset($_SESSION["user"]) || isset($_COOKIE["user"])){
		header("Location: ../germany_advice.php");
		exit();
	}
	
	#Connect to server and/or db
	include_once __DIR__ . "/../../includes/config.php";
	include_once __DIR__ . "/../../includes/functions.php";
	
	$advice_file = "../austria/germany_advice.php";
	$errors = signUp($conn, $advice_file);
	
	$conn->close();
?>