<?php
include 'connexion_bdd.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["uid"])){ 
    $uid = $_SESSION["uid"]; //stock l'id de l'utilisateur dans une session
    $infoUser = $pdo->prepare("SELECT * FROM user WHERE idu = ?");
    $infoUser->execute(array($uid));
    $infoUser = $infoUser->fetch();
}
?>
