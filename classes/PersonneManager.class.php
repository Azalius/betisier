<?php
require_once("Personne.class.php");
class PersonneManager{
	private $db;
		public function __construct($bede){
			$this->db = $bede;
		}

	public function getAllPers() {
		$listePers = array();
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel FROM personne';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($pers = $requete->fetch(PDO::FETCH_OBJ)){
			$listePers[] = new Personne($pers);
		}
		$requete->closeCursor();
		return $listePers;
	}
  public function nbPers(){
    $sql = 'SELECT COUNT(per_num) as total FROM personne';
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $nbpers = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $nbpers->total;
  }
	public function getPers($idPers){
		$sql = 'SELECT per_num, per_nom, per_prenom,per_mail, per_tel FROM personne WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret = new Personne($pers);
		return $aret;
	}
	public function isEtu($idpers){
		$sql = 'SELECT COUNT(per_num) as total FROM etudiant WHERE per_num = '.$idPers;
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $nbpers = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $nbpers->total != 0;
	}
	public function toEtu($idPers){
		$sql = 'SELECT per_num, per_nom, per_prenom FROM personne WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret = new Personne($pers);
		$sql = 'SELECT div_num, dep_num FROM etudiant WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret->add($pers)
	}
}
?>
