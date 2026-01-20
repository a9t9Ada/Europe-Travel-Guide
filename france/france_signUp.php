<?php
	include_once "includes/france_signUp_script.php";
?>
<!DOCTYPE html>
<html lang = "en">
	
<head>
	<title>Sign Up | Europe Travel Guide</title>
	
	<link rel = "stylesheet" href = "../css/style_country.css">
	<link rel = "stylesheet" href = "../css/style_france.css">
	<link rel = "icon" type = "image/icon" href = "../icon1.png">
	
	<meta charset = "UTF-8">
	<meta name = "description" content = "SignUp section for user and commentators">
	<meta name = "author" content = "a9t9">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
</head>

<body>
	<header class = "header header_background">
		<h1>Bienvenue France</h1>
	</header>
	
	<nav class = "nav">
		<ul>
			<li><a href = "../home.html"> Home </a></li>
			<li><a href = "france.html" > France </a></li>
			<li> <a href = "france_monuments.html">Monuments </a></li>
			<li> <a href = "france_food.html">Food </a></li>
			<li> <a href = "france_trip.html" >Trip plan </a></li>
			<li><a href = "france_advice.php" class = "active"> Advice </a></li>
		</ul>
	</nav>
	
	<section class = "signUpSection">
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
			<label for = "username">Username:*</label><br>
			<?php $username = $_POST["username"] ?? '';?>
			<input type = "text" name = "username" value = "<?php echo htmlspecialchars($username); ?>" required><span><?php echo $errors["usernameErr"] ?? ''; ?></span><br><br>
			
			<label for = "email">Email:*</label> <br>
			<?php $email = $_POST["email"] ?? '';?>
			<input type = "text" name = "email" value = "<?php echo htmlspecialchars($email); ?>" required><span><?php echo $errors["emailErr"] ?? ''; ?></span><br><br>
			
			<label for = "pasword">Password:* </label><br>
			<input type = "password" name = "password" required><span><?php echo $errors["passwordErr"] ?? ''; ?></span><br><br>
			
			<label for = "conf_pasword">Confirm password:*</label><br>
			<input type = "password" name = "conf_password" required><br><br>
			<input type = "submit" name = "sign_up" value = "Sign Up" class = "signUp"><br><br>
			
			<span class = "spanErr"><?php echo $errors["signUpErr"] ?? ''; ?></span><br>
			<a href = "france_logIn.php">Already have an account?</a>
		</form>
	</section>
	
	<footer class = "footer">
		Created for educational purposes by a9t9.
	</footer>
</body>
</html>