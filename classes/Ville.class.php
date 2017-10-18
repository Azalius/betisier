<?php
class Ville{
  private $num;
  private $nom;
  public function __construct($valeurs = array()) {
    	if(!empty($valeurs)){
				$this->affecte($valeurs);
			}
    }
    public function affecte($donnees){
			foreach($donnees as $attribut => $valeur){
				switch($attribut){
					case 'vil_num' : $this->setNum($valeur);break;
					case 'vil_nom' : $this->setNom($valeur);break;
				}
			}
		}
    public function setNum($num){
      $this->num = $num;
    }
    public function setNom($num){
      $this->nom = $num;
    }
    public function getNom(){
      return $this->nom;
    }
    public function getNum(){
      return $this->num;
    }
}
?>
