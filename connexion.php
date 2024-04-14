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
        header("Location: index.php");
        exit();
    } else {
        // Affichage d'un message d'erreur si l'authentification échoue
        echo "Email ou mot de passe incorrect.";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Lien vers votre fichier CSS personnalisé -->
    <link rel="stylesheet" href="style.css">


</head>
<body >
<div class="container shadow-lg ">
    <div class="row">
        <div class="partie-icon col-md-6 d-flex flex-column justify-content-center align-items-center ">
                <div class="icon-container">
                <i class="fas fa-user fa-5x" style="color: white;"></i>
                </div>
                <h2>Connexion</h2>
        </div>
        <div class="col-md-6 ">
            <div class="custom-login-form">
                <form action="index.php" method="POST"> <!-- Correction ici: action pointe vers login_session.php -->
                <div class="form-group ">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope fa-xl"></i></span>
                        </div>
                        <input type="email" class="form-control " id="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock fa-xl"></i></span>
                        </div>
                        <input type="mot_de_passe"  class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary btn-block custom-btn-primary">CONNECTER</button>
                </form>
                <p class="mt-3">Pas encore inscrit ? <a href="index.php" class="custom-btn-secondary">Inscrivez-vous ici</a></p>
            </div>
        </div>
        
    </div>
</div>

    <!-- Intégration de Bootstrap JavaScript (optionnel) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>