<?php
session_start();
include 'Includes/baseD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mot_passe = trim($_POST['mot_passe']);

    if (empty($email) || empty($mot_passe)) {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header("Location: connexion.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Adresse e-mail invalide.";
        header("Location: connexion.php");
        exit();
    }

    $stmt = $mysqli->prepare("SELECT id_client, mot_passe FROM clients WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();

        if ($client && password_verify($mot_passe, $client['mot_passe'])) {
            $_SESSION['client_id'] = $client['id_client'];
            header("Location: profil.php");
            exit();
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Erreur interne.";
    }

    header("Location: connexion.php");
    exit();
}
