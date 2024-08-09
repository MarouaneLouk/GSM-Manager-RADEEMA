<?php
    session_start();
    include "../php/includes/class-autoload.inc.php";
    if(isset($_POST["createSubmit"])){
        if(isset($_POST["nomEntite"]) && isset($_POST["typeEntite"]) && isset($_POST["entiteMere"])){
            if(!empty($_POST["nomEntite"]) && !empty($_POST["typeEntite"]) && !empty($_POST["entiteMere"])){
                $nomEntite=htmlspecialchars($_POST["nomEntite"]);
                $typeEntite=htmlspecialchars($_POST["typeEntite"]);
                $entiteMere=htmlspecialchars($_POST["entiteMere"]);
                $nomEntite=strtolower($nomEntite);
                $typeEntite=strtolower($typeEntite);
                $insertResult = new Userscontr();
                $insertResult->contrinsertEntite($nomEntite,$typeEntite,$entiteMere);
            }
            else{
                $_SESSION['crEntiteError'] = "You have to fill in the required fields";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
            }
        }
    }
?>