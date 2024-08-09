<?php
   session_start();
   if(@$_SESSION["login_autorisation"]!=="yes"){
      header('location: index.php');
      exit();
   }   
?>
<?php
    include '../php/includes/class-autoload.inc.php';
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
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/popUps.css">
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
        body{
        overflow: scroll;
        overflow-x: hidden;
        }
    </style>
</head>
<body>
<!--==================== HEADER ====================-->
<header class="header" id="header">
<nav class="nav container">
    <div style="display: flex;gap:10px;white-space: nowrap;">
        <a href="HomePage.php" class="nav__logo"><img class="logoImage" src="../images/logoRADEEMA.svg" width="45"></a>
        <span onclick="window.location.href='HomePage.php';" class="gsmManagerText">GSM Manager<div class="RADEEMAtext">RADEEMA</div></span>
    </div>
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="../html/HomePage.php" class="nav__link">Home</a>
            </li>

            <li class="nav__item" onmouseenter="toggleMenu()" onmouseleave="toggleMenu()">
                <a style="cursor: pointer;" class="nav__link">Gestion Organigramme</a>
                <svg class="dropDown" xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                <path d="M1 1L5.5 5.5L10 1" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <ul class="dropDownContainer" id="dropDown">
                    <li><a href="../html/HomePageTabGentite.php" class="nav__link indoors">Gestion Entités</a><svg style="position:absolute;right:18px;margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none"><path d="M1.25 9.75L5.75 5.25L1.25 0.75" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                    <li><a href="../html/HomePageTabGper.php" class="nav__link indoors">Gestion Personnel</a><svg style="position:absolute;right:18px;margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none"><path d="M1.25 9.75L5.75 5.25L1.25 0.75" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                </ul>
            </li>
            <li class="nav__item" onmouseenter="toggleMenu()" onmouseleave="toggleMenu()">
                <a style="cursor: pointer;" class="nav__link">Management Puces</a>
                <svg class="dropDown" xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                <path d="M1 1L5.5 5.5L10 1" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <ul class="dropDownContainer" id="dropDown">
                    <li><a href="../html/HomePageTabGpuce.php" class="nav__link indoors">Gestion Puces</a><svg style="position:absolute;right:18px;margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none"><path d="M1.25 9.75L5.75 5.25L1.25 0.75" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                    <li><a href="../html/HomePageTabAffpuce.php" class="nav__link indoors">Affectation Puces</a><svg style="position:absolute;right:18px;margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none"><path d="M1.25 9.75L5.75 5.25L1.25 0.75" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                    <li><a href="../html/HomePageTabGdotation.php" class="nav__link indoors">Gestion Dotation</a><svg style="position:absolute;right:18px;margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none"><path d="M1.25 9.75L5.75 5.25L1.25 0.75" stroke="rgba(149, 175, 118, 0.799)" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                </ul>
            </li>
            <li class="nav__item">
                <a href="../html/HomePageTabGuser.php" class="nav__link">Gestion User</a>
             </li>
            <li class="nav__item">
                <a href="../html/HomePageTabReporting.php" style="cursor: pointer;" class="nav__link">Reporting</a>
            </li>
            <li class="nav__item deconnexion1">
                <a href="../php/deconnexion.php" class="nav__link">Déconnexion</a>
            </li>
        </ul>

        <!-- Close button -->
        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </div>
    <div class="nav__actions">
        <!-- Toggle mode -->
        <svg width="20" height="20" onclick="reverse()" class="toggle" fill="rgba(149, 175, 118, 0.799)" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="0 0 120 120" enable-background="new 0 0 120 120" xml:space="preserve">
            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
            <g id="SVGRepo_iconCarrier"> <g> <path d="M60,16.005c0,0,0.001,19.736,0.001,43.994c0,24.258-0.001,43.995-0.001,43.995c-24.258,0-43.994-19.736-43.994-43.995 C16.006,35.742,35.742,16.005,60,16.005 M60,5.005C29.627,5.005,5.006,29.626,5.006,60c0,30.372,24.622,54.995,54.994,54.995 S114.995,90.371,114.995,60C114.995,29.626,90.372,5.005,60,5.005L60,5.005z"/> </g> </g>
        </svg>
        <!-- Search button -->
        <i class="ri-search-line nav__search" id="search-btn"></i>
        <!-- Login button -->
        <i class="ri-user-line nav__login" id="login-btn"></i>
        <!-- Toggle button -->
        <div class="nav__toggle" id="nav-toggle">
            <i class="ri-menu-line"></i>
        </div>
        <div class="nav__item">
            <a href="../php/deconnexion.php" class="nav__link deconnexion2">Déconnexion</a>
        </div>
    </div>
</nav>
</header>

<!--==================== SEARCH ====================-->
<div class="search" id="search">
    <form action="" class="search__form">
    <i class="ri-search-line search__icon"></i>
    <input type="search" placeholder="What are you looking for?" class="search__input" list="search-options" id="search-input">
    <datalist id="search-options">
        <option value="Home">
        <option value="Gestion Entités">
        <option value="Gestion Personnel">
        <option value="Gestion Puces">
        <option value="Affectation Puces">
        <option value="Gestion Dotation">
        <option value="Gestion User">
        <option value="Reporting">
    </datalist>
    </form>
    <i class="ri-close-line search__close" id="search-close"></i>
</div>
<script src="../js/searchbar.js"></script>

<!--==================== LOGIN ====================-->
<?php
        $idUser_for_login = $_SESSION["IdUser_for_login"];
        $id_user = $_SESSION['Id_User'];
        $UserInfo = new UsersView();
        $UserName = $UserInfo->getNameById($id_user);
        $UserSurname = $UserInfo->getSurnameById($id_user);
        $loginContructor = $UserName . '_' . $UserSurname . $idUser_for_login . '.gsm';
      ?>
      <div class="login" id="login">
         <form action="../php/changePassword.php" method="POST" class="login__form">
            <img src="../images/anonymousUser.svg" alt="User Image" class="user-pic">
            <h2 class="login__title"><?php echo ucwords($UserName) . ' ' . ucwords($UserSurname);?></h2>
            <hr>
            <div class="sub-menu-link">
                  <img src="../images/changeMp.svg" width="30">
                  <p>Change Mot De Passe</p>
            </div>
            <div class="changePassword">
                  <div>
                     <label for="chMp">Login:</label>
                     <input class="addWeight" type="text" id="tchMp" name="chMp" readonly value="<?php echo $loginContructor; ?>">
                  </div>
                  <div>
                     <label for="CurrMp"><span style="color:red">*</span>Current Password:</label>
                     <input class="addWeight" type="password" id="CurrMp" name="CurrMp" placeholder="Current Password" minlength=8 required>
                  </div>
                  <div>
                     <label for="NewMp"><span style="color:red">*</span>New Password:</label>
                     <input class="addWeight" type="password" id="NewMp" name="NewMp" placeholder="New Password" minlength=8 required>
                  </div>
                  <button name="chngPwdSub" type="submit">Update Password</button>
            </div>
         </form>

         <i class="ri-close-line login__close" id="login-close"></i>
      </div>


<!--==================== MAIN ====================-->
<main class="main">
<div class="table-container">
    <h2 style="margin-left: 6px;">Gestion de dotations</h2>
    <div class="table-header">
        <div class="firstdiv">
            <button class="filterButton filter-btn buttonDiff">
                <svg style="float:left;margin-right:3px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 21 21" fill="none">
                    <g clip-path="url(#clip0_1_1954)">
                    <path d="M12.0109 12.931L20.0129 4.92899V0.927979H0.00787354V4.92899L8.0099 12.931V20.933L12.0109 16.932V12.931Z" fill="#6C7F69"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_1_1954">
                    <rect width="20.0051" height="20.0051" fill="white" transform="translate(0.00787354 0.927979)"/>
                    </clipPath>
                    </defs>
                </svg>
                Filter
            </button>
            <div id="filterPopup" class="popup-overlay">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Filter</h2>
                        <button class="close-btn">
                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"/>
                                
                                <g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#546b52"/> <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#546b52"/> </g>
                                
                            </svg>
                        </button>
                    </div>
                    <div class="popup-body">
                        <form id="filter-form">
                            <div class="form-group">
                                <label for="order-by">Order by</label>
                                <select id="order-by" name="order-by">
                                    <option></option>
                                    <option value="1">Puce</option>
                                    <option value="2">Solde</option>
                                    <option value="3">Date Dotation</option>
                                    <option value="4">Observation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order-direction">Order direction</label>
                                <select id="order-direction" name="order-direction">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <button type="submit" class="apply-btn">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="search-div" style="display: inline;">
                <input class="searchbar" type="text" id="searchTable" placeholder="Search Dotations by Puce, Solde, ...">
                <button class="searchIcon buttonDiff" style="background-color: inherit;"><img style="min-width:18px;" width="18px" src="../images/search.svg"></button>
            </div>
            <span class="items-controller" style="width: 200px;background-color:#e7ede1;padding:8px;border-radius:5px;display:flex;justify-content: center;align-items: center;">
                <h5>Show</h5>
                <select id="itemperpage" style="border-radius:10px;padding:4px 8px;outline: none;border: none;cursor: pointer;margin:0px 10px;">
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="08">08</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="all">All</option>
                </select>
                <h5>Per Page</h5>
            </span>
        </div>
    <div id="popUps">
        <!-- Create Pop-up -->
        <div id="createPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup('createPopup')">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                        
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"/>
                        
                        <g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#546b52"/> <path d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z" fill="#546b52"/> </g>
                        
                    </svg>
                </span>
                <h2>Create Dotation</h2>
                <form action="../php/createDotation.php" method="post">
                    <?php
                    $selectPuce = new UsersView();
                    $selectPuce = $selectPuce->GetSelectPuce();
                    ?>
                    <label for="solde"><span style="color:red">*</span>Solde:</label>
                    <input class="addWeight" type="number" id="solde" name="solde" required min="0" maxlength=5 max="10000">
                    <label for="dateDotation"><span style="color:red">*</span>Date Dotation:</label>
                    <input class="addWeight" type="date" id="dateDotation" name="dateDotation" required>
                    <label for="observation">Obdervation:</label>
                    <input class="addWeight" type="text" id="observation" name="observation">
                    <button type="submit" name="createSubmit">Create</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        if(isset($_SESSION["crDotationError"])){
            echo '<div id="message-container" class="hidden">';
            echo '<p id="message-text">' . $_SESSION["crDotationError"] . '</p>';
            echo '</div>';
            unset($_SESSION['crDotationError']);
        }
        if (isset($_SESSION['chpwdsuccess'])) {
            echo '<div id="message-container" class="hidden">';
            echo '<p id="message-text">' . $_SESSION['chpwdsuccess'] . '</p>';
            echo '</div>';
            unset($_SESSION['chpwdsuccess']);
        }
        
        if (isset($_SESSION['chpwderror'])) {
            echo '<div id="message-container" class="hidden">';
            echo '<p id="message-text">' . $_SESSION['chpwderror'] . '</p>';
            echo '</div>';
            unset($_SESSION['chpwderror']);
        }
        if (isset($_SESSION['deleteDotationError'])) {
            echo '<div id="message-container" class="hidden">';
            echo '<p id="message-text">' . $_SESSION['deleteDotationError'] . '</p>';
            echo '</div>';
            unset($_SESSION['deleteDotationError']);
        }
        if (isset($_SESSION['modifyDotationError'])) {
            echo '<div id="message-container" class="hidden">';
            echo '<p id="message-text">' . $_SESSION['modifyDotationError'] . '</p>';
            echo '</div>';
            unset($_SESSION['modifyDotationError']);
        }
    ?>
    </div>
    <div class="table">
    <form id="modifyForm" action="../php/deleteModifyDotation.php" method="POST">
        <table id="example-table">
            <?php
                $checkUser = new usersContr();
                $checkUser = $checkUser->checkUserById($_SESSION['Id_User']);
            ?>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                    <th onclick="sortTableHeader(1)">Puce<span id="arrow1" class="inactive-arrow"></span></th>
                    <th onclick="sortTableHeader(2)">Solde<span id="arrow2" class="inactive-arrow"></span></th>
                    <th onclick="sortTableHeader(3)">Date Dotation<span id="arrow3" class="inactive-arrow"></span></th>
                    <!-- <th>Entité</th> -->
                    <th onclick="sortTableHeader(4)">Observation<span id="arrow4" class="inactive-arrow"></span></th>
                    <th>View More</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $userTable = new UsersView();
                    $nbrowtab = $userTable->showDotationTable();
                ?>
            </tbody>
        </table>
    </form>
    <script src="../js/checkallrows.js"></script>
    <script src="../js/viewMore.js"></script>
    <script src="../js/searchbarTable.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/filterTable.js"></script>
</div>
    <div class="footer">    
        <button id="downloadexcel"><img style="display: inline;float: left;margin-right: 3px;" src="../images/exportExcel.svg" width="20">Exporter vers fichier Excel</button>
        <div class="pagination">
            <span id="rows-per-page">Rows per page: 10</span>
            <li style="list-style: none;background-color:var(--table-text-color);padding:7px 2px;border-radius:5px;" class="prev"><a style="color:white;padding:7px 12px" href="#" id="prev">&#139;</a></li>
            <li style="list-style: none;background-color:var(--table-text-color);padding:7px 2px;border-radius:5px;" class="next"><a style="color:white;padding:7px 12px" href="#" id="next">&#155;</a></li>
        </div>
    </div>
</div>

</main>
    <!--=============== MAIN JS ===============-->
    <script src="../js/main.js"></script>
    <script src="../js/popUps.js"></script>
    <script src="../js/table.js"></script>
    <script src="../js/table2excel.js"></script>
    <script src="../js/exportAsExcelFile.js"></script>
    </body>
</html>