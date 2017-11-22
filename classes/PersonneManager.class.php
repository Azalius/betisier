<?php
require_once("Personne.class.php");
class PersonneManager{
	private $db;
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
		//print_r($listeFonc);
		return $listeFonc;
	}
	public function getAllAnnee(){
		$listAn = array();
		$sql = 'SELECT div_num, div_nom FROM division';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($an = $requete->fetch(PDO::FETCH_OBJ)){
			foreach($an as $attribut => $valeur){
				switch($attribut){
					case 'div_num' : $num = $valeur;break;
					case 'div_nom' : $listeAn[$num] = $valeur;break;
				}
			}
		}
		$requete->closeCursor();
		return $listeAn;
	}
	public function getAllDepartement(){
		$listeDep = array();
		$sql = 'SELECT dep_num, dep_nom FROM departement';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($fonc = $requete->fetch(PDO::FETCH_OBJ)){
			foreach($fonc as $attribut => $valeur){
				switch($attribut){
					case 'dep_num' : $num = $valeur;break;
					case 'dep_nom' : $listeDep[$num] = $valeur;break;
				}
			}
		}
		$requete->closeCursor();
		//print_r($listeFonc);
		return $listeDep;
	}
	public function getAllEnseignant(){
		$listEns = array();
		$sql = 'SELECT p.per_num, per_nom FROM personne p, salarie s, fonction f WHERE p.per_num = s.per_num AND s.fon_num = f.fon_num AND fon_libelle = '."'".'Enseignant'."'" ;
		print_r($sql);
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($fonc = $requete->fetch(PDO::FETCH_OBJ)){
			foreach($fonc as $attribut => $valeur){
				switch($attribut){
					case 'per_num' : $num = $valeur;break;
					case 'per_nom' : $listeEns[$num] = $valeur;break;
				}
			}
		}
		$requete->closeCursor();
		print_r($listeEns);
		return $listeEns;
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
	public function getPersFromLogin($log){
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel, per_login FROM personne WHERE per_login = '.'"'.$log.'"';
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
	}
	public function AjoutEtudiant($data){
		$nb = $this->finAjoutPersonne();
		$sql = "INSERT INTO etudiant(per_num, dep_num, div_num) VALUES
		(".$nb.', '.$data["departement"].', '.$data["annee"].')';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$requete->closeCursor();
	}
	public function AjoutSalarie($data){
		$nb = $this->finAjoutPersonne();
		$sql = "INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES
		(".$nb.', '.$data["telpro"].', '.$data["fonction"].')';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$requete->closeCursor();
	}
	public function finAjoutPersonne(){
		$sql = 'INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd, per_admin)
		values ('.$_SESSION["nom"].', '.$_SESSION["prenom"].', '.
		$_SESSION["telephone"].', '.$_SESSION["mail"].', '.$_SESSION["login"].', '.
		toPassword($_SESSION["password"]).', 0)';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$id = $this->db->lastInsertId();
		$requete->closeCursor();
		return $id;
	}
}
?>
