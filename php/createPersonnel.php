<?php
    session_start();
    include "../php/includes/class-autoload.inc.php";
    if(isset($_POST["createSubmit"])){
        if(isset($_POST["matricule"]) && isset($_POST["user_status"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["entite"]) && isset($_POST["observation"])){
            if(!empty($_POST["matricule"]) && !empty($_POST["user_status"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["entite"])){
                $matricule=htmlspecialchars($_POST["matricule"]);
                $userStatus=htmlspecialchars($_POST["user_status"]);
                $nom=htmlspecialchars($_POST["nom"]);
                $prenom=htmlspecialchars($_POST["prenom"]);
                $entite=htmlspecialchars($_POST["entite"]);
                $observation=htmlspecialchars($_POST["observation"]);
                $userStatus=strtolower($userStatus);
                $nom=strtolower($nom);
                $prenom=strtolower($prenom);
                $entite=strtolower($entite);
                $insertResult = new Userscontr();
                $insertResult->contrinsertPer($matricule,$userStatus,$nom,$prenom,$entite,$observation);
            }
            else{
                $_SESSION['crPerError'] = "You have to fill in the required fields";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
            }
        }
    }
?>