<?php
session_start();
$username = $_SESSION['useruid'];
if($username == false){
  header('Location: login.php');
}
?>
<?php
require_once 'includes/dbh.inc.php';
$sql = "SELECT * FROM users WHERE usersuid = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $fetch = mysqli_fetch_assoc($resultData);
    $fname = $fetch['usersfname'];
    $lname = $fetch['userslname'];
    $email = $fetch['usersemail'];
	mysqli_stmt_close($stmt);
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
	<link rel="stylesheet" type="text/css" href="css/userinfo.css">
	<title>My Profile</title>
</head>
<body>
	<div id="particles-js"></div>
	<section>
		<div class="box">
			<div class="container">
				<div class="form">
					<h2>Account Info</h2>
                    <form action = "includes/uploads.inc.php" method = "POST" enctype = "multipart/form-data">
						<div class="profile-pic-div">
						<?php
								$sqlimg = "SELECT * FROM profileimg WHERE usersuid='$username';";
								$resultimg = mysqli_query($conn, $sqlimg);
								while ($rowimg = mysqli_fetch_assoc($resultimg)) {
										if ($rowimg['pic_status'] == 0) {
											echo "<img src='uploads/profile".$username.".jpg?'".mt_rand()." id='photo'>";
										} else {
											echo "<img src='uploads/profiledefault.jpg' id='photo'>";
										}
								}
							?>
                            <input type="file" name="file" id="file">
                            <label for="file" id="uploadBtn">Choose Photo</label>
                            <button type = "submit"></button>
                        </div>
                    </form>
					<form action="includes/delete.inc.php" method="POST">
						<div class="inputBox">
						<span>First Name</span>
							<input type="text" placeholder=<?php echo $fname?> readonly>
						</div>
						<div class="inputBox">
						<span>Last Name</span>
							<input type="text" placeholder=<?php echo $lname?> readonly>
						</div>
						<div class="inputBox">
						<span>Username</span>
							<input type="text" placeholder=<?php echo $username?> readonly>
						</div>
						<div class="inputBox">
						<span>Email</span>
							<input type="email" placeholder=<?php echo $email?> readonly>
						</div>
						<div class="inputBox">
							<input type="submit" onclick="return confirm('Are you sure?')" name="delete-acc" value="Delete Account">
						</div>
						<?php
						if (isset($_GET["info"])) {
							if ($_GET["info"] == "profileupdated") {
								echo "<p class='forget'>Profile pic updated.</p>";
							}
						}
						else {
							if (isset($_GET["error"])) {
								if ($_GET["error"] == "stmterror") {
									echo "<p class='forget'>Something went wrong...</p>";
								}
								else if ($_GET["error"] == "filetoobig") {
									echo "<p class='forget'>File too big. </p>";
								}
								else if ($_GET["error"] == "uploadfailed") {
									echo "<p class='forget'>Failed to upload profile pic. </p>";
								}
								else if ($_GET["error"] == "filenotsupported") {
									echo "<p class='forget'>File not supported please use jpg. </p>";
								}
							}
						}
						?>
						<p class="forget">Forget Password ? <a href="forget-password.php">Reset Password</a></p>
						<p class="forget">Back to home page. <a href="welcome.php">Home</a></p>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="js/particles.min.js"></script>
	<script src="js/app.js"></script>
    <script src="js/profile.js"></script>
	<script>
	function checkDelete(){
		return confirm('Are you sure ?');
	}
	</script>
</body>
</html>