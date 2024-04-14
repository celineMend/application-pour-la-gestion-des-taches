
<?php
require_once("config.php");
require_once("tache.php");

// Vérifie si le formulaire d'ajout de tâche a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Vérification si l'utilisateur est connecté
    if (!isset($_SESSION['employe'])) {
        // Redirection vers la page de connexion s'il n'est pas connecté
        header("Location: ajout_tache.php?page=connecter");
        exit(); // Arrêtez l'exécution du script
    }
    
    // Récupère les informations de l'utilisateur
    $employe = $_SESSION['employe'];

    // Récupération des données du formulaire
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $dateEcheance = $_POST['dateEcheance'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat'];
    $id_employe = $employe->getId();  

    // Création d'une nouvelle instance de la classe Tache
    $tache = new Tache($connexion, $libelle, $description, $dateEcheance, $priorite, $etat, $id_employe);

    // Appel de la méthode create pour ajouter la tâche à la base de données
    $tache->create();

    // Redirection vers la page d'accueil après l'ajout de la tâche
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <!-- Inclusion du CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter une tâche</h1>
        <form method="post" action="ajout_tache.php">
            <fieldset>
            <div class="mb-3">
                <label for="libelle">Libellé :</label><br>
                <input type="text" id="libelle" name="libelle" required><br>
            </div>
            <div class="mb-3">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" rows="3" required></textarea><br>
            </div>
            <div class="mb-3">
                <label for="dateEcheance">Date d'échéance :</label><br>
                <input type="datetime-local" id="dateEcheance" name="dateEcheance" required><br>
            </div>
            <div class="mb-3">
                <label for="priorite">Priorité :</label><br>
                <select id="priorite" name="priorite" required>
                    <option value="faible">Faible</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="élevée">Élevée</option>
                </select><br>
            </div>
            <div class="mb-3">
                <label for="etat">État :</label><br>
                <select id="etat" name="etat" required>
                    <option value="à faire">A faire</option>
                    <option value="en cours">En cours</option>
                    <option value="terminée">Terminée</option>
                </select><br>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Ajouter une tache">
            </fieldset>
        </form>
    </div>
</body>
</html>