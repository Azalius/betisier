<?php
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
  $citMan = new CitationsManager($pdo);
	$motMan = new MotManager($pdo);
	if (empty($_POST["cit"])){
		$isACorrection = False;
	}
	else{
		$isACorrection = !$motMan->isPhraseOk($_POST["cit"]);
	}
	print_r($isACorrection);
?>
<?php if(!empty($_POST["cit"]) && !$isACorrection){
  $citMan->insertCitation($_POST["ense"], $_POST["date"], $_POST["cit"]);
  echo '<h4>Insertion effectuée</h4>';
} ?>

<h1>Ajouter une citation</h1>

<form action="index.php?page=5" id="ajout" method="post">
  Enseignant :
  <select name = "ense">
    <?php foreach ($persMan->getAllEnseignant() as $num =>$nom ) {
      echo '<option value ='.$num.'>'.$nom.'</option>';
    } ?>
  </select><br>
  Date : <input type="date" name="date" id="date" <?php
	if ($isACorrection){echo 'value='.'"'.$_POST['date'].'"';}
	?>><br>
  Citation :
  <textarea rows="4" cols="50" name ="cit">
<?php if ($isACorrection){echo ($motMan->getCorrectedPhrase($_POST['cit']));} ?>
	</textarea>
	<?php
	if ($isACorrection){
		foreach ($motMan->getAllBadWordInPhrase($_POST["cit"]) as $mot){
			echo '<p>Le mot <span class = "motInterdit">'.$mot.'</span> est interdit</p>';
		}
	}
	?>

  <input type="submit" value="Valider"/>
</form>
