<?php
class NoteManager{
	private $db;
		public function __construct($db){
			$this->db=$db;
		}

	public function getAllNotes() {
		$listeNotes = array();
		$sql = 'SELECT vot_valeur FROM vote';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($note = $requete -> fetch(PDO::FETCH_OBJ)){
			$listeNotes[] = new Note ($note);
		}

		$requete->closeCursor();
		return $listeNotes;
	}

  public function getMoyNotes($citnum){
    $sql = 'SELECT AVG(vot_valeur) as moyenne FROM vote
            WHERE cit_num = '.$citnum;
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $moyNotes = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $moyNotes->moyenne;
  }

	public function getNoteCitationPersonne($citnum, $per_num){
		$sql = 'SELECT cit_num as num FROM vote
            WHERE cit_num = '.$citnum.' AND per_num = '.$per_num;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$note = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();
    return !empty($note->num);
	}
	public function insertNote($numCit,$numPers,$note){
		$sql = 'INSERT into vote (cit_num, per_num, vot_valeur) values ('.$numCit.','.$numPers.','.$note.')';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$requete->closeCursor();
	}
	public function supprimerNote($numCit,$numPers){
		$sql = 'DELETE FROM vote WHERE cit_num='.$numCit.' AND per_num='.$numPers;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$requete->closeCursor();
	}
}
?>
