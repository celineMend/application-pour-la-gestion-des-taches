<?php
require_once ("validation.php");
require_once ("config.php");
require_once ("interfaces_crud.php");

class Tache implements Itache {
    private $connexion;
    private $libelle;
    private $description;
    private $date_echeance;
    private $priorite;
    private $etat;

    // Constructeur
    public function __construct($connexion, $libelle, $description, $date_echeance, $priorite, $etat) {
        $this->connexion = $connexion;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->date_echeance = $date_echeance;
        $this->priorite = $priorite;
        $this->etat = $etat;

    }

    // Méthode pour ajouter une nouvelle tâche
    public function create($libelle, $description, $date_echeance, $priorite, $etat ,$id_employe) {
        try {
            // Préparation de la requête d'insertion
            $query = "INSERT INTO tache (libelle, description, date_echeance, priorite, etat) VALUES (:libelle, :description, :date_echeance, :priorite, :etat)";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(":libelle", $libelle);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":date_echeance", $date_echeance);
            $stmt->bindParam(":priorite", $priorite);
            $stmt->bindParam(":etat", $etat);

            // Exécution de la requête
            $stmt->execute();

            return true; // Succès
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de l'ajout de la tâche : " . $e->getMessage();
            return false;
        }
    }
    public function afficherToutesTaches() {
        try {
            // Préparation de la requête de sélection
            $query = "SELECT * FROM tache";
            $stmt = $this->connexion->prepare($query);
            // Exécution de la requête
            $stmt->execute();
            // Récupération de toutes les tâches
            $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $taches;
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de la récupération des tâches : " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour afficher les détails d'une tâche
    public function read($id_tache) {
        try {
            // Préparation de la requête de sélection
            $query = "SELECT * FROM tache WHERE id = :id_tache";
            $stmt = $this->connexion->prepare($query);
            // Liaison de la valeur du paramètre :id_tache à l'identifiant de la tâche
            $stmt->bindParam(":id_tache", $id_tache);
            // Exécution de la requête
            $stmt->execute();
            // Récupération de la tâche
            $tache = $stmt->fetch(PDO::FETCH_ASSOC);
            return $tache;
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de la récupération de la tâche : " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour modifier une tâche existante
    public function update($id_tache, $libelle, $description, $date_echeance, $priorite, $etat) {
        try {
            // Préparation de la requête de mise à jour
            $query = "UPDATE tache SET libelle = :libelle, description = :description, date_echeance = :date_echeance, priorite = :priorite, etat = :etat WHERE id = :id_tache";
            $stmt = $this->connexion->prepare($query);
            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(":id_tache", $id_tache);
            $stmt->bindParam(":libelle", $libelle);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":date_echeance", $date_echeance);
            $stmt->bindParam(":priorite", $priorite);
            $stmt->bindParam(":etat", $etat);
            // Exécution de la requête
            $stmt->execute();
            return true; // Succès
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de la modification de la tâche : " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour supprimer une tâche
    public function delete($id_tache) {
        try {
            // Préparation de la requête de suppression
            $query = "DELETE FROM tache WHERE id = :id_tache";
            $stmt = $this->connexion->prepare($query);
            // Liaison de la valeur du paramètre :id_tache à l'identifiant de la tâche
            $stmt->bindParam(":id_tache", $id_tache);
            // Exécution de la requête
            $stmt->execute();
            return true; // Succès
        } catch(PDOException $e) {
            // En cas d'erreur, afficher l'erreur et renvoyer false
            echo "Erreur lors de la suppression de la tâche : " . $e->getMessage();
            return false;
        }
    }
}
?>
