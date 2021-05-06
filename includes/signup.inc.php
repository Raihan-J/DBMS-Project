<?php

if (isset($_POST["submit"])) {

    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $confirmpwd = $_POST["confirmpwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invalidusername");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdstrength($pwd) !==false) {
        header("location: ../signup.php?error=pwdnotstrong");
        exit();
    }
    if (pwdMatch($pwd, $confirmpwd) !== false) {
        header("location: ../signup.php?error=passwordsdoesnotmatch");
        exit();
    }
    if (emailExists($conn, $email) !== false) {
        header("location: ../signup.php?error=emailalreadyexists");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    
    $code = rand(999999, 111111);
    $status = "notverified";
    $profilestatus = "1";

    profileimg($conn, $username, $profilestatus);
    createUser($conn, $firstname, $lastname, $email, $username, $pwd, $code, $status);

}
else {
    header("location: ../signup.php");
    exit();
}

?>