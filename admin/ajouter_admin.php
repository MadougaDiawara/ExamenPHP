<?php
session_start();
include '../Includes/baseD.php';

if (!isset($_SESSION['admin'])) {
    header("Location: connexion_admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_passe = password_hash($_POST['mot_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Vérifiez si l'email existe déjà
    $query = "SELECT * FROM administrateurs WHERE email='$email'";
    $result = mysqli_query($mysqli, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        $query = "INSERT INTO administrateurs (nom_utilisateur, email, mot_passe) VALUES ('$nom_utilisateur', '$email', '$mot_passe')";
        if (mysqli_query($mysqli, $query)) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'administrateur : " . mysqli_error($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../admin/LocV_admin.css" type="text/css">
    <title>Ajouter un Administrateur</title>
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
        <a href="ajouter_admin.php">+Administrateur</a>  
    </div>
    <p class="NomSite">NdaaMar</p>
</div>
    <h1>Ajouter un Administrateur</h1>
    <form action="" method="post">
        <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_passe" placeholder="Mot de passe" required>
        <button type="submit">Ajouter Administrateur</button>
    </form>
</body>
</html>
<?php include 'footer_admin.php'; ?>