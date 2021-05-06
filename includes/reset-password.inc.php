<?php

if (isset($_POST["reset-submit"])) {
    
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pwd = $_POST["pwd"];
    $confirmpwd = $_POST["confirmpwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    if (empty($pwd) || empty($confirmpwd)) {
        header("Location: ../new-password.php?selector=$selector&validator=$validator&error=pwdempty");
        exit();
    } elseif (pwdstrength($pwd) !==false) {
        header("location: ../new-password.php?selector=$selector&validator=$validator&error=pwdnotstrong");
        exit();
    } else if ($pwd !== $confirmpwd) {
        header("Location: ../new-password.php?selector=$selector&validator=$validator&error=pwdnotsame");
        exit();
    }

    $currentdate = date("U");

    $sql = "SELECT * FROM pwdreset WHERE pwdresetselector=? AND pwdresetexpries >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../new-password.php?selector=$selector&validator=$validator&error=stmtfailed");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentdate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            header("Location: ../new-password.php?error=tokenexpired");
            exit();
        } else {
            
            $tokenbin = hex2bin($validator);
            $tokencheck = password_verify($tokenbin, $row["pwdresettoken"]);

            if ($tokencheck === false) {
                header("Location: ../new-password.php?&error=tokenexpired");
                exit();
            } elseif ($tokencheck === true) {
                
                $tokenemail = $row['pwdresetemail'];

                $sql = "SELECT * FROM users WHERE usersemail=?;";
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../new-password.php?selector=$selector&validator=$validator&error=usernotfound");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenemail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        header("Location: ../new-password.php?selector=$selector&validator=$validator&error=stmtfailed");
                        exit();
                    } else {
                        
                        $sql = "UPDATE users SET userspwd=? WHERE usersemail=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../new-password.php?selector=$selector&validator=$validator&error=stmtfailed");
                            exit();
                        } else {
                            $newpwdhashed = password_hash($pwd, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newpwdhashed, $tokenemail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdresetemail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../new-password.php?selector=$selector&validator=$validator&error=stmtfailed");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenemail);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                                header("Location: ../new-password.php?info=pwdupdated");
                                exit();
                            }
                        }
                        
                    }
                }
            }
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}
?>