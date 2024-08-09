<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST['modifySubmit'])){
        if(isset($_POST['nomUser']) && isset($_POST['prenomUser']) && isset($_POST['motPasse']) && isset($_POST['profil']) && isset($_POST['observation'])){
            if(!empty($_POST['nomUser']) && !empty($_POST['prenomUser']) && !empty($_POST['motPasse'])&& !empty($_POST['profil']) && !empty($_POST['observation'])){
                $nomUser = htmlspecialchars($_POST['nomUser']);
                $prenomUser = htmlspecialchars($_POST['prenomUser']);
                $motPasse= htmlspecialchars($_POST['motPasse']);
                $profil= htmlspecialchars($_POST['profil']);
                $observation = htmlspecialchars($_POST['observation']);

                $profil= strtolower($profil);
                $extract_id=$_SESSION["extract_id"];
                $modifyUser = new usersContr();
                $nbrowtab = $modifyUser->contrModifyUser($nomUser,$prenomUser,$motPasse,$profil,$observation,$extract_id);
            }
            else{
                $_SESSION['modifyUserError'] = "You have to fill in the Modify fields!";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
            }
        }
        else{
            $_SESSION['modifyUserError'] = "You have to fill in the Modify fields!";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
        }
    }
    else{
        $_SESSION['modifyUserError'] = "You have to fill in the Modify fields!";
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
    }
?>