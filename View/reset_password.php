<!-- reset_password.php -->
<?php include 'include/header.php'; ?>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="w-100" style="max-width: 400px;">
            <h2 class="text-center mb-4">Nouveau mot de passe</h2>
            <form action="update_password.php" method="POST" onsubmit="return validatePassword()">
                <div class="form-group">
                    <label for="password">Nouveau mot de passe:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary" onclick="togglePassword('password')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary" onclick="togglePassword('confirm_password')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Réinitialiser le mot de passe</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>
    
    <script>
        function togglePassword(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            if (password != confirm_password) {
                alert("Les mots de passe ne correspondent pas.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

reset_password