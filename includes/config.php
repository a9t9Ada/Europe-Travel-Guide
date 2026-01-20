<?php 
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "myDB";


	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	  
		include "setup.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
	}

	$conn->set_charset("utf8mb4");


	$conn->query("
	CREATE TABLE IF NOT EXISTS traveler(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(25) NOT NULL,
		email VARCHAR(50) NOT NULL,
		hash_password VARCHAR(255) NOT NULL
	)") or die($conn->error);

	$conn->query("
	CREATE TABLE IF NOT EXISTS travelerComm(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		comment TEXT NOT NULL,
		idTraveler INT NOT NULL,
		date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		country TEXT NOT NULL,
		FOREIGN KEY(idTraveler) REFERENCES traveler(id)
	)") or die($conn->error);
?>