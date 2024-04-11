<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gestion des taches');

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Configuration des attributs de la connexion PDO pour afficher les erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Afficher un message si la connexion réussit
    echo "Connexion à la base de données réussie.";

    // Vous pouvez effectuer d'autres opérations avec la base de données ici...

} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher le message d'erreur
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}
?>

