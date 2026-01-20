<?php
	session_start();
	
	#Connect to server and/or db
	include_once __DIR__ . "/../../includes/config.php";
	include_once __DIR__ . "/../../includes/functions.php";


	
	$country = "Serbia";
	$logIn_file = "../serbia/serbia_logIn.php";
	$advice_file = "../serbia/serbia_advice.php";
	$commentErr = "";
	
	deleteComm($conn);
	new_comment($conn, $logIn_file, $advice_file, $country, $commentErr);
	
?>