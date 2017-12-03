<?php
require_once("Personne.class.php");
class PersonneManager{
	private $db;
		public function __construct($bede){
			$this->db = $bede;
		}
	public function getAllEnseignant(){
		$listEns = array();
		$sql = 'SELECT p.per_num, per_nom FROM personne p, salarie s, fonction f WHERE p.per_num = s.per_num AND s.fon_num = f.fon_num AND fon_libelle = '."'".'Enseignant'."'" ;
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
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel, per_login, per_admin FROM personne WHERE per_login = '.'"'.$log.'"';
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
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel, per_login, per_pwd FROM personne WHERE per_num = '.$idPers;
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
		$sql = 'SELECT per_num, per_nom, per_prenom, per_mail, per_tel, per_login, per_pwd FROM personne WHERE per_num = '.$idPers;
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
	public function ajoutEtudiant($data){
		$nb = $this->finAjoutPersonne();
		$sql = "INSERT INTO etudiant(per_num, dep_num, div_num) VALUES
		(".$nb.', '.$data["departement"].', '.$data["annee"].')';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$requete->closeCursor();
	}
	public function ajoutSalarie($data){
		$nb = $this->finAjoutPersonne();
		$sql = "INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES
		(".$nb.', '.$data["telpro"].', '.$data["fonction"].')';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$requete->closeCursor();
	}
	private function finAjoutPersonne(){
		$sql = 'INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd, per_admin)
		values ("'.$_SESSION["nom"].'", "'.$_SESSION["prenom"].'", "'.
		$_SESSION["telephone"].'", "'.$_SESSION["mail"].'", "'.$_SESSION["loginpers"].'", "'.
		toPassword($_SESSION["password"]).'", 0)';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$id = $this->db->lastInsertId();
		$requete->closeCursor();
		return $id;
	}
	public function modifEtudiant($data){
		$sql = 'UPDATE etudiant SET dep_num = "'
		.$data["departement"].'", div_num = "'
		.$data["annee"].'"'
		.' WHERE per_num = '.$_SESSION["id"];
		$requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();
		$this->finModifPersonne();
	}
	public function modifSalarie($data){
		$sql = 'UPDATE salarie SET sal_telprof = "'
		.$data["telpro"].'", fon_num = "'
		.$data["fonction"].'"'
		.' WHERE per_num = '.$_SESSION["id"];
		$requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();
		$this->finModifPersonne();
	}
	private function finModifPersonne(){
		$sql = 'UPDATE personne SET per_nom = "'
		.$_SESSION["nom"].'", per_prenom = "'
		.$_SESSION["prenom"].'", per_tel = "'
		.$_SESSION["telephone"].'", per_mail = "'
		.$_SESSION["mail"].'", per_login = "'
		.$_SESSION["loginpers"].'"';
		if (!empty($_SESSION["modifpwd"]) && $_SESSION["modifpwd"] == "modifpwd"){
			$sql=$sql.', per_pwd = "'.toPassword($_SESSION["password"]).'"';
		}
		$sql=$sql.' WHERE per_num = '.$_SESSION["id"];
		print_r($sql);
		$requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();
	}
	public function delPers($id){
		$citMan = new CitationManager($this->db);
		foreach ($citMan->getAllCitations() as $citation){
			if ($citation->getPerNum() == $id){
				$citMan->supprimerCitation($citation->getCitNum());
			}
		}
		if ($this->isEtu($id)){
			$sql = 'DELETE FROM etudiant WHERE per_num = '.$id;
		}
		else{
			$sql = 'DELETE FROM salarie WHERE per_num = '.$id;
		}
		$requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();

		$sql = 'DELETE FROM personne WHERE per_num = '.$id;
		$requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();


	}
}
?>
