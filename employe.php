<?php
require_once ("validation.php");
require_once ("config.php");
class Employe{
    private $connexion;
    private $id_employe;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;


     // Constructeur
     public function __construct($connexion, $nom, $prenom, $email, $mot_de_passe) {
        $this->connexion = $connexion;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }
    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }


    public function inscription($nom, $prenom, $email, $mot_de_passe) {
        // Validation des données d'inscription
        if (!Validation::validerEmail($email)) {
            return false;
        }

        // Hashage du mot de passe
        $hash_mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        try {
            // Préparation de la requête d'insertion
            $sql = "INSERT INTO Employe (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
            $stmt = $this->connexion->prepare($sql);
            
            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":mot_de_passe", $hash_mot_de_passe);
            
            // Exécution de la requête
            $stmt->execute();
            
            return true; // Succès
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de l'inscription de l'employé : " . $e->getMessage();
            return false;
        }
    }
    public function authentification($email, $mot_de_passe) {
        try {
            // Requête SQL avec des paramètres de requête nommés
            $sql = "SELECT * FROM Employe WHERE email = :email";
            $stmt = $this->connexion->prepare($sql);
            
            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':email', $email);
            
            // Exécution de la requête
            $stmt->execute();
            
            // Récupération de l'employé correspondant à l'email fourni
            $employe = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Vérification si un employé est trouvé et si le mot de passe correspond
            if ($employe && password_verify($mot_de_passe, $employe['mot_de_passe'])) {
                // Démarrage de la session
                session_start();
                // Stockage des données de l'employé dans la session
                $_SESSION['employe'] = $employe;
                // Authentification réussie
                return true;
            } else {
                // Authentification échouée
                return false;
            }
    
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de l'authentification de l'employé : " . $e->getMessage();
            return false;
        }
        header("location:index.php");
    }
    public function déconnexion() {
        // Démarrage de la session
        session_start();
        
        // Destruction de la session
        session_destroy();
        
        // Redirection vers la page d'accueil
        header("location: index.php");
    }
    public function liste_des_taches() {
        try {
            // Vérifier si la session est démarrée
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            // Vérifier si l'employé est connecté et récupérer son ID
            if (isset($_SESSION['employe']) && isset($_SESSION['employe']['id'])) {
                $id_employe = $_SESSION['employe']['id'];
                
                // Préparation de la requête SQL pour sélectionner les tâches de l'employé
                $sql = "SELECT * FROM taches WHERE id_employe = :id_employe";
                $stmt = $this->connexion->prepare($sql);
                
                // Liaison des valeurs aux paramètres de la requête
                $stmt->bindParam(':id_employe', $id_employe);
                
                // Exécution de la requête
                $stmt->execute();
                
                // Récupération des résultats
                $liste_taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Retourner la liste des tâches de l'employé
                return $liste_taches;
            } else {
                // Si l'employé n'est pas connecté, retourner une erreur ou une valeur par défaut
                return "Aucun employé connecté";
            }
        } catch (PDOException $e) {
            // En cas d'erreur, afficher l'erreur et retourner false
            echo "Erreur lors de la récupération de la liste des tâches de l'employé : " . $e->getMessage();
            return false;
        }
    }
    
    
    
    

    

  

   

}



?>