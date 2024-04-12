<?php
class ValidationUtilitaire {
    // Fonction de validation du nom et du prénom
    public static function validerNomPrenom($valeur) {
        // Le nom et le prénom doivent contenir uniquement des lettres et des espaces
        return preg_match('/^[a-zA-Z\s]+$/', $valeur);
    }

    // Fonction de validation de l'adresse e-mail
    public static function validerEmail($email) {
        // Utilisation de la fonction filter_var de PHP pour valider l'adresse e-mail
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Fonction de validation du mot de passe
    public static function validerMotDePasse($motDePasse) {
        // Le mot de passe doit avoir au moins 8 caractères
        return strlen($motDePasse) >= 8;
    }
}
?>