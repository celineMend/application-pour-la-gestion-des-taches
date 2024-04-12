<?php
// Inclusion du fichier de configuration et de la classe Tache

require_once 'tache.php';

session_start();
// Vérification si le formulaire est soumis
if(isset($_SESSION['id_employe'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: index.php");
    exit; // Arrêtez l'exécution du script
}
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de classe contenant la méthode creerTache
    require_once 'config.php';

    // Récupération des données du formulaire
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $dateEcheance = $_POST['dateEcheance'];
    $priorite = $_POST['priorite'];
    $etat = 'à faire'; // Définissez l'état initial
    $id_employe = $_SESSION['id']; // Obtenez l'ID de l'utilisateur à partir de la session
    // Création d'une nouvelle instance de la classe Tache
    $tache = new Tache($connexion,"Acheter des fournitures de bureau", "Acheter des stylos, des cahiers, etc.", "2024-04-30", "Haute", "En cours", 1);

    // Appel de la méthode creerTache pour ajouter la tâche à la base de données
    if($tache->createTache($libelle, $description, $dateEcheance, $priorite, $etat, $id_tache)) {
        // Redirection vers la page principale après l'ajout
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la tâche.";
    }
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
        <form method="post" action="">
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
            <input type="submit" class="btn btn-primary" name="submit" value="Ajouter">
            </fieldset>
        </form>
    </div>
</body>
</html>
