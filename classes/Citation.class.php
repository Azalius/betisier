<?php
class Citation {
	private $per_num;
	private $cit_libelle;
	private $cit_date;

    public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
				$this->affecte($valeurs);
    }

		public function affecte ($donnees){
				foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
						case 'per_num' : $this->setPerNum($valeur);break;
						case 'cit_libelle' : $this->setCitLib($valeur);break;
						case 'cit_date' : $this->setDate($valeur);break;
					}
				}
		}
    public function setPerNum($id){
      $this->per_num=$id;
    }
    public function setCitLib($id){
      $this->cit_libelle=$id;
    }
    public function setDate($id){
      $this->cit_date=$id;
    }
    public function getPerNum(){
      return $this->per_num;
    }
    public function getCitLib(){
      return $this->cit_libelle;
    }
    public function getDate(){
      return $this->cit_date;
    }
}
?>
