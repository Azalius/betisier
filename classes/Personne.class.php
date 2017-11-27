<?php
class Personne{
  private $num;
  private $nom;
  private $pre;
  private $mail;
  private $tel;
  private $mdp;
  private $log;

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
          case 'per_login' : $this->setLog($valeur);break;
          case 'per_pwd' : $this->setMdp($valeur);break;
				}
			}
		}
    public function finAjoutPersonne($data){
  		$this->setNom($data['nom']);
  		$this->setPre($data['prenom']);
  		$this->setTel($data['telephone']);
  		$this->setMail($data['mail']);
  		$this->setLog($data['login']);
  		$this->setMdp($data['password']);
  		print_r($this->persAjout);
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
    public function setLog($num){
      $this->log = $num;
    }
    public function setMdp($num){
      $this->mdp = $num;
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
    public function getLog(){
      return $this->log;
    }
    public function getMdp(){
      return $this->mdp;
    }
}
class Etudiant extends Personne{
  private $dep;
  private $ville;
  public function __construct($d){
    parent::__construct($d);
  }
  public function add($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'dep_num' : $this->setDep($valeur);break;
        case 'div_num' : $this->setVille($valeur);break;
      }
    }
  }
  public function getDep(){
    return $this->dep;
  }
  public function getVille(){
    return $this->ville;
  }
  public function setDep($num){
    $this->dep = $num;
  }
  public function setVille($num){
    $this->ville = $num;
  }
}
class Salarie extends Personne{
  private $pro;
  private $fonc;
  public function __construct($d){
    parent::__construct($d);
  }
  public function add($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'sal_telprof' : $this->setPro($valeur);break;
        case 'fon_num' : $this->setFonc($valeur);break;
      }
    }
  }
  public function getPro(){
    return $this->pro;
  }
  public function getFonc(){
    return $this->fonc;
  }
  public function setPro($num){
    $this->pro = $num;
  }
  public function setFonc($num){
    $this->fonc = $num;
  }
}
?>
