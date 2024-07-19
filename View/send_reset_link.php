<?php
require 'include/connexion_bdd.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Vérifier si l'email existe
    $stmt = $pdo->prepare("SELECT * FROM user WHERE mail = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $expires = time() + 3600; // Le token expire dans 1 heure

        // Stocker le token et l'heure d'expiration dans la base de données
        $stmt = $pdo->prepare("UPDATE user SET reset_token = ?, reset_expires = ? WHERE mail = ?");
        $stmt->execute([$token, $expires, $email]);

        // Adresse du site web en local
        $resetLink = "http://localhost/client-leger-full/View/reset_password.php?token=" . $token;

        // Envoyer l'email
        $to = $email;
        $subject = "Réinitialisation de mot de passe";
        $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe: " . $resetLink;
        $headers = "From: christianondiyo78@gmail.com\r\n" .
                   "Reply-To: christianondiyo78@gmail.com\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo "Un lien de réinitialisation a été envoyé à votre adresse email.";
        } else {
            echo "Une erreur est survenue lors de l'envoi de l'email.";
            $errorMessage = error_get_last()['message'] ?? 'Erreur inconnue';
            echo " Erreur : " . $errorMessage;
        }
    } else {
        echo "Aucun utilisateur trouvé avec cette adresse email.";
    }
}
?>
