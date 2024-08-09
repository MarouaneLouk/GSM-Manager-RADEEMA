<?php
    session_start();
    include "../php/includes/class-autoload.inc.php";
    if(isset($_POST["createSubmit"])){
        if(isset($_POST["puce"]) && isset($_POST["solde"]) && isset($_POST["dateDotation"]) && isset($_POST["observation"])){
            if(!empty($_POST["puce"]) && !empty($_POST["solde"]) && !empty($_POST["dateDotation"])){
                $puce=htmlspecialchars($_POST["puce"]);
                $solde=htmlspecialchars($_POST["solde"]);
                $dateDotation=htmlspecialchars($_POST["dateDotation"]);
                $observation=htmlspecialchars($_POST["observation"]);
                $insertResult = new Userscontr();
                $insertResult->contrinsertDotation($puce,$solde,$dateDotation,$observation);
            }
            else{
                $_SESSION['crDotationError'] = "You have to fill in the required fields";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
            }
            exit();
        }
    }
?>