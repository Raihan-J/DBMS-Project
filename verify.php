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
    <title>Verify Email</title>
</head>
<body>
    <div id="particles-js"></div>
    <section>
		<div class="box">
			<div class="container-f">
				<div class="form">
					<h2>Email Verification</h2>
					<form action="includes/verify.inc.php" method="POST">
						<div class="inputBox">
							<input type="number" name="otp" placeholder="Enter verification code" required>
						</div>
						<div class="inputBox">
							<input type="submit" name="check" value="Submit">
						</div>
						<?php
						if (isset($_GET["info"])) {
							if ($_GET["info"] == "success") {
								echo "<p class='forget'>We've sent a verification code to your email.</p>";
							}
							else if ($_GET["info"] == "emailverified") {
								echo "<p class='forget'>Email Verified Successfully. <a href='login.php'>Login</a></p>";
							}
						}
						else {
							if (isset($_GET["error"])) {
								if ($_GET["error"] == "invalidcode") {
									echo "<p class='forget'>Invalid OTP. </p>";
								}
								else if ($_GET["error"] == "failed") {
									echo "<p class='forget'>Something went wrong. </p>";
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