<?php

// Déclaration des informations de connexion à la base de données
$sname = "localhost"; // Nom du serveur de la base de données, ici il s'agit de "localhost" pour un serveur local
$unmae = "root"; // Nom d'utilisateur de la base de données. "root" est l'utilisateur par défaut dans MySQL/MariaDB pour une installation locale
$password = ""; // Mot de passe pour l'utilisateur "root". Ici, il est vide, car généralement il n'y en a pas pour une installation locale de MySQL

$db_name = "projectap"; // Nom de la base de données à laquelle vous souhaitez vous connecter. Ici, c'est "projectap"

// Connexion à la base de données
$conn = mysqli_connect($sname, $unmae, $password, $db_name); // La fonction mysqli_connect() essaie de se connecter à la base de données avec les informations fournies

// Vérification si la connexion a échoué
if (!$conn) { // Si la connexion échoue, la condition sera vraie
    echo "Connection failed!"; // Affiche un message d'erreur si la connexion échoue
}
?>
