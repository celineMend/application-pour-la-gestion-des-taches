<?php
// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id_employe'])) {
    // Redirection vers la page de connexion s'il n'est pas connecté
    header("Location: modifier_tache.php");
    exit(); // Arrêtez l'exécution du script
}

// Inclure le fichier de configuration et la classe Tache
require_once 'config.php';
require_once 'Tache.php';

// Vérification si l'ID de la tâche à modifier est passé en paramètre GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_tache = $_GET['id'];

    // Requête SQL pour récupérer les informations de la tâche à modifier
    $sql = "SELECT * FROM taches WHERE id_tache = :id_tache";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id_tache', $id_tache);
    $stmt->execute();
    $tache = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tache) {
        // La tâche avec l'ID spécifié n'existe pas
        echo "La tâche spécifiée n'existe pas.";
        exit();
    }
} else {
    // L'ID de la tâche n'est pas spécifié dans l'URL
    echo "L'ID de la tâche n'est pas spécifié.";
    exit();
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $dateEcheance = $_POST['dateEcheance'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat'];

    // Modification des données de la tâche dans la base de données
    $sql = "UPDATE taches SET libelle = :libelle, description = :description, date_echeance = :dateEcheance, priorite = :priorite, etat = :etat WHERE id_tache = :id_tache";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':dateEcheance', $dateEcheance);
    $stmt->bindParam(':priorite', $priorite);
    $stmt->bindParam(':etat', $etat);
    $stmt->bindParam(':id_tache', $id_tache);
    $stmt->execute();

    // Redirection vers la page de liste des tâches après modification
    header("Location: liste_taches.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une tâche</title>
    <!-- Inclusion du CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Modifier une tâche</h1>
        <form method="post" action="modifier_tache.php?id=<?php echo $id_tache; ?>">
            <fieldset>
            <div class="mb-3">
                <label for="libelle">Libellé :</label><br>
                <input type="text" id="libelle" name="libelle" value="<?php echo $tache['libelle']; ?>" required><br>
            </div>
            <div class="mb-3">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" rows="3" required><?php echo $tache['description']; ?></textarea><br>
            </div>
            <div class="mb-3">
                <label for="dateEcheance">Date d'échéance :</label><br>
                <input type="datetime-local" id="dateEcheance" name="dateEcheance" value="<?php echo date('Y-m-d\TH:i', strtotime($tache['date_echeance'])); ?>" required><br>
            </div>
            <div class="mb-3">
                <label for="priorite">Priorité :</label><br>
                <select id="priorite" name="priorite" required>
                    <option value="faible" <?php if ($tache['priorite'] == 'faible') echo 'selected'; ?>>Faible</option>
                    <option value="moyenne" <?php if ($tache['priorite'] == 'moyenne') echo 'selected'; ?>>Moyenne</option>
                    <option value="élevée" <?php if ($tache['priorite'] == 'élevée') echo 'selected'; ?>>Élevée</option>
                </select><br>
            </div>
            <div class="mb-3">
                <label for="
