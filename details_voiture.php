<?php 
session_start();
include 'Includes/baseD.php';
include 'Includes/header.php'; 

$message = ''; // Variable to hold the message for the user

if (isset($_GET['id_voiture'])) {
    $id_voiture = intval($_GET['id_voiture']); // S'assurer que l'ID est un entier
    $reqSelect = "SELECT * FROM voitures WHERE id_voiture = $id_voiture";
    $resultat = mysqli_query($mysqli, $reqSelect);

    // Vérifiez si la requête a réussi
    if (!$resultat) {
        die('Erreur de requête: ' . mysqli_error($mysqli));
    }

    if ($ligne = mysqli_fetch_assoc($resultat)) {
        // Check if a reservation attempt was made
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $message = "Vous devez être connecté pour réserver une voiture. <a href='connexion.php'>Connectez-vous ici</a>.";
            } else {
                // Process the reservation if the user is logged in
                // You can add your reservation logic here
                $message = "Réservation réussie !"; // You can redirect to confirmation logic if needed
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Détails de la Voiture</title>
            <link rel="stylesheet" type="text/css" href="Css/LocaV.css">
            <link rel="stylesheet" type="text/css" href="detailsV.css">
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
            </div>

            <p class="NomSite">NdaaMar</p>
        </div>

        <h1>Détails de la Voiture</h1>
        <div id="article_detail">
            <h1><?php echo htmlspecialchars($ligne['marque'] . ' ' . $ligne['modele']); ?></h1>
            <img src="<?php echo htmlspecialchars($ligne['images']); ?>" alt="Image de la voiture" /><br />
            <p>Année de fabrication : <?php echo htmlspecialchars($ligne['annee_fabrication']); ?></p>
            <p>Plaque d'immatriculation : <?php echo htmlspecialchars($ligne['plaque_immatriculation']); ?></p>
            <p>Statut : <?php echo htmlspecialchars($ligne['statut']); ?></p>
            <p>Prix : <?php echo htmlspecialchars($ligne['prix']); ?> FCFA</p>
            
            <h2>Réservation</h2>
            <form method="POST" action="">
                <input type="hidden" name="id_voiture" value="<?php echo $ligne['id_voiture']; ?>">
                <input type="submit" class="reservation-button" value="Réserver">
            </form>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['user_id'])): ?>
                <p class="alert-message"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p class='alert-message'>Voiture non trouvée.</p>";
    }
} else {
    echo "<p class='alert-message'>ID de voiture non spécifié.</p>";
}

include 'Includes/footer.php'; 
?>