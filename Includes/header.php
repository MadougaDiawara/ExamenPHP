<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Js/LocaV.js" defer></script>
    <link rel="stylesheet" href="Css/LocaV.css" type="text/css">
    <title>NdaaMar - Location de Véhicules</title>

    <?php
    // Détection de la page actuelle
    $current_page = basename($_SERVER['PHP_SELF']);

    // Ajout de styles spécifiques selon la page
    if ($current_page === 'connexion.php') {
        echo '<link rel="stylesheet" href="connexion.css">';
    } elseif ($current_page === 'inscription.php') {
        echo '<link rel="stylesheet" href="inscription.css">';
    }
    ?>
</head>
<body>
<header>
    
</header>
