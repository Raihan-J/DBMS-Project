<?php
session_start();
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
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/about.css">
    <title>About US</title>
</head>
<body>
    <section>
        <div class="container">
            <header>
                <a href="index.php" class="logo">DBMS</a>
                <ul>
                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<li><a href='welcome.php'>Home</a></li>";
                        echo "<li><a href='myprofile.php'>Profile</a></li>";
                        echo "<li><a href='logout.php'>Logout</a></li>";
                        echo "<li><a href='about.php' class='active'>About</a></li>";
                    }
                    else {
                        echo "<li><a href='login.php'>Login</a></li>";
                        echo "<li><a href='signup.php'>Signup</a></li>";
                        echo "<li><a href='about.php' class='active'>About</a></li>";
                    }
                    ?>
                </ul>
            </header>
            <div class="card">
                <div class="content">
                    <div class="imgbx"><img src="images/user.jpg" alt=""></div>
                    <div class="contentbx">
                        <h3>Raihan Jetham<br><span></span></h3>
                    </div>
                </div>
                <ul class="sci">
                    <li style="--i:1">
                        <a href="https://github.com/Raihan-J"><i class="fab fa-github" aria-hidden="true"></i></a>
                    </li>
                    <li style="--i:2">
                        <a href="#"><i class="fas fa-globe" aria-hidden="true"></i></a>
                    </li>
                    <li style="--i:3">
                        <a href="#"><i class="far fa-envelope" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="content">
                    <div class="imgbx"><img src="images/user.jpg" alt=""></div>
                    <div class="contentbx">
                        <h3>Mahesh Biradar<br><span></span></h3>
                    </div>
                </div>
                <ul class="sci">
                    <li style="--i:1">
                        <a href="https://github.com/mahesh12-byte"><i class="fab fa-github" aria-hidden="true"></i></a>
                    </li>
                    <li style="--i:2">
                        <a href=""><i class="fas fa-globe" aria-hidden="true"></i></a>
                    </li>
                    <li style="--i:3">
                        <a href="#"><i class="far fa-envelope" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="content">
                    <div class="imgbx"><img src="images/user.jpg" alt=""></div>
                    <div class="contentbx">
                        <h3>Aftab Mansuri<br><span></span></h3>
                    </div>
                </div>
                <ul class="sci">
                    <li style="--i:1">
                        <a href="https://github.com/Aftab-Fury"><i class="fab fa-github" aria-hidden="true"></i></a>
                    </li>
                    <li style="--i:2">
                        <a href="#"><i class="fas fa-globe" aria-hidden="true"></i></a>
                    </li>
                    <li style="--i:3">
                        <a href="#"><i class="far fa-envelope" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>