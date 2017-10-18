<?php
require_once("Ville.class.php");
class VilleManager{
	private $db;
		public function __construct($bede){
			$this->db = $bede;
		}

	public function getAllVille() {
		$listeVille = array();
		$sql = 'SELECT vil_num, vil_nom FROM ville';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($villes = $requete->fetch(PDO::FETCH_OBJ)){
			$listeVille[] = new Ville($villes);
		}
		$requete->closeCursor();
		return $listeVille;
	}
  public function nbVille(){
    $sql = 'SELECT COUNT(vil_num) as total FROM ville';
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $nbvilles = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
    return $nbvilles->total;
  }
}
?>
