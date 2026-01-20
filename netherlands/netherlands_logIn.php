<?php
	include_once "includes/netherlands_logIn_script.php";
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Log In | Europe Travel Guide</title>
	
	<link rel = "stylesheet" href = "../css/style_country.css">
	<link rel = "stylesheet" href = "../css/style_netherlands.css">
	<link rel = "icon" type = "image/icon" href = "../icon1.png">
	
	<meta charset = "UTF-8">
	<meta name = "description" content = "LogIn section for user and commentators">
	<meta name = "author" content = "a9t9">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

</head>

<body>
	<header class = "header header_image">
		 <img src="images_netherlands/netherlands_flag.png" alt="The Netherlands Flag">
		<h1>Log In to Leave Advice</h1>
	</header>
	
	<nav class = "nav">
		<ul>
			<li><a href = "../home.html"> Home </a></li>
			<li><a href = "netherlands.html" > The Netherlands </a></li>
			<li> <a href = "netherlands_monuments.html">Monuments </a></li>
			<li> <a href = "netherlands_food.html">Food </a></li>
			<li> <a href = "netherlands_trip.html" >Trip plan </a></li>
			<li><a href = "netherlands_advice.php"> Advice </a></li>
		</ul>
	</nav>
	
	<section class = "loginSection">
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
			<?php $username = $_POST["username"] ?? ""; ?>
			<label for = "username">Username:*</label><br>
			<input type = "text" name = "username" value = "<?php echo htmlspecialchars($username); ?>" required ><br><br>
			
			<label for = "username">Password:*</label> <br>
			<input type = "password" name = "password" required><br><br>
			
			<input type = "submit" name = "log_in" value = "Log In" class = "logIn"><br>
			<span><?php echo $logInErr; ?></span><br>
			<a href = "netherlands_signUp.php">Create new account</a>
		</form>
	</section>
	
	<footer class = "footer">
		Created for educational purposes by a9t9.
	</footer>
</body>
</html>