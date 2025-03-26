<?php
session_start(); 
include __DIR__ . '/baseD.php';

if (isset($_GET['id'])) {
    $id_reservation = $_GET['id'];
    $reqUpdate = "UPDATE reservations SET statut = 'validée' WHERE id_reservation = $id_reservation";
    mysqli_query($mysqli, $reqUpdate);
    header('Location: admin/gestion_reservations.php');
}
?>