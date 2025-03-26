<?php
session_start();
include 'Includes/baseD.php';
include 'Includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $montant = $_POST['montant'];
    $id_reservation = $_SESSION['id_reservation']; // Assurez-vous que cette variable est définie lors de la réservation

    $reqInsert = "INSERT INTO paiements (id_reservation, montant, statut) VALUES ('$id_reservation', '$montant', 'en attente')";
    
    if (mysqli_query($mysqli, $reqInsert)) {
        echo "Paiement effectué avec succès!";
    } else {
        echo "Erreur: " . mysqli_error($mysqli);
    }
}
?>