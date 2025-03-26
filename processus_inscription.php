<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Afrique/Dakar'); // Conserver si correct pour votre région

include 'Includes/baseD.php';
include 'Includes/header.php';

// Vérification connexion DB immédiate
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required_fields = ['nom', 'prenom', 'email', 'mot_passe', 'date_naissance', 'adresse', 'num_permis'];
    foreach ($required_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $_SESSION['erreur'] = "Tous les champs sont obligatoires";
            header("Location: inscription.php");
            exit();
        }
    }

    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $date_naissance = $_POST['date_naissance'];
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $num_permis = htmlspecialchars(trim($_POST['num_permis']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erreur'] = "Format d'email invalide";
        header("Location: inscription.php");
        exit();
    }

    $date_obj = DateTime::createFromFormat('Y-m-d', $date_naissance);
    if (!$date_obj) {
        $_SESSION['erreur'] = "Format de date invalide (AAAA-MM-JJ requis)";
        header("Location: inscription.php");
        exit();
    }

    $age = $date_obj->diff(new DateTime())->y;
    if ($age < 18) {
        $_SESSION['erreur'] = "Inscription réservée aux majeurs (18 ans minimum)";
        header("Location: inscription.php");
        exit();
    }

    $mot_passe = trim($_POST['mot_passe']);
    if (strlen($mot_passe) < 8) {
        $_SESSION['erreur'] = "Le mot de passe doit contenir au moins 8 caractères";
        header("Location: inscription.php");
        exit();
    }
    $mot_passe_hash = password_hash($mot_passe, PASSWORD_DEFAULT); // Correction ici

    try {
        $stmt = $mysqli->prepare("SELECT id_client FROM clients WHERE email = ?");
        if (!$stmt) throw new Exception("Erreur de préparation: " . $mysqli->error);
        
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) throw new Exception("Erreur d'exécution: " . $stmt->error);
        
        if ($stmt->get_result()->num_rows > 0) {
            $_SESSION['erreur'] = "Cet email est déjà utilisé";
            header("Location: inscription.php");
            exit();
        }
        $stmt->close();

        $stmt = $mysqli->prepare("INSERT INTO clients (nom, prenom, email, mot_passe, date_naissance, adresse, num_permis) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) throw new Exception("Erreur de préparation: " . $mysqli->error);

        $stmt->bind_param("sssssss", $nom, $prenom, $email, $mot_passe_hash, $date_naissance, $adresse, $num_permis);
        
        if (!$stmt->execute()) throw new Exception("Erreur d'inscription: " . $stmt->error);

        $_SESSION['succes'] = "Inscription réussie! Vous pouvez vous connecter";
        header("Location: connexion.php");
        exit();

    } catch (Exception $e) {
        error_log($e->getMessage());
        $_SESSION['erreur'] = "Une erreur technique est survenue";
        header("Location: inscription.php");
        exit();
    } finally {
        if (isset($stmt)) $stmt->close();
        $mysqli->close();
    }
} else {
    header("Location: inscription.php");
    exit();
}