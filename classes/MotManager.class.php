<?php public class MotManager{
  private $bd;
  private $allBadWord
  public function __construct($bede){
    $this->db = $bede;
    $this->allBadWord = array();
		$sql = 'SELECT * from mot';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($citation = $requete -> fetch(PDO::FETCH_OBJ)){
			$allBadWord[] = ;
		}
		$requete->closeCursor();
  }
  public function isPhraseOk($phrase){

  }
  public function isMotOk($mot){

  }
  public function getCorrectedPhrase($phrase){

  }
  public function getAllBadWordInPhrase($phrase){

  }
} ?>
