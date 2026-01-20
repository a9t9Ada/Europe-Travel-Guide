<?php
	include_once "includes/finland_advice_script.php";
?>
<!DOCTYPE html>
<html lang = "en">

<head>
	<title>Traveler Advice & Reviews | Europe Travel Guide</title>
	
	<link rel = "stylesheet" href = "../css/style_country.css">
	<link rel = "stylesheet" href = "../css/style_finland.css">
	<link rel = "icon" type = "image/icon" href = "../icon1.png">
	
	<meta charset = "UTF-8">
	<meta name = "keywords" content = "Finland, food, fun, enjoy">
	<meta name = "description" content = "Tip and tricks about vacation in Finland">
	<meta name = "author" content = "a9t9">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

</head>

<body>
	<header class = "header header_image">
		 <img src="images_finland/finland_flag.jpg" alt="Finland Flag">
		<h1>Traveler Advice & Reviews</h1>
	</header>
	
	<nav class = "nav">
		<ul>
			<li><a href = "../home.html"> Home </a></li>
			<li><a href = "finland.html"> Finland </a></li>
			<li> <a href = "finland_monuments.html">Monuments </a></li>
			<li> <a href = "finland_food.html">Food </a></li>
			<li> <a href = "finland_trip.html">Trip plan </a></li>
			<li><a href = "finland_advice.php" class = "active"> Advice </a></li>
			<li><a href = "../includes/logOut.php" >Log Out</a></li>
		</ul>
	</nav>
	
	<!-- All comments-->
	<section class = "comment_container">
	<?php
		$country = "Finland";
		printComm($conn, $country);
	?>
	</section>
	
	<!-- Add new comment-->
	<section class = "addCommentSection">
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
			<input type = "submit" name = "addComm" value = "Add Comment" class = "addButton">
			<?php if (!empty($commentErr)) echo "<p>$commentErr</p>"; ?>
		</form>
	</section>
	
	<section class = "addCommentSection">
	<?php if (isset($_POST["addComm"])){
		if (isset($_COOKIE["user"]) || isset($_SESSION["user"]) || isset($_SESSION["userID"]) || isset($_COOKIE["userID"])){
			echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">';
			echo "<textarea name='comment' ></textarea><br>";
			echo "<input type='submit' name='sendComm' value='Send' class = 'sendButton'>";
			echo "</form>";
		} else {
			echo "If you want to leave a comment, you must log in first.<br><br>";
			echo "<a href = 'finland_logIn.php' class = 'logIn'>LogIn</a>";
			echo "<a href = 'finland_signUp.php' class = 'logIn'>SignUp</a><br>";
		}
	}
	 ?>
	</section>
	
	<footer class = "footer">
		Created for educational purposes by a9t9.
	</footer>
</body>
</html>