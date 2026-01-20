<?php	
	/** Sanitizes user input
	  *
	  * @param string $data raw input
	  * @return string sanitized input
	  *
	*/
	
	function edit_data($data){
		$data = trim($data);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}
	
	/**
	  * Add new comment in DB
	  *
	  * @param mysqli $conn DB connection object
	  * @param string $logIn_file Path of LogIn page
	  * @param string $advice_file Path of Advice page
	  * @param string $country Comment for country
	  *	@param string $commentErr Error if comment not right
	  *
	*/
	function new_comment($conn, $logIn_file, $advice_file, $country, &$commentErr){
		if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sendComm"])){
			if (!isset($_SESSION["userID"])) {
				header("Location: $logIn_file");
				exit();
			}
			if(empty($_POST["comment"])) { 
				$commentErr = "Comment cannot be empty";
				return;
			}	
			$comment = edit_data($_POST["comment"]);
			
			if (strlen($comment) < 5) {
				$commentErr = "Comment is too short";
				return; 
			}
			
			if (strlen($comment) > 2000) { 
				$commentErr = "Comment is too long";
				return;
			}
			
			$ps_sql = $conn -> prepare("INSERT INTO travelerComm(comment, idTraveler, country) VALUES(?, ?, ?)");
				
			if (!$ps_sql) die("Prepare failed:". $conn->error);
				
			$ps_sql -> bind_param("sis", $comment, $_SESSION["userID"], $country);
			
			if (!$ps_sql -> execute()) die("Execute failed: ". $ps_sql->error);
			$ps_sql -> close();
			header("Location: $advice_file");
			exit();
			
		} 
	}
	
	/**
	  *
	  * Function for deleting comment for specific user
	  * @param mysqli $conn DB connection object 
	  *
	*/
	function deleteComm($conn) {
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])){
			$delete_id = $_POST["delete_id"];
			
			if (!isset($_SESSION["userID"])) return;
			
			$ps_sql = $conn -> prepare("DELETE FROM travelerComm WHERE id = ? AND idTraveler = ?");
			
			if(!$ps_sql) die("Prepare failed: ". $ps_sql->error);
			
			$ps_sql -> bind_param("ii", $delete_id, $_SESSION["userID"]);
			
			if(!$ps_sql -> execute()){ 
				die("Execute failed". $ps_sql->error);
			} 
			$ps_sql -> close();
			
			
		}
	}
	
	/**
	  * Display comments for a specific country
	  *
	  * @param mysqli $conn DB connection object
	  * @param string $country Contry name to filter comments
	  *
	*/
	
	function printComm($conn, $country){
		$ps_sql = $conn -> prepare ("SELECT travelerComm.id, travelerComm.comment, traveler.username, travelerComm.date 
				FROM travelerComm  INNER JOIN traveler ON travelerComm.idTraveler = traveler.id 
				WHERE travelerComm.country = ? 
				ORDER BY travelerComm.date DESC");
		
		if (!$ps_sql) die("Prepare failed: ". $conn->error);
		
		$ps_sql -> bind_param("s", $country);
		$ps_sql -> execute();
		$data = $ps_sql -> get_result();
		
		if ($data && $data -> num_rows > 0){
			while($row = $data->fetch_assoc()){
				$date = date("d.m.Y H:i", strtotime($row["date"]));
				
				echo "<div class = 'comment_card'>";
				echo "<b>".htmlspecialchars($row["username"]).":</b><hr>";
				echo "<small>(". $date. ")</small>";
				echo "<p>". nl2br(htmlspecialchars($row["comment"]))."</p>";
				
				if (isset($_SESSION["user"]) && $row["username"]  == $_SESSION["user"]){
					#DELETE BUTTON
					echo "<form action = '". htmlspecialchars($_SERVER["PHP_SELF"]). "' method = 'POST'>";
						echo "<input type = 'hidden' name = 'delete_id' value = '". $row["id"]. "'>";
						echo "<input type = 'submit' name = 'delete' value = 'DELETE' 
							  style='background:#dc3545; color:white; border:none; padding:4px 10px; border-radius:4px; cursor:pointer; font-size:0.85em; 
							  margin-left:10px; transition:background 0.2s;'
							  onmouseover='this.style.background=\"#c82333\"' 
							  onmouseout='this.style.background=\"#dc3545\"'>";
					echo "</form>";				
				}
				
				echo "</div>";
			}
		
		} else {
			echo "<p>No comments yet. Be the first!</p>";
		}
		
		
	}
	
	
	/**
	  * Log In function with rate limiting (max 3 attempts per 24h)
	  *
	  * @param mysqli $conn DB connection object 
	  * @param string $advice_file Path of advice page
	  *
	*/
	function logIn($conn, $advice_file){
		$logInErr = "";
		$username = edit_data($_POST["username"] ?? "");
		$blocked_key = "login_blocked_". md5($username);
		if (isset($_COOKIE[$blocked_key])){ 
			$logInErr = "Too many failed login attempts. Please try again in 24 hours.";
		
		}elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["log_in"])) {
			
			if (empty($_POST["username"]) || empty($_POST["password"])){
				
				$logInErr = "Please fill in both username and password";
				
			} else {
				$password = $_POST["password"];
				
				$ps_sql = $conn -> prepare("SELECT id, hash_password FROM traveler WHERE username = ?");
				
				if (!$ps_sql) die("Prepare failed:". $conn->error);
				
				$ps_sql -> bind_param("s", $username);
				$ps_sql -> execute();
				$data = $ps_sql -> get_result();
				
				if ($data -> num_rows === 1) {
					$row = $data -> fetch_assoc();
					$hash_password = $row["hash_password"];
						if (password_verify($password, $hash_password)){
							$userID = $row["id"];
							$_SESSION["user"] = $username;
							$_SESSION["userID"] = $userID;
							
							setcookie("user", $username, time() + 24 * 30 * 3600, "/", "", false, true);
							setcookie("userID", $userID, time() + 24 * 30 * 3600, "/", "", false, true);
							
							$blocked_key = "login_blocked_". md5($username); 
							setcookie("login_attempts", "", time() - 3600, "/");
							setcookie($blocked_key, "", time() -3600, "/");
							
							header("Location: $advice_file");
							exit();
						} 
				} 
				
				$attempts = isset($_COOKIE["login_attempts"]) ? (int)$_COOKIE["login_attempts"] + 1 : 1;
				setcookie("login_attempts", $attempts, time() + 24*3600, "/", "", false, true);
				if ($attempts >= 3) {
					$blocked_key = "login_blocked_". md5($username);
					setcookie($blocked_key, "1", time() + 24 * 3600, "/", "", false, true);
	
					$logInErr = "Too many failed attempts. Try again in 24 hours.";
				} else {
					$logInErr = "Invalid username or password. Attempts left: ". (3 - $attempts);
				}
				
				$ps_sql -> close();	
			}
			$_SESSION["logInErr"] = $logInErr;
		}
		
	}
	
	
	
	/**
	  * Sign Up function with validation
	  *
	  * @param mysqli $conn DB connection object 
	  * @param string $advice_file Path of advice page
	  *
	*/
	function signUp ($conn, $advice_file){
		$username = $email = $password = $conf_password = "";
		$errors = [
		"usernameErr" => "",
		"emailErr" => "",
		"passwordErr" => "",
		"signUpErr" => ""
	];
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sign_up"])){
			if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["conf_password"])){                                             
				
				#Check username
				$username = edit_data($_POST["username"]);
				
				$ps_sql = $conn -> prepare("SELECT COUNT(*) AS cnt FROM traveler WHERE username = ?");
				if (!$ps_sql) die("Prepare failed:". $conn->error);
				
				$ps_sql -> bind_param("s", $username);
				$ps_sql -> execute();
				
				$result = $ps_sql->get_result();
				$row = $result -> fetch_assoc();
				if ($row["cnt"] > 0) $errors["usernameErr"] = "Username already exists. Please choose another one";
				$ps_sql -> close();
				
				#Check email
				$email = edit_data($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$errors["emailErr"] = "Invalid email address";
				}
				
				#Check password
				$password = $_POST["password"];
				$conf_password = $_POST["conf_password"];
				if ($password === $conf_password){
					if (strlen($password) < 8){
						$errors["passwordErr"] = "Password must be at least 8 characters.";
					} else {
						$hash_password = password_hash($password, PASSWORD_DEFAULT);
					}
				} else {
					$errors["passwordErr"] = "Invalid password. Passwords must be same.";
				}
			} else {
				$errors["signUpErr"] = "Invalid input data";
			}
			

			if (!array_filter($errors)){
				$ps_sql =$conn -> prepare("INSERT INTO traveler(username, email, hash_password) VALUES (?, ?, ?)");
				if (!$ps_sql)  die("Prepare failed:". $conn->error);
				
				$ps_sql -> bind_param("sss", $username, $email, $hash_password);
				if ($ps_sql -> execute()){
					$ps_sql -> close();
					$ps_sql = $conn -> prepare("SELECT id FROM traveler WHERE username = ?");
					if (!$ps_sql) die("Prepare failed:". $conn->error);
					$ps_sql -> bind_param("s", $username);
					$ps_sql -> execute();
					
					$result = $ps_sql -> get_result();
					
					$result = $result -> fetch_assoc();
					$ps_sql -> close();
					$userID = $result["id"];
					$_SESSION["user"] = $username;
					$_SESSION["userID"] = $userID;
					setcookie("user", $username, time() + 3600, "/", "", true, true);
					setcookie("userID", $userID, time() + 3600, "/", true, true);
					header("Location: $advice_file");
					exit();
				} else {
					$errors["signUpErr"] = "Error crating account: ". $ps_sql->error;	
				}
			} else {
				$errors["signUpError"] = "All fields are required.";
				
			} 
			
		}
		return $errors;
	}
?>