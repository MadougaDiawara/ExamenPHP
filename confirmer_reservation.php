<?php
session_start();
include 'Includes/baseD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_voiture = intval($_POST['id_voiture']);
    $nom_client = trim($_POST['nom_client']);
    $email_client = filter_var(trim($_POST['email_client']), FILTER_SANITIZE_EMAIL);

    // Vérification des données
    if (empty($nom_client) || empty($email_client) || !filter_var($email_client, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Nom et email valides sont requis.";
        header("Location: details_voiture.php?id_voiture=$id_voiture");
        exit;
    }

    // Enregistrement de la réservation
    $stmt = $mysqli->prepare("INSERT INTO reservations (id_voiture, nom_client, email_client, date_debut, statut) VALUES (?, ?, ?, NOW(), 'en attente')");
    
    if (!$stmt) {
        die("Erreur de préparation : " . $mysqli->error);
    }

    $stmt->bind_param("iss", $id_voiture, $nom_client, $email_client);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Réservation réussie !";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Erreur lors de la réservation : " . $mysqli->error;
        header("Location: details_voiture.php?id_voiture=$id_voiture");
    }
    
    $stmt->close();
} else {
    header("Location: index.php");
}
?>