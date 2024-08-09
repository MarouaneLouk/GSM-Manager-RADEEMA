<?php
    session_start();
    include '../php/includes/class-autoload.inc.php';
    if(isset($_POST['modifySubmit'])){
        if(isset($_POST['matricule']) && isset($_POST['user_status']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['entite']) && isset($_POST['observation'])){
            if(!empty($_POST['matricule']) && !empty($_POST['user_status']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['entite']) && !empty($_POST['observation'])){
                $matricule = htmlspecialchars($_POST['matricule']);
                $user_status = htmlspecialchars($_POST['user_status']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $entite = htmlspecialchars($_POST['entite']);
                $observation = htmlspecialchars($_POST['observation']);

                $user_status = strtolower($user_status);
                $nom = strtolower($nom);
                $prenom = strtolower($prenom);
                $entite = strtolower($entite);
                $extract_id=$_SESSION["extract_id"];
                $modifyPers = new usersContr();
                $nbrowtab = $modifyPers->contrModifyPers($matricule,$user_status,$nom,$prenom,$entite,$observation,$extract_id);
            }
            else{
                $_SESSION['modifyPersError'] = "You have to fill in the Modify fields!";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
            }
        }
        else{
            $_SESSION['modifyPersError'] = "You have to fill in the Modify fields!";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
        }
    }
    else{
        $_SESSION['modifyPersError'] = "You have to fill in the Modify fields!";
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
    }
?>