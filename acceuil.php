<?php 
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <!-- Welcome message -->
    <h1>Bienvenue, <?php echo $_SESSION['name']; ?> !</h1>

    <!-- Logout form -->
    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger">Déconnexion</button>
    </form>

    <!-- Navigation Box -->
    <div class="nav-box">
        <nav>
            <ul>
                <li><a href="comptes_rendus.php">Liste des comptes rendus</a></li>
                <li><a href="create_comptes_rendus.php">Créer / Modifier un compte rendu</a></li>
                <li><a href="commentaires.php">Commentaires</a></li>
            </ul>
        </nav>
    </div>

</body>
</html>

<?php 
}else{
    // If the user is not logged in, redirect to login page
    header("Location: index.php");
    exit();
}
?>
