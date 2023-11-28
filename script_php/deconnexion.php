<?php 
// Démarrez la session (si ce n'est pas déjà fait)
session_start();

// Détruire la session
session_destroy();

// Redirection vers la page d'accueil avec un paramètre "retour"
header("location:../index.php?page=home&retour=deco");
?>
