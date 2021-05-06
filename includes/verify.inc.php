<?php

if(isset($_POST['check'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $otp = $_POST["otp"];  
    $otp_code = mysqli_real_escape_string($conn, $otp);
    $check_code = "SELECT * FROM users WHERE userscode = $otp_code";
    $code_res = mysqli_query($conn, $check_code);

    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['userscode'];
        $email = $fetch_data['usersemail'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users SET userscode = $code, usersstatus = '$status' WHERE userscode = $fetch_code";
        $update_res = mysqli_query($conn, $update_otp);

        if($update_res){
            header('location: ../verify.php?info=emailverified');
            exit();
        }else{
            header('location: ../verify.php?error=failed');
            exit();
            }
        }else{
            header('location: ../verify.php?error=invalidcode');
            exit();
        }
}
else {
    header("location: ../verify.php");
    exit();
}

?>