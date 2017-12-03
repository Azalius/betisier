<?php
class CitationsManager{
	private $db;
		public function __construct($db){
			$this->db=$db;
		}

	public function getAllCitationsThatMatchFilter($filter){
		$listeCitations = array();
		foreach ($this->getAllCitations() as $citation){
			if ($filter->matchFilter($citation)){
				$listeCitations[] = $citation;
			}
		}
		return $listeCitations;
	}

	public function getAllCitations() {
		$listeCitations = array();
		$sql = 'SELECT per_num,cit_libelle,cit_date,cit_valide,cit_num FROM citation
            WHERE cit_valide=1 AND cit_date_valide IS NOT NULL
            ORDER BY cit_num';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($citation = $requete -> fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation ($citation);
		}
		$requete->closeCursor();
		return $listeCitations;
	}

		public function getCitationsNonValides(){
			$listeCitations = array();
			$sql = 'SELECT per_num,cit_libelle,cit_date,cit_valide,cit_num FROM citation
	            WHERE cit_valide=0
	            ORDER BY cit_num';

			$requete = $this->db->prepare($sql);
			$requete->execute();

			while($citation = $requete -> fetch(PDO::FETCH_OBJ)){
				$listeCitations[] = new Citation ($citation);
			}

		$requete->closeCursor();
		return $listeCitations;
	}

  public function nbCitations() {
		$sql = 'SELECT COUNT(cit_num) as total FROM citation
            WHERE cit_valide=1 AND cit_date_valide IS NOT NULL
            ORDER BY cit_num';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$nbcitation = $requete -> fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
		return $nbcitation->total;
	}
	public function insertCitation($idProf, $date, $citation){
		$pdo=new Mypdo();
		$persMan = new PersonneManager($pdo);
		$sql = 'INSERT INTO citation (per_num, cit_date, cit_libelle, per_num_etu)
						values ('.$idProf.', '."'".$date."'".', '."'".$citation."'".', '. $persMan->getPersFromLogin($_SESSION['user'])->getNum().')';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$requete->closeCursor();
	}
	public function getCitationFromNum($num){
		$sql = 'SELECT * FROM citation
						WHERE cit_num ='.$num;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$cit = $requete -> fetch(PDO::FETCH_OBJ);
		$citation = new Citation($cit);
		return $citation;
	}

	public function validerCitationFromNum($num){
		$sql = 'UPDATE citation SET cit_valide'
	}
}
?>
