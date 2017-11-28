<?php
class RessourceManager{
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
  }
}
 ?>
