<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<!-- Lien vers le fichier de style CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <!-- Formulaire d'inscription -->
     <form action="signup-cheak.php" method="post">
     	<h2>SIGN UP</h2>
     	
     	<!-- Affichage d'un message d'erreur si la variable 'error' est définie dans l'URL -->
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<!-- Affichage d'un message de succès si la variable 'success' est définie dans l'URL -->
          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <!-- Champ pour entrer le nom -->
          <label>Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <!-- Si le champ 'name' est présent dans l'URL, pré-remplir le champ avec la valeur -->
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <!-- Sinon, laisser le champ vide -->
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
          <?php }?>

          <!-- Champ pour entrer le nom d'utilisateur -->
          <label>User Name</label>
          <?php if (isset($_GET['uname'])) { ?>
               <!-- Si le champ 'uname' est présent dans l'URL, pré-remplir le champ avec la valeur -->
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <!-- Sinon, laisser le champ vide -->
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"><br>
          <?php }?>

     	<!-- Champ pour entrer le mot de passe -->
     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

          <!-- Champ pour entrer la confirmation du mot de passe -->
          <label>Re Password</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Re_Password"><br>

     	<!-- Bouton pour soumettre le formulaire d'inscription -->
     	<button type="submit">Sign Up</button>

     	<!-- Lien vers la page de connexion si l'utilisateur a déjà un compte -->
          <a href="index.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>
