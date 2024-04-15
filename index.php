<?php
// Inclusion du fichier de configuration et de la classe Tache
require_once("config.php");
require_once("tache.php");

// Définition des variables
$libelle = "Tâche 1";
$description = "Description de la tâche 1";
$date_echeance = "2024-04-12";
$priorite = 1;
$etat = "En cours";

// Création d'une instance de la classe Tache avec la connexion à la base de données
$tache = new Tache($connexion, $libelle, $description, $date_echeance, $priorite, $etat);

// Récupération de toutes les tâches
$taches = $tache->afficherToutesTaches();

// Vérification si des tâches sont présentes
if ($taches) {
    ?>
<?php
// Inclusion du fichier de configuration et de la classe Tache
require_once("config.php");
require_once("tache.php");

// Définition des variables
$libelle = "Tâche 1";
$description = "Description de la tâche 1";
$date_echeance = "2024-04-12";
$priorite = 1;
$etat = "En cours";

// Création d'une instance de la classe Tache avec la connexion à la base de données
$tache = new Tache($connexion, $libelle, $description, $date_echeance, $priorite, $etat);

// Récupération de toutes les tâches
$liste_taches = $tache->afficherToutesTaches();

// Vérification si des tâches sont présentes
if ($liste_taches) {
    ?>
 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tâches</title>
    <!-- Inclusion du CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    <Style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url("image/th2.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

/* En-tête */
header {
    background-color: #FFFF00;
    color: #fff;
    padding: 10px;
}

/* Titre */
h1 {
    margin: 0;
    font-size: 24px;
}

/* Boutons de connexion/déconnexion */
header a {
    color: #fff;
    text-decoration: none;
    float: right;
    margin-left: 20px;
}

/* Section des tâches */
section {
    padding: 20px;
}

/* Bouton "Ajouter une tâche" */
.add-task {
    background-color:  #FFFF00;
    color: #fff;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-bottom: 20px;
    cursor: pointer;
}

/* Tableau des tâches */
table {
    width: 100%;
    border-collapse: collapse;
    
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color:  #FFFF00;
}

/* Boutons d'action */
.action-btn {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-right: 5px;
    cursor: pointer;
}

.delete-btn {
    background-color: #f44336;
}
</style>

</head>
<body>
<header>
    <h1>Gestionnaire des taches</h1>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php">login</a></li>
        </ul>
    </nav>
</header>
<div class="container">
    
    <!-- Bouton pour ajouter une nouvelle tâche -->
    
    <table class="table">
        <thead>
        <h1>Mes Tâches</h1>
        <a href="ajout_tache.php" class="btn btn-primary">Ajouter une tache</a>
        <tr>
            <th scope="col">Libellé</th>
            <th scope="col">Description</th>
            <th scope="col">Date d'échéance</th>
            <th scope="col">Priorité</th>
            <th scope="col">État</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($liste_taches as $tache) : ?>
            <tr>
                <td><?php echo $tache['libelle']; ?></td>
                <td><?php echo $tache['description']; ?></td>
                <td><?php echo $tache['date_echeance']; ?></td>
                <td><?php echo $tache['priorite']; ?></td>
                <td><?php echo $tache['etat']; ?></td>
                <td>
                    <!-- Boutons pour supprimer et modifier les tâches -->
                    <a href="supprimer_tache.php?id=<?php echo $tache['id_tache']; ?>" class="btn btn-danger">Supprimer</a>
                    <a href="modifier_tache.php?id=<?php echo $tache['id_tache']; ?>" class="btn btn-primary">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php
} else {
    // Affichage d'un message si aucune tâche n'est présente
    echo "<p>Aucune tâche trouvée.</p>";
}
}
?>
