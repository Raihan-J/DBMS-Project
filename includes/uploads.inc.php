<?php
@session_start();
$username = $_SESSION['useruid'];
require_once 'dbh.inc.php';

$file = $_FILES['file'];
$filename = $file['name'];
$filetmpname = $file['tmp_name'];
$filesize = $file['size'];
$fileerror = $file['error'];
$filetype = $file['type'];

$fileext = explode('.', $filename);
$fileactualext = strtolower(end($fileext));

// $allowed = array('jpg', 'jpeg', 'png', 'gif');

$allowed = array('jpg');

if (in_array($fileactualext, $allowed)) {
    if ($fileerror === 0) {
        if ($filesize < 1000000) {
            $filenamenew = "profile".$username.".".$fileactualext;
            $filedestination = '../uploads/'.$filenamenew;
            move_uploaded_file($filetmpname, $filedestination);
            $stats = "0";
            $sql = "UPDATE profileimg SET pic_status = '$stats' WHERE usersuid='$username';";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: test.php?error=stmterror");
                exit();
            } else {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            header("Location: ../myprofile.php?info=profileupdated");
            exit();

        } else {
            header("Location: ../myprofile.php?error=filetoobig");
            exit();
        }
    } else {
        header("Location: ../myprofile.php?error=uploadfailed");
        exit();
    }
} else {
    header("Location: ../myprofile.php?error=filenotsupported");
    exit();
}

?>