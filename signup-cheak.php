<?php 
session_start(); 
include "bdd_con.php"; // Inclure le fichier de connexion à la base de données

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password'])) {

    // Fonction pour assainir les données des champs de formulaire
    function validate($data){
        $data = trim($data); // Supprimer les espaces inutiles
        $data = stripslashes($data); // Supprimer les barres obliques
        $data = htmlspecialchars($data); // Convertir les caractères spéciaux
        return $data;
    }

    // Obtenir les données du formulaire
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $name = validate($_POST['name']);

    // Stocker les informations de l'utilisateur pour rediriger en cas d'erreur
    $user_data = 'uname=' . $uname . '&name=' . $name;

    // Vérifier si les champs sont vides
    if (empty($uname)) {
        header("Location: signup.php?error=User Name is required&$user_data");
        exit();
    } else if (empty($pass)) {
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    } else if (empty($re_pass)) {
        header("Location: signup.php?error=Re Password is required&$user_data");
        exit();
    } else if (empty($name)) {
        header("Location: signup.php?error=Name is required&$user_data");
        exit();
    } else if ($pass !== $re_pass) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {
        // Hachage du mot de passe
        $pass = md5($pass);

        // Vérifier si l'utilisateur existe déjà dans la base de données
        $sql = "SELECT * FROM users WHERE user_name='$uname'";
        $result = mysqli_query($conn, $sql);

        // Si l'utilisateur existe déjà, rediriger avec un message d'erreur
        if (mysqli_num_rows($result) > 0) {
            header("Location: signup.php?error=The username is taken try another&$user_data");
            exit();
        } else {
            // Insérer le nouvel utilisateur dans la base de données
            $sql2 = "INSERT INTO users(user_name, password, name) VALUES('$uname', '$pass', '$name')";
            $result2 = mysqli_query($conn, $sql2);

            // Si l'insertion réussit, rediriger avec un message de succès
            if ($result2) {
                header("Location: signup.php?success=Your account has been created successfully");
                exit();
            } else {
                // Si l'insertion échoue, rediriger avec un message d'erreur
                header("Location: signup.php?error=unknown error occurred&$user_data");
                exit();
            }
        }
    }

} else {
    // Si les champs nécessaires ne sont pas définis, rediriger vers la page d'inscription
    header("Location: signup.php");
    exit();
}
?>
