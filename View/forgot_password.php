<!-- forgot_password.php -->
<?php include 'include/header.php'; ?>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="w-100" style="max-width: 400px;">
            <h2 class="text-center mb-4">Réinitialiser le mot de passe</h2>
            <form action="send_reset_link.php" method="POST">
                <div class="form-group">
                    <label for="email">Adresse Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Envoyer le lien de réinitialisation</button>
                </div>
            </form>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
</body>
</html>
