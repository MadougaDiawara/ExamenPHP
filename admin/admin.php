<?php
session_start();
include '../Includes/baseD.php';

// Récupération des réservations
$reservations = mysqli_query($mysqli, "SELECT * FROM reservations");

// Récupération des voitures
$voitures = mysqli_query($mysqli, "SELECT * FROM voitures");

// Traitement des actions (valider, annuler)
if (isset($_GET['action']) && isset($_GET['id'])) {
    // Vérifie si l'utilisateur est connecté avant d'effectuer l'action
    if (!isset($_SESSION['admin'])) {
        header("Location: connexion_admin.php");
        exit();
    }
    $id = intval($_GET['id']); // Sécurisation de l'ID
    if ($_GET['action'] == 'valider') {
        mysqli_query($mysqli, "UPDATE reservations SET statut='validée' WHERE id=$id");
        // Redirection vers la page d'envoi de notification
        header("Location: envoi_notification.php?id=$id");
        exit();
    } elseif ($_GET['action'] == 'annuler') {
        mysqli_query($mysqli, "UPDATE reservations SET statut='annulée' WHERE id=$id");
    }
}
// Récupération des administrateurs
$admins = mysqli_query($mysqli, "SELECT * FROM administrateurs");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - NdaaMar</title>
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
        <a href="connexion_admin.php" class="login">Connexion </a>
        <a href="inscription_admin.php">Inscription</a>
        <a href="deconnexion_admin.php">Déconnexion</a>
    </div>
    <p class="NomSite">NdaaMar</p>
</div>

<h1>Tableau de bord Admin</h1>

<h2>Réservations</h2>
<table>
    <tr>
        <th>ID</th>
        <th>ID Voiture</th>
        <th>ID Client</th>
        <th>Email</th>
        <th>Date de Debut</th>
        <th>Date de Fin</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($reservations)): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['id_voiture']); ?></td>
        <td><?php echo htmlspecialchars($row['id_client']); ?></td>
        <td><?php echo htmlspecialchars($row['email_client']); ?></td>
        <td><?php echo htmlspecialchars($row['date_debut']); ?></td>
        <td><?php echo htmlspecialchars($row['date_fin']); ?></td>
        <td><?php echo htmlspecialchars($row['statut']); ?></td>
        <td>
            <a href="?action=valider&id=<?php echo $row['id']; ?>">Valider</a>
            <a href="?action=annuler&id=<?php echo $row['id']; ?>">Annuler</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
    <h2>Voitures</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($voitures)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_voiture']); ?></td>
            <td><?php echo htmlspecialchars($row['marque']); ?></td>
            <td><?php echo htmlspecialchars($row['modele']); ?></td>
            <td>
            <a href ="supprimer_voiture.php?id=<?php echo $row['id_voiture']; ?>">Supprimer</a>
  
        </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Ajouter une Voiture</h2>
    <form action="ajouter_voiture.php" method="post" enctype="multipart/form-data">
         <input type="file" name="image" accept="image/*" required>
        <input type="text" name="marque" placeholder="Marque" required>
        <input type="text" name="modele" placeholder="Modèle" required>
        <input type="number" name="annee_fabrication" placeholder="Année" required>
        <input type="text" name="plaque_immatriculation" placeholder="Plaque" required>
        <input type="number" name="prix" placeholder="Prix" required>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Envoyer une Notification</h2>
    <form action="envoi_notification.php" method="post">
        <input type="email" name="email" placeholder="Email du client" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <h2>Ajouter un Paiement</h2>
    <form action="gestion_paiement.php" method="post">
        <input type="number" name="id_reservation" placeholder="ID de Réservation" required>
        <input type="number" step="0.01" name="montant" placeholder="Montant" required>
        <button type="submit">Ajouter Paiement</button>
    </form>

    <h2>Gestion des Administrateurs</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom d'Utilisateur</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while ($admin = mysqli_fetch_assoc($admins)): ?>
        <tr>
            <td><?php echo htmlspecialchars($admin['id_admin']); ?></td>
            <td><?php echo htmlspecialchars($admin['nom_utilisateur']); ?></td>
            <td><?php echo htmlspecialchars($admin['email']); ?></td>
            <td>
                <a href="supprimer_admin.php?id=<?php echo $admin['id_admin']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Ajouter un Administrateur</h2>
    <form action="ajouter_admin.php" method="post">
        <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_passe" placeholder="Mot de passe" required>
        <button type="submit">Ajouter Administrateur</button>
    </form>

</body>
</html>
<?php include 'footer_admin.php'; ?>