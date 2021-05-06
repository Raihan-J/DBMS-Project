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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Forget Password</title>
</head>
<body>
    <div id="particles-js"></div>
    <section>
		<div class="box">
			<div class="container-f">
				<div class="form">
					<h2>Forget Password</h2>
					<form action="includes/forget-password.inc.php" method="POST">
						<div class="inputBox">
							<input type="email" name="emailid" placeholder="Email ID">
						</div>
						<div class="inputBox">
							<input type="submit" name="reset-request" value="Reset">
						</div>
						<?php
						if (isset($_GET["info"])) {
							if ($_GET["info"] == "success") {
								echo "<p class='forget'>Check your e-mail!</p>";
							}
						}
						else {
							if (isset($_GET["error"])) {
								if ($_GET["error"] == "emailempty") {
									echo "<p class='forget'>Email cannot be empty..</p>";
								}
								else if ($_GET["error"] == "invalidemail") {
									echo "<p class='forget'>It's look like you don't have a account yet!. <a href='signup.php'>Sign Up</a></p>";
								}
							}
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</section>
    <script src="js/particles.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>