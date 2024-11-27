<?php 
session_start();  // Démarrer la session pour pouvoir utiliser les variables de session plus tard
include "bdd_con.php"; // Inclure le fichier de connexion à la base de données pour utiliser la variable $conn

if (isset($_POST['uname']) && isset($_POST['password'])) {  // Vérifier si les champs nom d'utilisateur et mot de passe sont fournis
    // Fonction pour assainir les données d'entrée pour éviter les problèmes de sécurité
    function validate($data){
        $data = trim($data); // Supprimer les espaces inutiles
        $data = stripslashes($data); // Supprimer les barres obliques
        $data = htmlspecialchars($data); // Convertir les caractères spéciaux en entités HTML
        return $data;
    }

    // Obtenir les valeurs de nom d'utilisateur et mot de passe du formulaire
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    // Vérifier si le nom d'utilisateur ou le mot de passe est vide
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required"); // Rediriger avec un message d'erreur
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required"); // Rediriger avec un message d'erreur
        exit();
    }else{
        // Requête SQL pour récupérer l'utilisateur correspondant au nom d'utilisateur et mot de passe
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        // Exécuter la requête SQL
        $result = mysqli_query($conn, $sql);

        // Vérifier si un utilisateur correspondant a été trouvé
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result); // Récupérer les données de l'utilisateur à partir des résultats
            if ($row['user_name'] === $uname && $row['password'] === $pass) { // Valider les identifiants
                $_SESSION['user_name'] = $row['user_name']; // Stocker le nom d'utilisateur dans la session
                $_SESSION['name'] = $row['name']; // Stocker le nom complet de l'utilisateur
                $_SESSION['id'] = $row['id']; // Stocker l'id de l'utilisateur
                header("Location: acceuil.php"); // Rediriger vers la page d'accueil
                exit();
            } else {
                header("Location: index.php?error=Incorrect User name or password"); // Rediriger avec une erreur
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name or password"); // Rediriger avec une erreur
            exit();
        }
    }

} else {
    // Si les champs nécessaires ne sont pas définis, rediriger vers la page de connexion
    header("Location: index.php");
    exit();
}
?>
