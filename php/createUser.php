<?php
    session_start();
    include "../php/includes/class-autoload.inc.php";
    if(isset($_POST["createSubmit"])){
        if(isset($_POST["nomUser"]) && isset($_POST["prenomUser"]) && isset($_POST["motPasse"]) && isset($_POST["profil"]) && isset($_POST["observation"])){
            if(!empty($_POST["nomUser"]) && !empty($_POST["prenomUser"]) && !empty($_POST["motPasse"]) && !empty($_POST["profil"])){
                $nomUser=htmlspecialchars($_POST["nomUser"]);
                $prenomUser=htmlspecialchars($_POST["prenomUser"]);
                $motPasse=htmlspecialchars($_POST["motPasse"]);
                $profil=htmlspecialchars($_POST["profil"]);
                $observation=htmlspecialchars($_POST["observation"]);
                $profil=strtolower($profil);
                $insertResult = new Userscontr();
                $insertResult->contrinsertUser($nomUser,$prenomUser,$motPasse,$profil,$observation);
            }
            else{
                $_SESSION['userError'] = "You have to fill in the required fields";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
            }
        }
    }
?>