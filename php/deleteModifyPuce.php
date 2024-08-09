<?php
session_start();
include '../php/includes/class-autoload.inc.php';
if(@$_SESSION["login_autorisation"]!=="yes"){
    header('location: index.php');
    exit();
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La gestion des dotations téléphoniques est la systématique utilisée par la régie autonome de distribution d'eau et d'électricité du Marrakech (RADEEMA), afin de gérer les dotations relatives à la consommation des agents soit au niveau de la voix téléphonique ou du data internet.
    La gestion des dotations téléphoniques a pour but de gérer les données de la flotte téléphonique et faciliter la tâche aux administrateurs pour collecter le reporting mensuel ou annuel des dotations téléphoniques.">
    <meta name="author" content="Marouane Loukrissi">
    <title>GSM manager</title>
    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <!-- Indlude your CSS files here -->
    <link rel="stylesheet" href="../css/stylesHomePage.css">
    <!-- <link rel="stylesheet" href="../css/table.css"> -->
    <link rel="stylesheet" href="../css/modifypopUps.css">
    <!-- Open Graph Protocol -->
    <meta property="og:title" content= "GSM Manager Landing Page">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://GSMmanager/homepage">
    <meta property="og:image" content="../images/logoRADEEMA.svg">
    <meta property="og:description" content="La gestion des dotations téléphoniques est la systématique utilisée par la régie autonome de distribution d'eau et d'électricité du Marrakech (RADEEMA), afin de gérer les dotations relatives à la consommation des agents soit au niveau de la voix téléphonique ou du data internet.
    La gestion des dotations téléphoniques a pour but de gérer les données de la flotte téléphonique et faciliter la tâche aux administrateurs pour collecter le reporting mensuel ou annuel des dotations téléphoniques.">
    <meta property="og:locale" content="en_US"/>
    <meta name="og:site_name" content="GSM Manager"/>
    <link rel="icon" href="../images/logoRADEEMA.svg" type="image/svg">
    <link rel="shortcut icon" href="../images/logoRADEEMA.svg">
    <link rel="apple-touch-icon" href="../images/logoRADEEMA.svg">
    <style>
    </style>
</head>
<body style="overflow:hidden">

<?php

    if(isset($_POST['delete'])){
        if(isset($_POST['checkId'])){
            $all_id = $_POST['checkId'];
            $extract_id = array_map('intval', $all_id);
            $deletePuce = new usersContr();
            $nbrowtab = $deletePuce->contrDeletePuce($extract_id);
        }
        else{
            $_SESSION['deletePuceError'] = "No row selected";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
            exit;
        }
    }
    
    else if (isset($_POST['modify'])) {
        if (isset($_POST['checkId'])) {
            $all_id = $_POST['checkId'];
            // Check if only one row is selected
            if (count($all_id) === 1) {

                $extract_id = intval($all_id[0]);
                $_SESSION["extract_id"]=$extract_id;
                $modifyPuceContent = new UsersView();

                $getModifyContentPuceNumero = $modifyPuceContent->getModifyContentPuceNumero($extract_id);
                $getModifyContentPuceCode = $modifyPuceContent->getModifyContentPuceCode($extract_id);
                $getModifyContentPuceType = $modifyPuceContent->getModifyContentPuceType($extract_id);
                $getModifyContentPuceObservation = $modifyPuceContent->getModifyContentPuceObservation($extract_id);
?>              

                <div id="popUps">
                    <div id="modifyPopup" class="popup">
                        <div class="popup-content">
                            <span id="closeButton" class="close">
                                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003">

                                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                    
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"/>
                                    
                                    <g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#546b52"/> <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#546b52"/> </g>
                                    
                                </svg>
                            </span>
                            <script src="../js/popUps.js"></script>
                            <h2>Modify Puce</h2>
                            <form action="modifyPuce.php" method="POST">
                                <label for="numero"><span style="color:red">*</span>Numero:</label>
                                <input class="addWeight" type="tel" id="numero" name="numero" maxlength="10" value="<?php echo $getModifyContentPuceNumero; ?>" required>
                                <label for="code"><span style="color:red">*</span>Code:</label>
                                <input class="addWeight" type="text" id="code" name="code" maxlength="5" value="<?php echo $getModifyContentPuceCode; ?>" required>
                                <label for="typePuce"><span style="color:red">*</span>Type Puce:</label>
                                <select id="typePuce" name="typePuce">
                                    <option value="voix" <?php echo ($getModifyContentPuceType === 'voix') ? 'selected' : ''; ?>>Voix</option>
                                    <option value="data" <?php echo ($getModifyContentPuceType === 'data') ? 'selected' : ''; ?>>Data</option>
                                </select>
                                <label for="observation">Observation:</label>
                                <input class="addWeight" type="text" id="observation" name="observation" value="<?php echo $getModifyContentPuceObservation; ?>">
                                <button type="submit" name="modifySubmit">Modify</button>
                            </form>
                        </div>
                    </div>
                </div>
<?php
            } else {
                $_SESSION['modifyPuceError'] = "Please select exactly one row for modification.";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            }
        }
        else{
            $_SESSION['modifyPuceError'] = "Please select a row";
            header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
            exit;
        }
    }
    else{
        header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
        exit;
    }
?>
</body>
<script src="../js/main.js"></script>
<script type="text/javascript" src="../js/table.js"></script>