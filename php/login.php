<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST["submitLogin"])){
        if(isset($_POST["login"]) && isset($_POST["password"])){
            if(!empty($_POST["login"]) && !empty($_POST["password"])){
                $login = htmlspecialchars($_POST["login"]);
                $pwd = htmlspecialchars($_POST["password"]);
                $loginResult = new Userscontr();
                $nbLignes = $loginResult->login($login,$pwd);
                
            } else{
                $_SESSION['ErrorLogin']="You have to fill in the fields!";
                header("location: ../html/index.php");
                exit;
            }
        }
    }
    else{
        $_SESSION['ErrorLogin']="You have to fill in the fields!";
        header("location: ../html/index.php");
        exit;
    }
    
?>