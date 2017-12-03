<h1>Selectionnez la ville à modifier</h1>

<?php
	$pdo = new Mypdo();
	$villeMan = new VilleManager($pdo);
	if (empty($_GET["ville"])){
?>
<table>
  <tr>
    <td>Numéro</td>
    <td>Nom</td>
    <td>Modifier</td>
  </tr>
    <?php
      $allVilles = $villeMan->getAllVille();
      foreach ($allVilles as $ville){
        echo '<tr><td>'.$ville->getNum().'</td><td>'.
        $ville->getNom().'</td>
        <td>
        <a href = "index.php?page=11&ville='.$ville->getNum().'">
        <img src ="image/modifier.png" alt = "modifier"/>
        </a></td>
        </tr>'."\n";
      }
		?>
</table>

<?php
} else {
	if (empty($_POST["nom"])){
?>
<form action="index.php?page=11&ville=<?php echo($_GET["ville"]); ?>" id="insert" method="post">
	Nom ville : <input type="text" name="nom"  id="nom" size="10"
	value =" <?php echo($villeMan->getVille($_GET["ville"])->getNom()); ?>">
	<input type="submit" value="Modifier"/>
</form>
<?php } else { ?>
	<?php $villeMan->modifierVille($_GET["ville"], $_POST["nom"]) ?>
	<h2> La ville à bien été modifiée <h2>
<?php
}
}
?>
