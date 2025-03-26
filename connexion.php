<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'Includes/baseD.php'; // Connexion à la base de données

// Initialiser les erreurs
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']); // Supprimer le message d'erreur après l'avoir récupéré

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $mot_passe = trim($_POST['mot_passe']);

    if (empty($email) || empty($mot_passe)) {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header("Location: connexion.php");
        exit;
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Adresse e-mail invalide.";
        header("Location: connexion.php");
        exit;
    }

    // Requête préparée pour vérifier l'utilisateur
    $stmt = $mysqli->prepare("SELECT id_client, mot_passe FROM clients WHERE email = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Erreur interne : " . $mysqli->error;
        header("Location: connexion.php");
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $client = $result->fetch_assoc();
        if (password_verify($mot_passe, $client['mot_passe'])) {
            // Connexion réussie
            $_SESSION['client_id'] = $client['id_client'];
            header("Location: profil.php");
            exit;
        } else {
            $_SESSION['error'] = "Mot de passe incorrect.";
        }
    } else {
        $_SESSION['error'] = "Aucun compte associé à cet email.";
    }

    $stmt->close();
    header("Location: connexion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NdaaMar - Connexion</title>
    <link rel="stylesheet" type="text/css" href="Css/LocaV.css">
    <link rel="stylesheet" href="connexion.css">
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
    <div>
        <form method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" required>
            <br>
            <label for="mot_passe">Mot de passe :</label>
            <input type="password" name="mot_passe" required>
            <br>
            <input type="submit" value="Se connecter">
        </form>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>

</body>
</html>
<?php include 'Includes/footer.php'; ?>
