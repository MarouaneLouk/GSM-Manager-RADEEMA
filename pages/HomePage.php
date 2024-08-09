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
         <div class="chart-container">
            <h2>Répartition Des Puces Par Direction</h2>
            <br>
            <canvas id="myChart"></canvas>
         </div>
      </main>
      
      <!--=============== MAIN JS ===============-->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="../js/main.js"></script>
      <script src="../js/chart.js"></script>
      <script src="../js/table2excel.js"></script>
      <script src="../js/exportAsExcelFile.js"></script>
   </body>
</html>