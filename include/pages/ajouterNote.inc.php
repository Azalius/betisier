<?php
$pdo=new Mypdo();
$citManager = new CitationsManager($pdo);
$perManager = new PersonneManager ($pdo);
$noteManager = new NoteManager ($pdo);

if (empty($_POST['note']) && !empty($_GET['citation']) && $perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum()) && empty($noteManager->getNoteCitationPersonne($_GET['citation'],$perManager->getPersFromLogin($_SESSION['user'])->getNum()))){
    $NumCitation=$_GET['citation'];
  ?> <h1> Noter une citation </h1>
  <p> Quelle note voulez-vous donner à la citation "<?php echo $citManager->getCitationFromNum($NumCitation)->getCitLib(); ?>" ?</p>

  <form action="index.php?page=16&citation=<?php echo $NumCitation?>" id="connexion" method="post">

  <label for="note">Note : </label>
    <input type="number" name="note" id="note" step="1" value="0" min="0" max="20" required/>
    <br>
    <input type="submit" value="Valider" class="valider">
  </form>

<?php } elseif (!empty($_POST['note']) && $perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum())) {

  $noteManager->insertNote($_GET['citation'],$perManager->getPersFromLogin($_SESSION['user'])->getNum(),$_POST['note']);

  $timer=2;
  $page='index.php?page=6';
  header("Refresh: $timer;url=$page");
  ?>
  Votre note a bien été enregistrée.<br>
  Vous allez être redirigé dans <?php echo $timer; ?> secondes.<?php
} else {
    header("Refresh: 0;url='index.php?page=0'");
}

?>
