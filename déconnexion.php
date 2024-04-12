<?php
// Démarrage de la session
session_start();

// Destruction de toutes les données de session
session_destroy();

// Redirection vers la page de connexion
header("Location: connexion.php");
exit();
?>
