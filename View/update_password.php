<?php
require 'include/connexion_bdd.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Trouver l'utilisateur correspondant au token
    $stmt = $pdo->prepare("SELECT * FROM user WHERE reset_token = ? AND reset_expires > ?");
    $stmt->execute([$token, time()]);
    $user = $stmt->fetch();

    if ($user) {
        // Mettre à jour le mot de passe de l'utilisateur
        $stmt = $pdo->prepare("UPDATE user SET mdp = ?, reset_token = NULL, reset_expires = NULL WHERE idu = ?");
        $stmt->execute([$password, $user['idu']]);

        // Rediriger vers la page de succès
        header("Location: password_reset_success.php");
        exit();
    } else {
        echo "Lien de réinitialisation invalide ou expiré.";
    }
}
?>

update_password