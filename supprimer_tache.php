<?php
require_once "config.php";

if(isset($_GET['id'])){
    $idTache = $_GET['id'];
    
    // Requête SQL pour supprimer la tâche de la base de données
    $sql = "DELETE FROM tache WHERE id_tache = :id_tache";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id_tache', $idTache);
    
    try {
        // Exécution de la requête SQL
        $stmt->execute();
        // Redirection vers la page de liste des tâches après suppression
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs de requête SQL
        echo "Erreur de requête SQL : " . $e->getMessage();
        exit();
    }
} else {
    // L'ID de la tâche à supprimer n'est pas spécifié dans l'URL
    echo "L'ID de la tâche à supprimer n'est pas spécifié.";
    exit();
}
?>
 