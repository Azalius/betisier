<?php
$pdo=new Mypdo();
$citManager = new CitationsManager($pdo);
$perManager = new PersonneManager ($pdo);
$noteManager = new NoteManager ($pdo);

if (!empty($_GET['citation']) && $perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum()) && !empty($noteManager->getNoteCitationPersonne($_GET['citation'],$perManager->getPersFromLogin($_SESSION['user'])->getNum()))){
    $NumCitation=$_GET['citation'];
  ?> <h1> Supprimer une citation </h1><?php
  $noteManager->supprimerNote($_GET['citation'],$perManager->getPersFromLogin($_SESSION['user'])->getNum());
  ?>

  <p> Votre note pour la citation "<?php echo $citManager->getCitationFromNum($NumCitation)->getCitLib(); ?>" a bien été supprimée</p>
<?php
  $timer=5;
  $page='index.php?page=6';
  header("Refresh: $timer;url=$page");
  ?>
  Vous allez être redirigé dans <?php echo $timer; ?> secondes.<?php
} else {
    header("Refresh: 0;url='index.php?page=0'");
}
?>
