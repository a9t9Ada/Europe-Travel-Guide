<?php
	session_start();
	if (isset($_SESSION["user"]) || isset($_COOKIE["user"])){
		header("Location: ../austria_advice.php");
		exit;
	}
	
	#Connect to server and/or db
	include_once __DIR__ . "/../../includes/config.php";
	include_once __DIR__ . "/../../includes/functions.php";
	
	
	$advice_file = "../austria/austria_advice.php";

	logIn($conn, $advice_file);
	
	$logInErr = $_SESSION["logInErr"] ?? "";
	unset($_SESSION["logInErr"]);
	
	$conn->close();
?>