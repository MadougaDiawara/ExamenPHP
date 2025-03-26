<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['client_id'])) {
    // Détruire toutes les variables de session
    $_SESSION = array();
    
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion ou d'accueil
    header("Location: connexion.php");
    exit; // Toujours quitter après redirection
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page d'accueil
    header("Location: index.php");
    exit;
}
?>