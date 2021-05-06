<?php

$servername = "localhost:3306";
$dbusername = "DB UserName";
$dbpassword = "DB Password Here";
$dbname = "DB Name Here";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>