<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST['modifySubmit'])){
        if(isset($_POST['puce']) && isset($_POST['personnel']) && isset($_POST['fullName']) && isset($_POST['dateAffectation']) && isset($_POST['dateDesaffectation'])){
            if(!empty($_POST['puce']) && !empty($_POST['personnel']) && !empty($_POST['fullName'])&& !empty($_POST['dateAffectation']) && !empty($_POST['dateDesaffectation'])){
                $puce = htmlspecialchars($_POST['puce']);
                $personnel = htmlspecialchars($_POST['personnel']);
                $fullName= htmlspecialchars($_POST['fullName']);
                $dateAffectation= htmlspecialchars($_POST['dateAffectation']);
                $dateDesaffectation = htmlspecialchars($_POST['dateDesaffectation']);

                $fullName= strtolower($fullName);
                $extract_id=$_SESSION["extract_id"];
                $modifyAffpuce = new UsersContr();
                $nbrowtab = $modifyAffpuce->contrModifyAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation,$extract_id);
            }
            else{
                $_SESSION['modifyAffpuceError'] = "You have to fill in the Modify fields!";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
            }
        }
        else{
            $_SESSION['modifyAffpuceError'] = "You have to fill in the Modify fields!";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
        }
    }
    else{
        $_SESSION['modifyAffpuceError'] = "You have to fill in the Modify fields!";
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
    }
?>