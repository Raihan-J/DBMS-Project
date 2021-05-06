<?php
// For Signup Page
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdstrength($pwd) {
    $uppercase = preg_match('@[A-Z]@', $pwd);
    $lowercase = preg_match('@[a-z]@', $pwd);
    $number    = preg_match('@[0-9]@', $pwd);
    $specialChars = preg_match('@[^\w]@', $pwd);
    $result;
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pwd) < 8) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $confirmpwd) {
    $result;
    if ($pwd !== $confirmpwd) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    
    $sql = "SELECT * FROM users WHERE usersuid = ? OR usersemail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row =mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function emailExists($conn, $email) {
    
    $sql = "SELECT * FROM users WHERE usersemail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=emailtaken");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row =mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $firstname, $lastname, $email, $username, $pwd, $code, $status) {
    $sql = "INSERT INTO users (usersfname, userslname, usersemail, usersuid, userspwd, userscode, usersstatus) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=failedtoinsertdata");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssis", $firstname, $lastname, $email, $username, $hashedPwd, $code, $status);
    if (mysqli_stmt_execute($stmt) == true) {
        mysqli_stmt_close($stmt);
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'SMTP Host';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'SMTP username';
            $mail->Password   = 'SMTP password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
        
            //Recipients
            $mail->setFrom('senders email', 'DBMS');
            $mail->addAddress($email);
            $mail->addReplyTo('someone@somewhere.com', 'Name');
        
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification Code';
            $mail->Body    = "<table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
            <tbody><tr>
            <td>
            <table border='0' align='center' width='510' cellpadding='0' cellspacing='0'>
            <tbody><tr>
            <td align='center'>
            <a href='https://domainname.com' style='display:block;border-style:none!important;border:0!important' target='_blank' data-saferedirecturl=''><img width='131' height='45' border='0' style='display:block;width:131px;height:45px' src='Mail logo in images folder upload it to any image hosting sites and paste the url here' alt='Logo' class='CToWUd'></a>
            </td>
            </tr>
            <tr><td height='40' style='font-size:40px;line-height:40px'>&nbsp;</td></tr>
            <tr>
            <td>
            <table border='0' width='480' align='center' cellpadding='0' cellspacing='0'>
            <tbody><tr>
            <td align='center' style='color:#8189a1;font-size:16px;font-family:Arial,sans-serif;line-height:32px;'>
            <div style='line-height:32px' align='center'>
            <div style='color:#646b81;font-size:32px;font-family:Arial,sans-serif;line-height:30px;'>Hi $username,</div>
            <p>&nbsp;</p>
            <p style='color:#8189a1;font-size:16px;font-family:Arial,sans-serif;line-height:32px' align='center'>Your email verification code is $code, please click the link below for verification. </p>
            <p>&nbsp;</p>
            <div align='center'>
            <table border='0' align='center' width='250' cellpadding='0' cellspacing='0' bgcolor='191D24' style='border-radius:50px'>
            <tbody><tr><td height='13' style='font-size:13px;line-height:13px'>&nbsp;</td></tr>
            <tr>
            <td align='center' style='color:#ffffff;font-size:16px;font-family:Arial,sans-serif'>
            <div style='line-height:24px' align='center'>
            <a href='https://domainname.com/verify.php' style='color:#ffffff;text-decoration:none' target='_blank' data-saferedirecturl=''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Verify&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </div>
            </td>
            </tr>
            <tr><td height='13' style='font-size:13px;line-height:13px'>&nbsp;</td></tr>
            </tbody></table></div>
            </div>
            </td>
            </tr>
            </tbody></table>
            </td>
            </tr>
            <tr><td height='50' style='font-size:50px;line-height:50px'>&nbsp;</td></tr>
            <tr>
            <td align='center' style='color:#afb6c6;font-size:12px;font-family:Arial,sans-serif;line-height:22px'>
            <div style='line-height:22px;font-family:Arial,sans-serif' align='center'>
            This email was sent from DBMS Project.
            </div>
            </td>
            </tr>
            <tr><td height='40' style='font-size:40px;line-height:40px'>&nbsp;</td></tr>
            </tbody></table>
            </td>
            </tr>
            </tbody></table>";
            $mail->send();
            header("Location: ../verify.php?info=success");
            exit();
        } catch (Exception $e) {
            header("Location: ../verify.php?error=Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            exit();
        }
    }
}

function profileimg($conn, $username, $profilestatus) {
    $sqlimg = "INSERT INTO profileimg (usersuid, pic_status) VALUES ('$username', '$profilestatus');";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlimg)) {
        header("location: ../signup.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function emailVerify($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersuid = ? OR usersemail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $fetch = mysqli_fetch_assoc($resultData);
    $status = $fetch['usersstatus'];
    if ($status == 'verified') {
        return $status;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// For login Page

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    $emailVerify = emailVerify($conn, $username, $username);

    if ($emailVerify === false) {
        header("location: ../login.php?error=verifyemail");
        exit();
    }

    $pwdHashed = $uidExists["userspwd"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if ($checkpwd === false) {
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    if($status == 'unverified') {
        header("Location: ../login.php?error=verifyyouremail");
        exit();
    }
    else if ($checkpwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersid"];
        $_SESSION["useruid"] = $uidExists["usersuid"];
        header("location: ../welcome.php");
        exit();
    }
}
?>