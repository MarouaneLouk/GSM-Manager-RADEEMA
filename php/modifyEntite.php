<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST['modifySubmit'])){
        if(isset($_POST['nomEntite']) && isset($_POST['typeEntite']) && isset($_POST['entiteMere'])){
            if(!empty($_POST['nomEntite']) && !empty($_POST['typeEntite']) && !empty($_POST['typeEntite'])){
                $nomEntite = htmlspecialchars($_POST['nomEntite']);
                $typeEntite = htmlspecialchars($_POST['typeEntite']);
                $entiteMere = htmlspecialchars($_POST['entiteMere']);
                $nomEntite = strtolower($nomEntite);
                $typeEntite = strtolower($typeEntite);
                $entiteMere = strtolower($entiteMere);
                $extract_id=$_SESSION["extract_id"];
                $modifyEntite = new usersContr();
                $nbrowtab = $modifyEntite->contrModifyEntite($nomEntite,$typeEntite,$entiteMere,$extract_id);
            }
            else{
                $_SESSION['modifyEntiteError'] = "You have to fill in the Modify fields!";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
            }
        }
        else{
            $_SESSION['modifyEntiteError'] = "You have to fill in the Modify fields!";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
        }
    }
    else{
        $_SESSION['modifyEntiteError'] = "You have to fill in the Modify fields!";
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
    }
?>