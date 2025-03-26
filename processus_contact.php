<?php
include 'Includes/baseD.php';
include 'Includes/header.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Préparer une requête pour insérer le message dans une table (optionnelle)
    $stmt = $mysqli->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    // Vous pouvez également envoyer un e-mail si nécessaire
    // mail($recipient, $subject, $message, $headers);

    // Rediriger vers la page de contact avec un message de succès
    header("Location: contact.php?success=1");
    exit();
}
?>