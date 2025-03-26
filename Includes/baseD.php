<?php 
$host = 'mysql-projetphpmysql.alwaysdata.net'; 
$baseD = 'projetphpmysql_locationvehicule'; 
$client = '406095_locv'; 
$mot_pass = '2579_ndaamar'; 
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $client, $mot_pass, $baseD);

if ($mysqli->connect_error) {
    die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>


