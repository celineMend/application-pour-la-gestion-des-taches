<?php
// Inclure le fichier de configuration de la base de données
require_once "config.php";

// Vérifie si le formulaire d'ajout de tâche a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupérer les données du formulaire
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $dateEcheance = $_POST['dateEcheance'];
        $priorite = $_POST['priorite'];
        $etat = $_POST['etat'];

        // Afficher les valeurs postées pour vérification
        echo "Libellé : " . $libelle . "<br>";
        echo "Description : " . $description . "<br>";
        echo "Date d'échéance : " . $dateEcheance . "<br>";
        echo "Priorité : " . $priorite . "<br>";
        echo "État : " . $etat . "<br>";

        // Préparer la requête d'insertion
        $sql = "INSERT INTO tache (libelle, description, date_echeance, priorite, etat) VALUES (:libelle, :description, :dateEcheance, :priorite, :etat)";
        $stmt = $connexion->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':libelle', $libelle);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':dateEcheance', $dateEcheance);
        $stmt->bindParam(':priorite', $priorite);
        $stmt->bindParam(':etat', $etat);

        // Exécution de la requête
        $stmt->execute();

        // Redirection vers la page d'accueil après l'ajout de la tâche
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        // Affichage de l'erreur PDO
        echo "Erreur PDO : " . $e->getMessage();
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
