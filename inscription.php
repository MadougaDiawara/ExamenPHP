<?php 
session_start();
include 'Includes/baseD.php'; 
include 'Includes/header.php'; 
?>

<?php if (isset($_SESSION['erreur'])): ?>
    <div class="erreur"><?= htmlspecialchars($_SESSION['erreur']) ?></div>
    <?php unset($_SESSION['erreur']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['succes'])): ?>
    <div class="succes"><?= htmlspecialchars($_SESSION['succes']) ?></div>
    <?php unset($_SESSION['succes']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NdaaMar - Inscription</title>
    <link rel="stylesheet" href="Css/LocaV.css" type="text/css">
</head>
<body>
<div id="entete">
    <video class="video_entete" autoplay muted loop>
        <source src="Images/Video003.mp4" type="video/mp4">
    </video>
    
    <div>
        <a href="index.php">Accueil</a>
        <a href="reserver_voiture.php">Voitures</a>
        <a href="Apropos.php">À propos</a>
        <a href="connexion.php" class="login">Connexion</a>
        <a href="faqs.php">Faqs</a>
        <a href="inscription.php">Inscription</a>
        <a href="contact.php">Contact</a> 
        <a href="deconnexion.php">Déconnexion</a>

        <?php if (isset($_SESSION['admin'])): ?>
            <a href="admin/index.php">Accueil</a>
        <a href="admin/admin.php">Administration</a>
        <a href="admin/connexion_admin.php" class="login">Connexion </a>
        <a href="admin/inscription_admin.php">Inscription</a>
        <a href="admin/deconnexion_admin.php">Déconnexion</a>

        <?php endif; ?>
    </div>
    <p class="NomSite">NdaaMar</p>
</div>

<div class="inscription-page">
    <div class="inscription-form">
        <h1>Inscription</h1>
        <form action="processus_inscription.php" method="POST">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="text" name="prenom" placeholder="Votre prénom" required>
            <input type="date" name="date_naissance" required max="<?= date('Y-m-d', strtotime('-18 years')) ?>">
            <input type="email" name="email" placeholder="Votre e-mail" required>
            <input type="password" name="mot_passe" placeholder="Votre mot de passe" required>
            <input type="text" name="adresse" placeholder="Votre adresse" required>
            <input type="text" name="num_permis" placeholder="Numéro de permis" required>
            
            <button type="submit">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
    </div>
</div>

<?php include 'Includes/footer.php'; ?>
</body>
</html>