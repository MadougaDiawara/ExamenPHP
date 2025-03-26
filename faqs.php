<?php 
session_start();
include 'Includes/baseD.php'; 
 include 'Includes/header.php'; 
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

    <title>NdaaMar - Connexion</title>
    <link rel="stylesheet" type="text/css" href="Css/LocaV.css">
    <link rel="stylesheet" href="faqs.css">
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
             <a href="deconnexion.php">Deconnexion</a>
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

<div class="faq-container">
<p>Questions fréquentes concernant notre service de location de voitures.</p>

    <div class="faq-section">
        <h2>Questions Générales</h2>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">1. Quels types de véhicules proposez-vous ?</h3>
            <p class="faq-answer">Nous offrons une large gamme de véhicules, y compris des berlines, des SUV, des utilitaires et des voitures de luxe.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">2. Comment puis-je réserver un véhicule ?</h3>
            <p class="faq-answer">Vous pouvez réserver un véhicule en ligne via notre site web ou en contactant notre service client par téléphone.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">3. Quels documents sont nécessaires pour louer une voiture ?</h3>
            <p class="faq-answer">Vous aurez besoin d'une pièce d'identité valide, d'un permis de conduire et d'une carte de crédit au nom du conducteur.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">4. Quelle est la politique de carburant ?</h3>
            <p class="faq-answer">Nos véhicules sont généralement fournis avec un plein de carburant et doivent être retournés avec un plein également.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">5. Que faire en cas d'accident ?</h3>
            <p class="faq-answer">En cas d'accident, veuillez contacter notre service d'assistance immédiatement et suivez les instructions fournies.</p>
        </div>

        <h2>Politique de Location</h2>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">6. Y a-t-il des frais supplémentaires ?</h3>
            <p class="faq-answer">Des frais supplémentaires peuvent s'appliquer pour les conducteurs supplémentaires, les assurances additionnelles, ou si le véhicule est retourné en retard.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">7. Puis-je annuler ma réservation ?</h3>
            <p class="faq-answer">Oui, vous pouvez annuler votre réservation jusqu'à 24 heures avant la prise en charge sans frais.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question" onclick="toggleAnswer(this)">8. Offrez-vous des réductions pour les locations à long terme ?</h3>
            <p class="faq-answer">Oui, nous offrons des tarifs préférentiels pour les locations de longue durée. Contactez-nous pour plus de détails.</p>
        </div>
    </div>
</div>

    
</body>
</html>

<?php include 'Includes/footer.php'; ?>