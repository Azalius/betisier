<?php
class Personne{
  private $num;
  private $nom;
  private $pre;
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
          case 'vil_prenom' : $this->setPre($valeur);break;
				}
			}
		}
    public function setNum($num){
      $this->num = $num;
    }
    public function setNom($num){
      $this->nom = $num;
    }
    public function setPre($num){
      $this->pre = $num;
    }
    public function getNom(){
      return $this->nom;
    }
    public function getNum(){
      return $this->num;
    }
    public function getPre(){
      return $this->pre;
    }
}
?>
