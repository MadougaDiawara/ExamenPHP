<?php
session_start();
include 'Includes/baseD.php';

// Logique pour afficher les détails de la réservation et le montant à payer
?>

<!DOCTYPE html>
<html>
<head>
    <title>Paiement</title>
</head>
<body>

div id="entete">
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

    <h1>Paiement</h1>
    <form method="POST" action="traiter_paiement.php">
        Montant: <input type="text" name="montant" required><br>
        <input type="submit" value="Payer">
    </form>
</body>
</html>