<?php
session_start();
include '../Includes/baseD.php';

if (!isset($_SESSION['admin'])) {
    header("Location: connexion_admin.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécurisation de l'ID
    $query = "DELETE FROM administrateurs WHERE id_admin=$id";
    
    if (mysqli_query($mysqli, $query)) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'administrateur : " . mysqli_error($mysqli);
    }
} else {
    echo "Aucun ID spécifié.";
}
?>