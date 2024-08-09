<?php

if (!isset($_SESSION['user_id']) && isset($_COOKIE['rememberMe'])) {
    $token = $_COOKIE['rememberMe'];
    $loginResult = new Userscontr();

    // Validate token
    $sql = "SELECT user_id FROM user_tokens WHERE token = ? AND expiry > ?";
    $stmt = $loginResult->connect()->prepare($sql);
    $stmt->execute([$token, time()]);
    $userToken = $stmt->fetch();

    if ($userToken) {
        $_SESSION['user_id'] = $userToken['user_id'];
        $_SESSION["login_autorisation"] = "yes";
        header("Location: ../html/HomePage.php");
        exit;
    }
}
?>
