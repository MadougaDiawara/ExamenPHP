<?php
session_start();
include '../Includes/baseD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $password = $_POST['mot_passe'];

    // Vérification et insertion dans la base de données
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Hash du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparation de la requête d'insertion
        $stmt = $mysqli->prepare("INSERT INTO administrateurs (nom_utilisateur, email, mot_passe) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            $error = "Erreur lors de l'inscription : " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/LocV_admin.css" type="text/css">
    <title>Inscription Administrateur</title>
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

<form method="post" action="">
    <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mot_passe" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>

<?php if (isset($error)) echo "<p>$error</p>"; ?>
<?php if (isset($success)) echo "<p>$success</p>"; ?>

</body>
</html>
<?php include 'footer_admin.php'; ?>