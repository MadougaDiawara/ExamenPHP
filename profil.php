<?php
session_start();
include 'Includes/baseD.php'; // Connexion à la base de données
include 'Includes/header.php'; // Inclusion du header

// Vérification de la session
if (!isset($_SESSION['client_id'])) {
    header("Location: connexion.php");
    exit();
}

// Récupération de l'ID du client connecté
$client_id = (int) $_SESSION['client_id'];

// Requête pour récupérer les informations du client
$req = "SELECT * FROM clients WHERE id_client = ?";
$stmt = $mysqli->prepare($req);
if (!$stmt) {
    die("Erreur lors de la préparation de la requête : " . $mysqli->error);
}
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

// Vérification si le client existe
if (!$client) {
    $_SESSION['error'] = "Profil introuvable.";
    header("Location: connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon Profil - NdaaMar</title>
    <meta name="description" content="Profil de l'utilisateur sur NdaaMar.">
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
        <a href="deconnexion.php" class="logout">Déconnexion</a>
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

<div id="global">
    <div id="profil">
        <h1>Bonjour <?php echo htmlspecialchars($client['nom']) . " " . htmlspecialchars($client['prenom']); ?></h1>
        <?php if (!empty($client['images'])): ?>
            <img src="<?php echo htmlspecialchars($client['images']); ?>" alt="Photo de Profil"/><br />
        <?php else: ?>
            <p>Aucune photo disponible</p>
        <?php endif; ?>
        <a href="deconnexion.php">Déconnexion</a>
    </div>
    
    <div id="tableaubord">
        <h2>Mes Informations</h2>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($client['nom']); ?></p>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($client['prenom']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($client['email']); ?></p>
        <p><strong>Date de Naissance :</strong> <?php echo htmlspecialchars($client['date_naissance']); ?></p>
        <p><strong>Adresse :</strong> <?php echo htmlspecialchars($client['adresse']); ?></p>
        <p><strong>Numéro de Permis :</strong> <?php echo htmlspecialchars($client['num_permis']); ?></p>

        <!-- Gestion des réservations -->
        <h2>Mes Réservations</h2>
        <table>
            <tr>
                <th>ID Réservation</th>
                <th>ID Voiture</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Statut</th>
            </tr>
            <?php
            $req_res = "SELECT * FROM reservations WHERE id_client = ?";
            $stmt_res = $mysqli->prepare($req_res);
            if ($stmt_res) {
                $stmt_res->bind_param("i", $client_id);
                $stmt_res->execute();
                $result_res = $stmt_res->get_result();
                while ($reservation = $result_res->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($reservation['id_reservation']) . "</td>
                            <td>" . htmlspecialchars($reservation['id_voiture']) . "</td>
                            <td>" . htmlspecialchars($reservation['date_debut']) . "</td>
                            <td>" . htmlspecialchars($reservation['date_fin']) . "</td>
                            <td>" . htmlspecialchars($reservation['statut']) . "</td>
                          </tr>";
                }
                $stmt_res->close();
            }
            ?>
        </table>
    </div>
</div>


</body>
</html>
<?php include 'Includes/footer.php'; ?>