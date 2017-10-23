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
    $MoyNotes = array();
    $sql = 'SELECT MOY(vot_valeur) FROM vote
            WHERE cit_num = '.$citnum;

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$requete -> fetch(PDO::FETCH_OBJ)

		$requete->closeCursor();
		return $MoyNotes;
  }
}
?>
