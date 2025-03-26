 <?php
 session_start();
 include 'Includes/baseD.php'; 
include 'Includes/header.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NdaaMar - À Propos</title>
    <meta name="description" content="Découvrez NdaaMar, votre entreprise de location de véhicules de confiance.">
    <meta name="keywords" content="location, véhicules, NdaaMar, mobilité">
    <link rel="stylesheet" type="text/css" href="Css/LocaV.css">
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

    <section class="about-section">
        <div class="container">
            <h1 class="about-title">À PROPOS DE NOUS</h1>
            <p>Bienvenue chez NdaaMar, votre entreprise de location de véhicules de confiance. Nous vous offrons une véritable expérience de mobilité, adaptée à vos envies et à votre budget.</p>
            <h2>Nos Services</h2>
            <ul>
                <li>Location de courte durée : des citadines agiles pour vos déplacements urbains.</li>
                <li>Location longue durée : solutions personnalisées pour les professionnels.</li>
            </ul>
            <h2>Nos Avantages</h2>
            <ul>
                <li>Une flotte variée de véhicules.</li>
                <li>Des prix transparents sans surprise.</li>
                <li>Un service client disponible 24/7.</li>
                <li>Une application mobile intuitive pour vos réservations.</li>
            </ul>
            <p>N'hésitez pas à nous contacter pour toute question ou demande de devis.</p>
        </div>
         
        <div id="articles">

        <?php
        if (isset($_POST['btsubmit'])) {
            $motcle = $_POST['motcle'];
            $reqSelect = "Select * from voitures where marque LIKE '%$motcle%'";
        } else {
            $reqSelect = "Select * from voitures";
        }
        $resultat=mysqli_query($mysqli,$reqSelect);

        while($ligne=mysqli_fetch_assoc($resultat))
        {
            ?>
            <div id="auto">
                <img src="<?php echo $ligne['images']; ?>" /><br />
                <?php echo $ligne['marque']; ?><br />
                <?php echo $ligne['modele']; ?><br />
                <?php echo $ligne['annee_fabrication']; ?><br />
                <?php echo $ligne['plaque_immatriculation']; ?><br />
                <?php echo $ligne['statut']; ?><br />
                <?php echo $ligne['prix']; ?><br />
</div>

<?php } ?>
</div>
    </section>
    <section class="team-section">
        <h2 class="about-title">Notre Équipe</h2>
        <div class="team">
            <div class="team-member">
                <h3>Matar Samb</h3>
                <p>Directeur Général</p>
            </div>
            <div class="team-member">
                <h3>Dieyla Gueye</h3>
                <p>Directrice Commerciale</p>
            </div>
            <div class="team-member">
                <h3>Madouga Diawara</h3>
                <p>Directeur Technique</p>
            </div>
        </div>
        <img src="Images/image15.jpg" alt="Image de l'équipe" class="about-image"><style>about-image{width: 50px; height: 50px; border-radius: 40px; float: right;} </style>
    </section>

    
</body>
</html>
<?php include 'Includes/footer.php'; ?>