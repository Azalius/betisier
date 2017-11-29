<?php

interface Filter{
  abstract public function matchFilter($citation);
}

class SimpleFilter implements Filter {
  const vide = "";
	private $note;
	private $date;
	private $nom;

  private $noteMan;

    public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
				$this->affecte($valeurs);
      $db = new Pdo();
      $noteMan= new NoteManager($db);
    }

		public function affecte ($donnees){
				foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
						case 'note' : $this->setPerNum($valeur);break;
						case 'date' : $this->setVotValeur($valeur);break;
						case 'nom' : $this->setCitNum($valeur);break;
					}
				}
		}
    public function getDate(){
      return $this->date;
    }
    public function getNom(){
      return $this->nom;
    }
    public function getNote(){
      return $this->note;
    }
    public function matchFilter($citation){
      $isOk = True;
      if ($note != vide){
        if $citation.get() == $this.date{
          $isOk = False;
        }
      }
      if ($date != vide){
        if $citation.getDate() == $this.date{
          $isOk = False;
        }
      }
      if ($nom != vide){
        if $citation.getDate() == $this.date{
          $isOk = False;
        }
      }
      return $isOk;
    }
}
?>
