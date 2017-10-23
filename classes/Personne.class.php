<?php
class Personne{
  private $num;
  private $nom;
  private $pre;
  private $mail;
  private $tel;

  public function __construct($valeurs = array()) {
    	if(!empty($valeurs)){
				$this->affecte($valeurs);
			}
    }
    public function affecte($donnees){
			foreach($donnees as $attribut => $valeur){
				switch($attribut){
					case 'per_num' : $this->setNum($valeur);break;
					case 'per_nom' : $this->setNom($valeur);break;
          case 'per_prenom' : $this->setPre($valeur);break;
          case 'per_mail' : $this->setMail($valeur);break;
          case 'per_tel' : $this->setTel($valeur);break;
				}
			}
		}
    public function setMail($num){
      $this->mail = $num;
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
    public function setTel($num){
      $this->tel = $num;
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
    public function getMail(){
      return $this->mail;
    }
    public function getTel(){
      return $this->tel;
    }
}
class Etudiant extends Personne{
  private $dep;
  private $ville;
  public function getDep(){
    return $this->dep;
  }
  public function getVille(){
    return $this->ville;
  }
}
class Salarie extends Personne{
  private $pro;
  private $fonc;
}
?>
