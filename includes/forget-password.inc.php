<?php
 require_once 'phpmailer/Exception.php';
 require_once 'phpmailer/PHPMailer.php';
 require_once 'phpmailer/SMTP.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 $mail = new PHPMailer(true);

if (isset($_POST["reset-request"])) {

    $useremail = $_POST["emailid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (empty($useremail)) {
        header("Location: ../forget-password.php?error=emailempty");
        exit();
    }

    $uidExists = uidExists($conn, $username, $useremail);
    if ($uidExists === false) {
        header("location: ../forget-password.php?error=invalidemail");
        exit();
    }

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "https://domainname.com/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;


    $sql = "DELETE FROM pwdreset WHERE pwdresetemail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../forget-password.php?error=There was an error!");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $useremail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdreset (pwdresetemail, pwdresetselector, pwdresettoken, pwdresetexpries) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../forget-password.php?error=There was an error!");
        exit();
    } else {
        $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $useremail, $selector, $hashedtoken, $expires);
        mysqli_stmt_execute($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

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
        $mail->addAddress($useremail);
        $mail->addReplyTo('someone@somewhere.com', 'Name');
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset your DBMS password';
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
        <p style='color:#8189a1;font-size:16px;font-family:Arial,sans-serif;line-height:32px' align='center'>To reset your DBMS password, please click the link below within the next 60 minutes. </p>
        <p>&nbsp;</p>
        <div align='center'>
        <table border='0' align='center' width='250' cellpadding='0' cellspacing='0' bgcolor='191D24' style='border-radius:50px'>
        <tbody><tr><td height='13' style='font-size:13px;line-height:13px'>&nbsp;</td></tr>
        <tr>
        <td align='center' style='color:#ffffff;font-size:16px;font-family:Arial,sans-serif'>
        <div style='line-height:24px' align='center'>
        <a href='$url' style='color:#ffffff;text-decoration:none' target='_blank' data-saferedirecturl=''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
        header("Location: ../forget-password.php?info=success");
        exit();
    } catch (Exception $e) {
        header("Location: ../forget-password.php?error=Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        exit();
    }

} else {
    header("Location: ../index.php");
    exit();
}
?>