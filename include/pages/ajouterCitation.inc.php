<?php
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
  $citMan = new CitationsManager($pdo);
?>
<?php if(!empty($_POST["ense"])){
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
  Date : <input type="date" name="date"  id="date"><br>
  Citation :
  <textarea rows="4" cols="50" name ="cit">
  </textarea>
  <input type="submit" value="Valider"/>
</form>
