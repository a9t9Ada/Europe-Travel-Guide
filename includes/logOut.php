<?php
	session_start();
	session_unset();
	session_destroy();
	
	$authCookies = ["user", "userID", "login_attempts", "login_blocked"];

	foreach ($authCookies as $cookie) {
		if (isset($_COOKIE[$cookie])) {
			setcookie($cookie, "", time() - 3600, "/", "", false, true);
		}
	}
	
	header("Location: ../home.html");
	exit();
?>