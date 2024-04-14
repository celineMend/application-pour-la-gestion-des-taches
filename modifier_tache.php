<?php
require_once 'config.php';

// Définition de l'ID de la tâche par défaut
$id_tache = null;

// Vérification si l'ID de la tâche à modifier est passé en paramètre GET
if (isset($_GET['id_tache']) && !empty($_GET['id_tache'])) {
    // Récupération de l'ID de la tâche depuis l'URL
    $id_tache = $_GET['id_tache'];

    // Requête SQL pour récupérer les informations de la tâche à modifier
    $sql = "SELECT * FROM tache WHERE id_tache = :id_tache";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id_tache', $id_tache);
    $stmt->execute();
    $tache = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification si la tâche existe dans la base de données
    if (!$tache) {
        // La tâche avec l'ID spécifié n'existe pas
        echo "La tâche spécifiée n'existe pas.";
        exit();
    }
} 

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    // Récupération des données du formulaire
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $date_echeance = $_POST['date_echeance'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat'];
    // Utilisation de l'ID de la tâche récupéré précédemment
    $id_tache = $_POST['id_tache'];

    // Modification des données de la tâche dans la base de données
    $sql = "UPDATE tache SET libelle = :libelle, description = :description, date_echeance = :date_echeance, priorite = :priorite, etat = :etat WHERE id_tache = :id_tache";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date_echeance', $date_echeance);
    $stmt->bindParam(':priorite', $priorite);
    $stmt->bindParam(':etat', $etat);
    $stmt->bindParam(':id_tache', $id_tache);

    try {
        // Exécution de la requête SQL
        $stmt->execute();
        // Redirection vers la page de liste des tâches après modification
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs de requête SQL
        echo "Erreur de requête SQL : " . $e->getMessage();
        exit();
    }
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
                <input type="text" id="libelle" name="libelle" value="<?php echo isset($tache['libelle']) ? $tache['libelle'] : ''; ?>" required><br>
            </div>
            <div class="mb-3">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" rows="3" required><?php echo isset($tache['description']) ? $tache['description'] : ''; ?></textarea><br>
            </div>
            <div class="mb-3">
                <label for="date_echeance">Date d'échéance :</label><br>
                <input type="datetime-local" id="date_echeance" name="date_echeance" value="<?php echo isset($tache['date_echeance']) ? date('Y-m-d\TH:i', strtotime($tache['date_echeance'])) : ''; ?>" required><br>
            </div>
            <div class="mb-3">
                <label for="priorite">Priorité :</label><br>
                <select id="priorite" name="priorite" required>
                    <option value="faible" <?php echo (isset($tache['priorite']) && $tache['priorite'] == 'faible') ? 'selected' : ''; ?>>Faible</option>
                    <option value="moyenne" <?php echo (isset($tache['priorite']) && $tache['priorite'] == 'moyenne') ? 'selected' : ''; ?>>Moyenne</option>
                    <option value="élevée" <?php echo (isset($tache['priorite']) && $tache['priorite'] == 'élevée') ? 'selected' : ''; ?>>Élevée</option>
                </select><br>
            </div>
            <div class="mb-3">
                <label for="etat">État :</label><br>
                <select id="etat" name="etat" required>
                    <option value="à faire" <?php echo (isset($tache['etat']) && $tache['etat'] == 'à faire') ? 'selected' : ''; ?>>À faire</option>
                    <option value="en cours" <?php echo (isset($tache['etat']) && $tache['etat'] == 'en cours') ? 'selected' : ''; ?>>En cours</option>
                    <option value="terminée" <?php echo (isset($tache['etat']) && $tache['etat'] == 'terminée') ? 'selected' : ''; ?>>Terminée</option>
                </select><br>
            </div>
             <!-- Champ caché pour l'ID de la tâche -->
             <input type="hidden" name="id_tache" value="<?php echo $id_tache; ?>">
            <input type="submit" class="btn btn-primary" name="submit" value="Modifier la tâche">
            </fieldset>
        </form>
    </div>
</body>
</html>
