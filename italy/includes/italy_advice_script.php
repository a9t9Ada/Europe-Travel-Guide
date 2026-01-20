<?php
	session_start();
	
	#Connect to server and/or db
	include_once __DIR__ . "/../../includes/config.php";
	include_once __DIR__ . "/../../includes/functions.php";


	
	$country = "Italy";
	$logIn_file = "../italy/italy_logIn.php";
	$advice_file = "../italy/italy_advice.php";
	$commentErr = "";
	
	deleteComm($conn);
	new_comment($conn, $logIn_file, $advice_file, $country, $commentErr);
	
?>