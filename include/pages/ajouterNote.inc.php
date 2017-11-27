<?php
$pdo=new Mypdo();
$perManager = new PersonneManager ($pdo);
$noteManager = new NoteManager ($pdo);

if ($perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum()) && $noteManager->getNoteCitationPersonne($NumCitation,$perManager->getPersFromLogin($_SESSION['user'])->getNum())){
  
}
?>
