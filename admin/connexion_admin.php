<?php
session_start();
include '../Includes/baseD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifiez les identifiants (à adapter selon votre méthode de stockage)
    if ($username == 'id_admin' && $password == 'mot_passe') {
        $_SESSION['id_admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/LocV_admin.css" type="text/css">
    <title>Connexion Admin</title>
</head>
<body>
<div id="entete">
    <video class="video_entete" autoplay muted loop>
        <source src="../Images/Video003.mp4" type="video/mp4">
    </video>
    <div>
        <a href="index.php">Accueil</a>
        <a href="admin.php">Administration</a>
        <a href="connexion_admin.php" class= "login">Connexion </a>
        <a href="inscription_admin.php">Inscription</a>
        <a href="deconnexion_admin.php">Déconnexion</a>
        
        
    </div>
    <p class="NomSite">NdaaMar</p>
</div>
    
    <form method="post" action="">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
 
</body>
</html>
<?php include 'footer_admin.php'; ?>
   
