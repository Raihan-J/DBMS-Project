<?php
session_start();
$username = $_SESSION['useruid'];
if($username == false){
  header('Location: login.php');
}
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
    <link rel="stylesheet" href="css/welcome.css">
    <title>Welcome</title>
</head>
<body>
    <section>
        <div class="container">
            <header>
                <a href="index.php" class="logo">DBMS</a>
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href='myprofile.php'>Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </header>
            <div class="card">
                <div class="content">
                    <h2>01</h2>
                    <h3>Study Materials</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Natus error, facilis perferendis labore obcaecati cupiditate! 
                        Quae, suscipit velit culpa delectus provident unde iusto consequuntur 
                        voluptate nam esse at consectetur laborum?
                    </p>
                    <a href="notes.php">Read More</a>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <h2>02</h2>
                    <h3>Calculator</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Natus error, facilis perferendis labore obcaecati cupiditate! 
                        Quae, suscipit velit culpa delectus provident unde iusto consequuntur 
                        voluptate nam esse at consectetur laborum?
                    </p>
                    <a href="calculator.php">Calculate</a>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <h2>03</h2>
                    <h3>Tower Stack Game</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Natus error, facilis perferendis labore obcaecati cupiditate! 
                        Quae, suscipit velit culpa delectus provident unde iusto consequuntur 
                        voluptate nam esse at consectetur laborum?
                    </p>
                    <a href="stackgame.php">Play</a>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="js/vanilla-tilt.js"></script>
    <script type="text/javascript" src="js/config-tilt.js"></script>
</body>
</html>