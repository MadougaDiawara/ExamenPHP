<?php
session_start();
include '../Includes/baseD.php';

if (!isset($_SESSION['admin'])) {
    header("Location: connexion_admin.php");
    exit();
}

// Récupération des paiements
$paiements = mysqli_query($mysqli, "SELECT * FROM paiements JOIN reservations ON paiements.id_reservation = reservations.id");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reservation = $_POST['id_reservation'];
    $montant = $_POST['montant'];
    $date_paiement = date('Y-m-d');
    
    $query = "INSERT INTO paiements (id_reservation, montant, date_paiement, statut) VALUES ('$id_reservation', '$montant', '$date_paiement', 'effectue')";
    mysqli_query($mysqli, $query);
    header("Location: paiements.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Paiements</title>
    <link rel="stylesheet" type="text/css" href="../admin/LocV_admin.css">
</head>
<body>
<div id="entete">
    <video class="video_entete" autoplay muted loop>
        <source src="../Images/Video003.mp4" type="video/mp4">
    </video>
    <div>
        <a href="index.php">Accueil</a>
        <a href="admin.php">Administration</a>
        <a href="gestion_paiement.php">Paiements</a>
        <a href="connexion_admin.php" class="login">Connexion </a>
        <a href="inscription_admin.php">Inscription</a>
        <a href="deconnexion_admin.php">Déconnexion</a>
        
    </div>
    <p class="NomSite">NdaaMar</p>
</div>
    <h1>Gestion des Paiements</h1>

    <h2>Liste des Paiements</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Réservation</th>
            <th>Montant</th>
            <th>Date de Paiement</th>
            <th>Statut</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($paiements)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['id_reservation']; ?></td>
            <td><?php echo $row['montant']; ?></td>
            <td><?php echo $row['date_paiement']; ?></td>
            <td><?php echo $row['statut']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Ajouter un Paiement</h2>
    <form action="" method="post">
        <input type="number" name="id_reservation" placeholder="ID de Réservation" required>
        <input type="number" step="0.01" name="montant" placeholder="Montant" required>
        <button type="submit">Ajouter Paiement</button>
    </form>
</body>
</html>
<?php include 'footer_admin.php'; ?>