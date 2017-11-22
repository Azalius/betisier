<?php
class MotManager{
  private $bd;
  private $allBadWord;
  public function __construct($bede){
    $this->db = $bede;
    $this->allBadWord = array();
		$sql = 'SELECT * from mot';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($citation = $requete -> fetch(PDO::FETCH_OBJ)){
      $this->allBadWord[] = $citation->mot_interdit;
		}
		$requete->closeCursor();
  }
  public function isPhraseOk($phrase){
    if (empty($phrase)){
      return False;
    }
    return count($this->getAllBadWordInPhrase($phrase)) == 0;
  }
  public function isMotOk($mot){
    foreach ($this->allBadWord as $badMot){
      if ($mot == $badMot){
        return False;
      }
    }
    return True;
  }
  public function getCorrectedPhrase($phrase){
    $mots = explode(" ", $phrase);
    $newPhrase = [];
    $i = 1;
    foreach ($mots as $mot) {
      $lowMot = strtolower($mot);
      if (!$this->isMotOk($lowMot)){
        $tiret = "";
        for ($i = 1 ; $i<= strlen($mot) ; $i=$i+1){
          $tiret = $tiret."-";
        }
        $newPhrase[] = $tiret;
      }
      else{
        $newPhrase[] = $mot;
      }
    }
  return implode(" ", $newPhrase);
  }
  public function getAllBadWordInPhrase($phrase){
    $allBadMot = [];
    $phrase = strtolower($phrase);
    $mots = explode(" ", $phrase);
    foreach ($mots as $mot) {
      if (!$this->isMotOk($mot)){
        $allBadMot[] = $mot;
      }
    }
  return $allBadMot;
  }
} ?>
