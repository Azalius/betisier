<?php
require_once("Personne.class.php");
class PersonneManager{
	private $db;
	private $persAjout;
		public function __construct($bede){
			$this->db = $bede;
		}
	public function getAllFunction(){
		$listFonc = array();
		$sql = 'SELECT fon_num, fon_libelle FROM fonction';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($fonc = $requete->fetch(PDO::FETCH_OBJ)){
			foreach($fonc as $attribut => $valeur){
				switch($attribut){
					case 'fon_num' : $num = $valeur;break;
					case 'fon_libelle' : $listeFonc[$num] = $valeur;break;
				}
			}
		}
		$requete->closeCursor();
		print_r($listeFonc);
		return $listeFonc;
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
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel FROM personne WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret = new Personne($pers);
		return $aret;
	}
	public function isEtu($idPers){
		$sql = 'SELECT COUNT(per_num) as total FROM etudiant WHERE per_num = '.$idPers;
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $nbpers = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $nbpers->total != 0;
	}
	public function toEtu($idPers){
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel FROM personne WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret = new Etudiant($pers);
		$sql = 'SELECT div_num, dep_num FROM etudiant WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret->add($pers);
		return $aret;
	}
	public function toProf($idPers){
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel FROM personne WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret = new Salarie($pers);
		$sql = 'SELECT sal_telprof, fon_num FROM salarie WHERE per_num = '.$idPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		$aret->add($pers);
		return $aret;
	}
	public function prepAjoutPersonne($data){
		$this->persAjout = 'INSERT INTO personne()';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
	}
	public function finAjoutEtudiant($data){

	}
	public function finAjoutSalarie($data){
		$sql = 'INSERT INTO salarie()';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$pers = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
	}
}
?>
