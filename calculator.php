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
    <link rel="stylesheet" href="css/calc.css">
    <title>Calculator</title>
</head>
<body>
    <div id="particles-js"></div>
    <div class="container">
        <form class="calculator" name="calc">
            <input type="text" readonly class="value" name="txt"/>
            <span class="num clear" onclick="calc.txt.value = ''">c</span>
            <span class="num" onclick="document.calc.txt.value += '/'">/</span>
            <span class="num" onclick="document.calc.txt.value += '*'">*</span>
            <span class="num" onclick="document.calc.txt.value += '7'">7</span>
            <span class="num" onclick="document.calc.txt.value += '8'">8</span>
            <span class="num" onclick="document.calc.txt.value += '9'">9</span>
            <span class="num" onclick="document.calc.txt.value += '-'">-</span>
            <span class="num" onclick="document.calc.txt.value += '4'">4</span>
            <span class="num" onclick="document.calc.txt.value += '5'">5</span>
            <span class="num" onclick="document.calc.txt.value += '6'">6</span>
            <span class="num plus" onclick="document.calc.txt.value += '+'">+</span>
            <span class="num" onclick="document.calc.txt.value += '1'">1</span>
            <span class="num" onclick="document.calc.txt.value += '2'">2</span>
            <span class="num" onclick="document.calc.txt.value += '3'">3</span>
            <span class="num" onclick="document.calc.txt.value += '0'">0</span>
            <span class="num" onclick="document.calc.txt.value += '00'">00</span>
            <span class="num" onclick="document.calc.txt.value += '.'">.</span>
            <span class="num equal" onclick="document.calc.txt.value = eval(calc.txt.value)">=</span>
        </form>
    </div>
    <script src="js/particles.min.js"></script>
	<script src="js/app.js"></script>
    <script type="text/javascript" src="js/vanilla-tilt.js"></script>
    <script type="text/javascript" src="js/config-calc.js"></script>
</body>
</html>