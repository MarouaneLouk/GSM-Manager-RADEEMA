<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST['modifySubmit'])){
        if(isset($_POST['puce']) && isset($_POST['solde']) && isset($_POST['dateDotation']) && isset($_POST['observation'])){
            if(!empty($_POST['puce']) && !empty($_POST['solde']) && !empty($_POST['dateDotation'])&& !empty($_POST['observation'])){
                $puce = htmlspecialchars($_POST['puce']);
                $solde = htmlspecialchars($_POST['solde']);
                $dateDotation= htmlspecialchars($_POST['dateDotation']);
                $observation= htmlspecialchars($_POST['observation']);

                $extract_id=$_SESSION["extract_id"];
                $modifyDotation = new usersContr();
                $nbrowtab = $modifyDotation->contrModifyDotation($puce,$solde,$dateDotation,$observation,$extract_id);
            }
            else{
                $_SESSION['modifyDotationError'] = "You have to fill in the Modify fields!";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
            }
        }
        else{
            $_SESSION['modifyDotationError'] = "You have to fill in the Modify fields!";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
        }
    }
    else{
        $_SESSION['modifyDotationError'] = "You have to fill in the Modify fields!";
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
    }
?>