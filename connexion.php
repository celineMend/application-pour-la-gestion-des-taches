<?php
// Inclusion de la classe Employe et du fichier de configuration de la base de données
require_once 'employe.php';
require_once 'config.php';

// Initialisation de la variable de message d'erreur
$nom = 'mendy';
$prenom = "celine";
$email = "celine.mendy84@gmail.com";



// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Création d'une instance de la classe Employe avec la connexion à la base de données
    $employe = new Employe($connexion, $nom, $prenom, $email, $mot_de_passe);

    // Authentification de l'employé
    if ($employe->authentification($email, $mot_de_passe)) {
        // Redirection vers la page de tableau de bord (ou une autre page sécurisée)
        header("Location: ajout_tache.php");
        exit();
    } else {
        // Affichage d'un message d'erreur si l'authentification échoue
        echo "Email ou mot de passe incorrect.";
        
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div>
        <a href="ajout_tache.php" class="btn btn-primary"input type="submit" value="Se connecter">"Se connecter"</a>
            
        </div>
    </form>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>
