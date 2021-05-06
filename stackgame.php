<?php
session_start();
$username = $_SESSION['useruid'];
if($username == false){
  header('Location: login.php');
}
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="stylesheet" href="css/stack.css">
    <title>Tower Stack Game</title>
</head>
<body>
    <meta name="viewport" content="width=device-width,user-scalable=no">

    <div id="container">
        <div id="game"></div>
        <div id="score">0</div>
        <div id="instructions">Click (or press the spacebar) to place the block</div>
        <div class="game-over">
            <h2>Game Over</h2>
            <p>You did great, you're the best.</p>
            <p>Click or spacebar to start again</p>
        </div>
        <div class="game-ready">
            <div id="start-button">Start</div>
            <div></div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/r83/three.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js'></script>
    <script src="js/stack.js"></script>
</body>
</html>
