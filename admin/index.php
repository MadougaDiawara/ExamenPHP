<?php
session_start();
include '../Includes/baseD.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/LocV_admin.css" type="text/css">
    <title>Accueil Administrateur</title>
</head>
<body>

<div id="entete">
    <video class="video_entete" autoplay muted loop>
        <source src="../Images/Video003.mp4" type="video/mp4">
    </video>
    <div>
        <a href="index.php">Accueil</a>
        <a href="admin.php">Administration</a>
        <a href="connexion_admin.php" class="login">Connexion </a>
        <a href="inscription_admin.php">Inscription</a>
        <a href="deconnexion_admin.php">Déconnexion</a>
    </div>
    <p class="NomSite">NdaaMar</p>
</div>


<p style="text-align: center;">Connectez-vous ou inscrivez-vous :</p>
<div style="display: flex; justify-content: center; gap: 20px;">
    <a href="connexion_admin.php"><button class="small-button">Se connecter</button></a>
    <a href="inscription_admin.php"><button class="small-button">S'inscrire</button></a>
</div>

<div id="footer">
<?php include 'footer_admin.php'; ?>  
</div>

</body>
</html>
