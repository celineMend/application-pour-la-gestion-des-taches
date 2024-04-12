<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_employe'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ajout_tache.ph");
    exit; // Arrêter l'exécution du script
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de classe contenant la méthode creerTache
    require_once 'config.php';

    // Récupérer les valeurs du formulaire
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $dateEcheance = $_POST['dateEcheance'];
    $priorite = $_POST['priorite'];
    $etat = 'à faire'; // Définir l'état initial
    $id_employe = $_SESSION['id_employe']; // Obtenir l'ID de l'utilisateur à partir de la session

    // Créer une nouvelle instance de la classe Tache
    $tache = new Tache($connexion, "Acheter des fournitures de bureau", "Acheter des stylos, des cahiers, etc.", "2024-04-30", "Haute", "En cours", "1");

    // Appeler la méthode creerTache pour créer une nouvelle tâche
    $tache->creerTache($libelle, $description, $dateEcheance, $priorite, $etat, $id_employe);

    // Rediriger l'utilisateur vers une autre page après la création de la tâche
    header("Location: ajout_tache.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Créer une tâche</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="libelle">Libellé :</label>
                <input type="text"  id="libelle" name="libelle" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea  id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="dateEcheance">Date et heure d'échéance :</label>
                <input type="datetime-local"  id="dateEcheance" name="dateEcheance" required>
            </div>
            <div class="form-group">
                <label for="priorite">Priorité :</label>
                <select  id="priorite" name="priorite" required>
                    <option value="faible">Faible</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="élevée">Élevée</option>
                </select>
            </div>
            <!-- Ajoutez d'autres champs selon vos besoins -->
            <button type="submit" class="btn btn-primary">Créer la tâche</button>
        </form>
    </div>
</body>
</html>
