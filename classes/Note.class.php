<?php
class Note {
	private $per_num;
	private $vot_valeur;
	private $cit_num;

    public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
				$this->affecte($valeurs);
    }

		public function affecte ($donnees){
				foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
						case 'per_num' : $this->setPerNum($valeur);break;
						case 'vot_valeur' : $this->setVotValeur($valeur);break;
						case 'cit_num' : $this->setCitNum($valeur);break;
					}
				}
		}
    public function setPerNum($id){
      $this->per_num=$id;
    }
    public function setVotValeur($id){
      $this->vot_valeur=$id;
    }
    public function setCitNum($id){
      $this->cit_num=$id;
    }
    public function getPerNum(){
      return $this->per_num;
    }
    public function getVotValeur(){
      return $this->vot_valeur;
    }
    public function getCitNum(){
      return $this->cit_num;
    }
}
?>
