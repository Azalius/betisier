<?php
class CitationsManager{
	private $db;
		public function __construct($db){
			$this->db=$db;
		}

	public function getAllCitations() {
		$listeCitations = array();
		$sql = 'SELECT per_num,cit_libelle,cit_date,cit_valide FROM citation
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
}
?>
