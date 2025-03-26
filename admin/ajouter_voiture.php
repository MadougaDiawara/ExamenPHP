<?php
include '../Includes/baseD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee_fabrication'];
    $plaque = $_POST['plaque_immatriculation'];
    $prix = $_POST['prix'];

    $query = "INSERT INTO voitures (marque, modele, annee_fabrication, plaque_immatriculation, prix) VALUES ('$marque', '$modele', $annee, '$plaque', $prix)";
    mysqli_query($mysqli, $query);
    header("Location: admin.php");
}
?>