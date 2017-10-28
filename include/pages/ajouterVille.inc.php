<h1>Ajouter une ville</h1>

<?php if (empty($_POST['nom'])) { ?>
<form action="index.php?page=7" id="insert" method="post">
	Nom ville : <input type="text" name="nom"  id="nom" size="10">
	<input type="submit" value="Ajouter"/>
</form>
<?php } else {
  $pdo = new Mypdo();
	$villeMan = new VilleManager($pdo);
  $villeMan->ajouterVille($_POST['nom'])
  ?>
<p>La ville <b>" <?php echo $_POST['nom'] ?> "</b> a été ajoutée</p>
<?php } ?>
