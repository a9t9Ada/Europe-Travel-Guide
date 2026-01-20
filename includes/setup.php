<?php
	
	#Connect to DB
	$conn = new mysqli($servername, $username, $password);
		
	if ($conn -> connect_error) die("Connection to MySQL server failed: ".$conn->connect_error);
	
	#Create DB in not exists	
	$sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
		
	if (!$conn -> query($sql)) die("Error creating database `$dbname`: ". $conn->error);
	
	$conn->close();
	
?>