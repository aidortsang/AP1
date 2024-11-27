<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <!-- Lien vers le fichier CSS externe pour styliser la page -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Formulaire de connexion -->
    <form action="login.php" method="post"> <!-- Le formulaire soumet les données à login.php -->
        <h2>LOGIN</h2>

        <!-- Affichage du message d'erreur si une erreur est passée dans l'URL -->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <!-- Champ pour le nom d'utilisateur -->
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br> 

        <!-- Champ pour le mot de passe -->
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <!-- Bouton de soumission pour se connecter -->
        <button type="submit">Login</button>

        <!-- Lien pour aller à la page d'inscription pour les nouveaux utilisateurs -->
        <a href="signup.php" class="ca">Create an account</a>
     <!-- Forgot password link -->
     <a href="forgot_password.php" class="ca">Forgot Password?</a>
    </form>
</body>
</html>
