<?php
    session_start();
    include "../php/includes/class-autoload.inc.php";
    if(isset($_POST["createSubmit"])){
        if(isset($_POST["numero"]) && isset($_POST["code"]) && isset($_POST["typePuce"]) && isset($_POST["observation"])){
            if(!empty($_POST["numero"]) && !empty($_POST["code"]) && !empty($_POST["typePuce"])){
                $numero=htmlspecialchars($_POST["numero"]);
                $code=htmlspecialchars($_POST["code"]);
                $typePuce=htmlspecialchars($_POST["typePuce"]);
                $observation=htmlspecialchars($_POST["observation"]);
                $typePuce=strtolower($typePuce);
                $insertResult = new Userscontr();
                $insertResult->contrinsertPuce($numero,$code,$typePuce,$observation);
            }
            else{
                $_SESSION['crPuceError'] = "You have to fill in the required fields";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
            }
        }
    }
?>