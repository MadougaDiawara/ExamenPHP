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
    <title>NdaaMar</title>
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
        <a href="deconnexion.php" >Déconnexion</a>
         
        <?php if (isset($_SESSION['admin'])): ?>
            <a href="admin/index.php">Accueil</a>
        <a href="admin/admin.php">Administration</a>
        <a href="admin/connexion_admin.php" class="login">Connexion </a>
        <a href="admin/inscription_admin.php">Inscription</a>
        <a href="admin/deconnexion_admin.php">Déconnexion</a>

        <?php endif; ?>
    </div>

    <p class="NomSite">NdaaMar</p>
    <div id="Formauto">
        <form name="Formauto" method="post" action="">
            <input id="motcle" type="text" name="motcle" placeholder="Recherchez par La Marque."/>
            <input class="btfind" type="submit" name="btsubmit" value="Recherche"/>
        </form>
    </div>
</div>

<div id="articles">
<?php
if (isset($_POST['btsubmit'])) {
    $motcle = mysqli_real_escape_string($mysqli, $_POST['motcle']);
    $reqSelect = "SELECT * FROM voitures WHERE marque LIKE '%$motcle%'";
} else {
    $reqSelect = "SELECT * FROM voitures";
}
$resultat = mysqli_query($mysqli, $reqSelect);

// Boucle pour afficher les voitures
while ($ligne = mysqli_fetch_assoc($resultat)) {
    ?>
    <div id="auto">
        <img src="<?php echo htmlspecialchars($ligne['images']); ?>" alt="Image de la voiture"/><br />
        <strong><?php echo htmlspecialchars($ligne['marque']); ?></strong><br />
        <?php echo htmlspecialchars($ligne['modele']); ?><br />
        <?php echo htmlspecialchars($ligne['annee_fabrication']); ?><br />
        <?php echo htmlspecialchars($ligne['plaque_immatriculation']); ?><br />
        <?php echo htmlspecialchars($ligne['statut']); ?><br />
        <?php echo htmlspecialchars($ligne['prix']); ?> FCFA<br />
    </div>
    <?php 
} 
?>
</div>
</body>
</html>
<?php include 'Includes/footer.php'; ?>