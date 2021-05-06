<?php
@session_start();
$id = $_SESSION['useruid'];
print_r($id);
require_once 'dbh.inc.php';

if (isset($_POST["delete-acc"])) {
    $sql = "DELETE FROM users WHERE usersuid='$id';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../myprofile.php?error=stmtfailed");
        exit();
    } else {
        $delete = mysqli_query($conn, $sql);
        header("Location: logout.inc.php?info=accountdeleted");
        exit();
    }
} else {
    header("Location: ../myprofile.php");
    exit();
}
?>