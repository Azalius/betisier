<?php
require_once("Ville.class.php");
class VilleManager{
	private $db;
		public function __construct($bede){
			$this->db = $bede;
		}

	public function modifierVille($id, $nom){
		$sql = 'UPDATE ville SET vil_nom = "'.$nom.'" WHERE vil_num = '.$id;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$requete->closeCursor();
	}

	public function getVille($id){
		$sql = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num = '.$id;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$ville = $requete->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($ville);
		$requete->closeCursor();
		return $ville;
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
	public function ajouterVille($ville){
		$sql = 'INSERT INTO ville(vil_nom) VALUES ('.'"'.$ville.'"'.")";
		print_r($sql);
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();
	}
<<<<<<< HEAD
	public function supprimerVille($id){
		$sql = 'DELETE FROM ville WHERE id_ville ='.$id;
		print_r($sql);
    $requete = $this->db->prepare($sql);
    $requete->execute();
    $requete->closeCursor();
=======
	public function supprimerVilleFromNum($num){
		$sql = "DELETE FROM ville WHERE vil_num=".$num;
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$requete->closeCursor();
>>>>>>> 0e4e90263103a1423eacaaf9fc717454b87ed630
	}
}
?>
