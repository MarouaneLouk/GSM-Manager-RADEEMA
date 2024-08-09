<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST['modifySubmit'])){
        if(isset($_POST['numero']) && isset($_POST['code']) && isset($_POST['typePuce']) && isset($_POST['observation'])){
            if(!empty($_POST['numero']) && !empty($_POST['code']) && !empty($_POST['typePuce']) && !empty($_POST['observation'])){
                $numero = htmlspecialchars($_POST['numero']);
                $code = htmlspecialchars($_POST['code']);
                $typePuce = htmlspecialchars($_POST['typePuce']);
                $observation = htmlspecialchars($_POST['observation']);

                $typePuce = strtolower($typePuce);
                $extract_id=$_SESSION["extract_id"];
                $modifyPuce = new usersContr();
                $nbrowtab = $modifyPuce->contrModifyPuce($numero,$code,$typePuce,$observation,$extract_id);
            }
            else{
                $_SESSION['modifyPuceError'] = "You have to fill in the Modify fields!";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
            }
        }
        else{
            $_SESSION['modifyPuceError'] = "You have to fill in the Modify fields!";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
        }
    }
    else{
        $_SESSION['modifyPuceError'] = "You have to fill in the Modify fields!";
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
    }
?>