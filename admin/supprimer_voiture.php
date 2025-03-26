<?php
include '../Includes/baseD.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($mysqli, "DELETE FROM voitures WHERE id=$id");
    header("Location: admin.php");
}
?>