<?php
	session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>User Login</title>
		<link rel="stylesheet" type="text/css" href="css/registration.css">
	</head>
	<body>
		<div id="wrapper">

			<div id="testing" class="hidden">
				<!-- hide this for now; may need it for debugging later -->
				<?php
					echo "<p>" . $_SESSION["birth_date"] . "</p>";
				?>
			</div>

			<h3 id="validation">
				<?php
					if (isset($_SESSION["errors"]))
					{
						//display all error messages in "errors" array
						foreach($_SESSION["errors"] as $error){
							echo "<p id='err_message'>" . $error . "</p>";
						}
					}
				?>
			</h3>

			<form id="user_login" action="process.php" method="post">
				<div>
					<label for="first_name">First Name: </label>
					<input type="text" name="first_name" id="first_name" />
				</div>
				<div>
					<label for="last_name">Last Name: </label>
					<input type="text" name="last_name" id="last_name" />
				</div>
				<div>
					<label for="email">Email: </label>
					<input type="text" name="email" id="email" />
				</div>
				<div>		
					<label for="birth_date">Birth Date: </label>
					<input type="date" name="birth_date" id="birth_date" />
				</div>
				<div>
					<label for="password">Password: </label>
					<input type="password" name="password" id="password" />
				</div>
				<div>
					<label for="confirm_password">Confirm Password: </label>
					<input type="password" name="confirm_password" id="confirm_password" />
				</div>
				<input type="submit" value="Login" />
			</form>
		</div>
	</body>
</html>
<?php
	unset($_SESSION["errors"]);
?>