<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La gestion des dotations téléphoniques est la systématique utilisée par la régie autonome de distribution d'eau et d'électricité du Marrakech (RADEEMA), afin de gérer les dotations relatives à la consommation des agents soit au niveau de la voix téléphonique ou du data internet.
    La gestion des dotations téléphoniques a pour but de gérer les données de la flotte téléphonique et faciliter la tâche aux administrateurs pour collecter le reporting mensuel ou annuel des dotations téléphoniques.">
    <meta name="author" content="Marouane Loukrissi">
    <title>GSM Manager</title>
    <!-- Indlude your CSS files here -->
    <link rel="stylesheet" href="../css/styles.css">
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
    <img loading="lazy" class="background" src="../images/SIMbackground.gif">
    <div class="whiteBg">
        <header onclick="location.reload()" style="cursor: pointer;">
            <!-- Add your website name or logo here -->
            <img class="RADEEMAlogo" src="../images/logoRADEEMA.svg">
            <span class="RADEEMAtext">RADEEMA</span>
        </header>
        <!-- <nav>
            
        </nav> -->
        <main>
            <div class="span"><span class="span1">Welcome back to </span><span class="span2">GSM Manager</span></div>
            <div style="transform: translateX(-130%);" class="loginText">Login</div>
            <form method="post" action="../php/login.php" style="transform: translateY(-6%);">
                <label class="loginInputLabels" for="login">Login</label>
                <input class="loginInput input" type="text" name="login" placeholder="Login" id="login" required>
                <label class="passwordInputLabels" for="password">Password</label>
                <input class="passwordInput input" type="password" name="password" placeholder="Password" id="password" required>
                <div class="extraInfo">
                    <span>
                        <label class="remember">
                            <input type="checkbox" name="rememberMe"><span>Remember me</span>
                        </label>
                    </span>
                </div>
                <input class="loginButton" name="submitLogin" type="submit" value="Login">
                <?php
                    session_start();
                    if(isset($_SESSION["ErrorLogin"])){
                ?>
                        <div class="requisDeAccount" style="color:red;transform: translateX(-63px);"><?php echo $_SESSION["ErrorLogin"] ?></div>
                <?php 
                    unset($_SESSION["ErrorLogin"]);
                    }
                ?>
            </form>
        </main>
        <footer>
            <div style="display: inline;">Copyright &copy 2024 <span>RADEEMA</span> All rights reserved</div>
        </footer>
    </div>
</body>
</html>