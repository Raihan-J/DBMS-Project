<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
	<title>Login Page</title>
</head>
<body>
	<div id="particles-js"></div>
	<section>
		<div class="box">
			<div class="container">
				<div class="form">
					<h2>Login Form</h2>
					<form action="includes/login.inc.php" method="POST">
						<div class="inputBox">
							<input type="text" name="name" placeholder="Username / Email" required>
						</div>
						<div class="inputBox">
							<input type="password" name="pwd" placeholder="Password" required>
						</div>
						<div class="inputBox">
							<input type="submit" name="submit-login" value="Login">
						</div>
						<?php
						if (isset($_GET["error"])) {
							if ($_GET["error"] == "wronglogin") {
								echo "<p class='forget'>Incorrect Username / Email. </p>";
							}
							else if ($_GET["error"] == "wrongpassword") {
								echo "<p class='forget'>Incorrect password!</p>";
							}
							else if ($_GET["error"] == "verifyemail") {
								echo "<p class='forget'>It's look like you haven't still verify your email. <a href=verify.php>Verify</a></p>";
							}
						}
						?>
						<p class="forget">Forget Password ? <a href="forget-password.php">Reset Password</a></p>
						<p class="forget">Don't have a acoount ? <a href="signup.php">Sign Up</a></p>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="js/particles.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>