<?php
    session_start();
    include "../php/includes/class-autoload.inc.php";
    if(isset($_POST["createSubmit"])){
        if(isset($_POST["puce"]) && isset($_POST["personnel"]) && isset($_POST["fullName"]) && isset($_POST['dateAffectation']) && isset($_POST['dateDesaffectation'])){
            if(!empty($_POST["puce"]) && !empty($_POST["personnel"]) && !empty($_POST["fullName"]) && !empty($_POST['dateAffectation']) && !empty($_POST['dateDesaffectation'])){
                $puce=htmlspecialchars($_POST["puce"]);
                $personnel=htmlspecialchars($_POST["personnel"]);
                $fullName=htmlspecialchars($_POST["fullName"]);
                $dateAffectation=htmlspecialchars($_POST["dateAffectation"]);
                $dateDesaffectation=htmlspecialchars($_POST["dateDesaffectation"]);
                $fullName=strtolower($fullName);
                $insertResult = new Userscontr();
                $insertResult->contrinsertAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation);
            }
            else{
                $_SESSION['crAffpuceError'] = "You have to fill in the required fields";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
            }
        }
    }
?>