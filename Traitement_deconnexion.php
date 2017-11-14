<?php 
session_start();
// Suppression des variables de session et de la session

$_SESSION = array();
session_destroy();
$_SESSION['Compteur_erreur'] = 0;

//suppression du cookie de connexion
setcookie('Connex');
header('Location: Acces.php');

?>