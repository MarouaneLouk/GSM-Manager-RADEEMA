<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    
    if (isset($_POST['chngPwdSub'])) {
        if (isset($_POST['CurrMp']) && isset($_POST['NewMp'])) {
            if (!empty($_POST['CurrMp']) && !empty($_POST['NewMp'])) {
                $currPwd = htmlspecialchars($_POST["CurrMp"]);
                $newPwd = htmlspecialchars($_POST["NewMp"]);
                $currPwd_DB = new UsersView();
                $currPwd_DB = $currPwd_DB->getPwdById($_SESSION['Id_User']);
    
                if ($currPwd === $currPwd_DB) {
                    $modifyPwd = new UsersContr();
                    $modifyPwd->ModifyPwd($newPwd,$_SESSION['Id_User']);
                    $_SESSION['chpwdsuccess'] = "Password Updated Successfully";
                } else {
                    $_SESSION['chpwderror'] = "Incorrect Password";
                }
            } else {
                $_SESSION['chpwderror'] = "You have to fill in the fields";
            }
        } else {
            $_SESSION['chpwderror'] = "You have to fill in the fields";
        }
    
        // Redirect to the same page without query parameters
        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../html/index.php';
        header("Location: $redirectUrl");
        exit();
    }
?>