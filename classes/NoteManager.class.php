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
    PRINT_R($citnum);
    $sql = 'SELECT AVG(vot_valeur) as moyenne FROM vote
            WHERE cit_num = '.$citnum;
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $moyNotes = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $moyNotes->moyenne;
  }
}
?>
