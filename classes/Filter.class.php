<?php

interface Filter{
   public function matchFilter($citation);
}

class SimpleFilter implements Filter {
  private $vide;
	private $note;
	private $date;
	private $nom;

  private $noteMan;
  private $persMan;

    public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
				$this->affecte($valeurs);

      $db = new MyPdo();
      $this->noteMan= new NoteManager($db);
      $this->persMan = new PersonneManager($db);

      $vide = "";
    }

		public function affecte ($donnees){
				foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
						case 'note' : $this->setNote($valeur);break;
						case 'date' : $this->setDate($valeur);break;
						case 'nom' : $this->setNote($valeur);break;
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
    public function setDate($date){
      $this->date = $date;
    }
    public function setNom($nom){
      $this->nom = $nom;
    }
    public function setNote($note){
      $this->note = $note;
    }
    public function matchFilter($citation){
      $isOk = True;
      if ($this->note != $this->vide){
        if ($noteMan->getMoyNotes($citation.getId()) == $this->date){
          $isOk = False;
        }
      }
      if ($tgis->date != $this->vide){
        if ($citation.getDate() == $this->date){
          $isOk = False;
        }
      }
      if ($this->nom != $this->vide){
        if ($this->persMan->getPers($citation->getPerNum()) == $this->date){
          $isOk = False;
        }
      }
      return $isOk;
    }
}
?>
