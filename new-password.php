<?php

@$selector = $_GET["selector"];
@$validator = $_GET["validator"];

?>
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
    <title>New Password</title>
</head>
<body>
    <div id="particles-js"></div>
    <section>
		<div class="box">
			<div class="container-f">
				<div class="form">
					<h2>New Password</h2>
					<form action="includes/reset-password.inc.php" method="POST">
                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                    <input type="hidden" name="validator" value="<?php echo $validator ?>">
						<div class="inputBox">
							<input type="password" name="pwd" placeholder="Password">
						</div>
                        <div class="inputBox">
							<input type="password" name="confirmpwd" placeholder="Confirm Password">
						</div>
						<div class="inputBox">
							<input type="submit" name="reset-submit" value="Reset">
						</div>
						<?php
						if (isset($_GET["info"])) {
							if ($_GET["info"] == "pwdupdated") {
								echo "<p class='forget'>Password Updated. <a href='login.php'>Login</a></p>";
							}
						}
						else {
							if (isset($_GET["error"])) {
								if ($_GET["error"] == "pwdnotsame") {
									echo "<p class='forget'>Password doesn't match.</p>";
								}
								else if ($_GET["error"] == "pwdempty") {
									echo "<p class='forget'>Password cannot be empty.</p>";
								}
								else if ($_GET["error"] == "pwdnotstrong") {
									echo "<p class='forget'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. </p>";
								}
								else if ($_GET["error"] == "tokenexpired") {
									echo "<p class='forget'>You need to re-submit your request because token has been expired.</p>";
								}
								else if ($_GET["error"] == "stmtfailed") {
									echo "<p class='forget'>Something went wrong </p>";
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