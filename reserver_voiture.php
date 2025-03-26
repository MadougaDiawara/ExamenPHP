<?php 
// Affichage des erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'Includes/baseD.php';
include 'Includes/header.php';

// Logique pour afficher les voitures disponibles
$reqSelect = "SELECT * FROM voitures WHERE statut = 'disponible'";
$resultat = mysqli_query($mysqli, $reqSelect);
if (!$resultat) {
    die('Erreur de requête: ' . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réserver une Voiture</title>
    <link rel="stylesheet" type="text/css" href="Css/LocaV.css">
    <style>
        /* Ajout de styles pour la superposition et le centrage du titre */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        #entete {
            margin: 0; 
            width: 100%; 
            height: 100vh; 
            position: relative; 
            overflow: hidden; 
            background-color: transparent; 
            z-index: 1; 
        }
        .video_entete {
            left: 0; 
            width: 100%; 
            height: 100%; 
            position: absolute; 
            z-index: 0; 
            object-fit: cover; 
            object-position: center; 
        }
        .NomSite {
            font-size: 50px;
            text-align: center;
            margin: 0;
            padding-top: 5%; 
            color: white;
            font-weight: bold;
            position: relative;
            z-index: 1; 
            font-family: "Script MT Bold", "Sakkal Majalla";
        }
        .title {
            text-align: center;
            color: gray;
            font-weight: bold;
            font-size: 36px;
            padding: 20px 0;
            margin: 20px 0;
            border: 1px solid blue;
            border-radius: 50px;
            background-color: white;
        }
        #articles {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .column {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }
        #auto {
            border: 1px solid gray;
            width: 150px;
            min-height: 200px;
            margin: 5px;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
            opacity: 0.9; 
        }
        #auto img {
            width: 130px;
            height: 100px;
        }
        .details-button {
            color: white; /* Couleur du texte */
            background-color: #542878; /* Couleur de fond */
            border-radius: 40px; /* Arrondi des bords */
            border: none; /* Pas de bordure */
            padding: 10px 20px; /* Espacement interne */
            cursor: pointer; /* Curseur en forme de main */
            transition: background-color 0.3s; /* Transition pour l'effet de survol */
        }
        .details-button:hover {
            background-color: lightblue; /* Couleur de fond au survol */
        }
    </style>
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

<div class="boutonreserver">
    <h1 class="title">Réserver une Voiture</h1>
</div>

<div id="Formauto">
    <form name="Formauto" method="post" action="">
        <input id="motcle" type="text" name="motcle" placeholder="Recherchez par La Marque."/>
        <input class="btfind" type="submit" name="btsubmit" value="Recherche"/>
    </form>
</div>

<div>
    <?php 
    // Vérifiez si une recherche a été effectuée
    if (isset($_POST['btsubmit'])) {
        $motcle = mysqli_real_escape_string($mysqli, $_POST['motcle']);
        $reqSelect = "SELECT * FROM voitures WHERE marque LIKE '%$motcle%'";
    } else {
        $reqSelect = "SELECT * FROM voitures WHERE statut = 'disponible'";
    }
    
    $resultat = mysqli_query($mysqli, $reqSelect);
    if (!$resultat) {
        die('Erreur de requête: ' . mysqli_error($mysqli));
    }
    
    // Vérifiez si des résultats sont retournés
    if (mysqli_num_rows($resultat) === 0) {
        echo 'Aucune voiture disponible.';
    } else {
        echo '<div id="articles">';
        while ($ligne = mysqli_fetch_assoc($resultat)) {
            ?>
            <div class="column">
                <div id="auto">
                    <a href="details_voiture.php?id_voiture=<?php echo htmlspecialchars($ligne['id_voiture']); ?>">
                        <img src="<?php echo htmlspecialchars($ligne['images']); ?>" /><br />
                        <?php echo htmlspecialchars($ligne['marque']); ?><br />
                        <?php echo htmlspecialchars($ligne['modele']); ?><br />
                        <?php echo htmlspecialchars($ligne['annee_fabrication']); ?><br />
                        <?php echo htmlspecialchars($ligne['plaque_immatriculation']); ?><br />
                        <?php echo htmlspecialchars($ligne['statut']); ?><br />
                        <?php echo htmlspecialchars($ligne['prix']); ?>FCFA<br />
                    </a>
                </div>
                <form method="POST" action="details_voiture.php?id_voiture=<?php echo htmlspecialchars($ligne['id_voiture']); ?>">
                    <input type="submit" class="details-button" value="Détails">
                </form>
            </div>
            <?php
        }
        echo '</div>';
    }
    ?>
</div>
<?php Include 'Includes/footer.php'; ?>
</body>
</html>