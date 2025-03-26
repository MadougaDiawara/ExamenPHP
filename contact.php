<?php 
session_start();
include 'Includes/baseD.php'; 
include 'Includes/header.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/LocaV.css" type="text/css">
    <title>Contact - NdaaMar</title>
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
    
      <div class="contact-container">
    <h2>Contactez NdaaMar</h2>
    <p>Nous sommes là pour vous aider ! N'hésitez pas à nous contacter pour toute question ou demande.</p>
    <h3>Envoyez-nous un message</h3>
    <form method="post" action="">
        <input type="email" name="client_email" placeholder="Votre Email" required style="width: 300px;color: black; padding: 10px 20px; margin: 10px;height: 40px; position: relative;border-radius: 15px;z-index: 1;box-shadow: 0 4px 8px white;border:none;">
        <textarea name="client_message" placeholder="Votre message" required style="width: 400px;color: black; height: 100px;max-height: 300px; padding: 10px 20px; margin: 10px;border-radius: 15px;z-index: 1;box-shadow: 0 4px 8px white;border: none;left: 55%;"></textarea>
        <br>
        <input type="submit" name="send_message" value="Envoyer" style="background-color: rgb(43, 8, 76); color: white; padding: 10px 20px; border: none; cursor: pointer;width: 100px;text-align: center;justify-content: center;align-items: center;position: relative;Left: 45%; z-index: 1;border-radius: 15px;margin: 10px; hover: background-color: lightblue;">
    </form>
</div>

<?php 
if (isset($_POST['send_message'])) {
    $email = $_POST['client_email'];
    $message = $_POST['client_message'];
    
    echo "<p style='color: blue;'>Merci, votre message a été envoyé !</p>";
}
?>

</body>
</html>

<?php include 'Includes/footer.php'; ?>