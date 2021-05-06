<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
	<title>Signup Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="particles-js"></div>
	<section>
		<div class="box">
			<div class="container">
				<div class="form">
					<h2>Signup Form</h2>
					<form action="includes/signup.inc.php" method="POST">
						<div class="inputBox">
							<input type="text" name="fname" placeholder="First name" required>
						</div>
						<div class="inputBox">
							<input type="text" name="lname" placeholder="Last Name" required>
						</div>
						<div class="inputBox">
							<input type="email" name="email" placeholder="Email ID" required>
						</div>
						<div class="inputBox">
							<input type="text" name="uid" placeholder="Username" required>
						</div>
						<div class="inputBox">
							<input type="password" name="pwd" placeholder="Password" required>
						</div>
						<div class="inputBox">
							<input type="password" name="confirmpwd" placeholder="Confirm Password" required>
						</div>
						<div class="inputBox">
							<input type="submit" name="submit" value="Signup">
						</div>
						<?php
						if (isset($_GET["error"])) {
							if ($_GET["error"] == "invalidusername") {
								echo "<p class='forget'>Choose a proper username. </p>";
							}
							else if ($_GET["error"] == "invalidemail") {
								echo "<p class='forget'>Choose a proper email!</p>";
							}
							else if ($_GET["error"] == "emailalreadyexists") {
								echo "<p class='forget'>Email that you have entered is already exist. </p>";
							}
							else if ($_GET["error"] == "pwdnotstrong") {
								echo "<p class='forget'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. </p>";
							}
							else if ($_GET["error"] == "passwordsdoesnotmatch") {
								echo "<p class='forget'>Passwords doesn't match. </p>";
							}
							else if ($_GET["error"] == "failedtoinsertdata") {
								echo "<p class='forget'>Something went wrong, try again!</p>";
							}
							else if ($_GET["error"] == "usernametaken") {
								echo "<p class='forget'>Username already taken. </p>";
							}
						}
						?>
						<p class="forget">Already have a account ? <a href="login.php">Login</a></p>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="js/particles.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>