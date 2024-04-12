<?php
interface Iemploye
{
public function create($nom , $prenom ,$email ,$mot_de_passe);
public function read($id_employe);
public function update($id_employe ,$nom , $prenom ,$email ,$mot_de_passe);
public function delete();
}

interface Itache
{
public function create( $libelle, $description, $date_echeance, $priorite, $etat,$id_employe);
public function read($id_tache);
public function update($id_tache, $libelle, $description, $date_echeance, $priorite, $etat);
public function delete($id_tache);
}
?>