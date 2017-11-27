<?php
$pdo=new Mypdo();
$perManager = new PersonneManager ($pdo);
$noteManager = new NoteManager ($pdo);
$NumCitation=$_GET['citation'];
if ($perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum()) && empty($noteManager->getNoteCitationPersonne($NumCitation,$perManager->getPersFromLogin($_SESSION['user'])->getNum()))){
  echo "pouet";
} else {
  echo "Erreur.";
}

?>
