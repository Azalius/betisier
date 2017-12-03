<h1> Supprimer une ville </h1>
<?php $pdo=new Mypdo();
  	$vilManager=new VilleManager($pdo);
  	$nbVilles=$vilManager->nbVille();
    if (empty($_GET['idVille'])){

  ?>
<p>Actuellement <?php echo $nbVilles ?> ville(s) sont enregistrée(s)</p>

  <table>
  	<tr>
  		<th>Numéro</th>
  		<th>Nom</th>
      <th>Supprimer</th>
  	</tr>

  	<?php
    $villes=$vilManager->getAllVille();
  		foreach ($villes as $ville){?>
  	<tr>
  		<td><?php echo $ville->getNum();?></td>
  		<td><?php echo $ville->getNom();?></td>
      <td><a href="index.php?page=14&idVille=<?php echo $numVille?>"><img class='icone' src='image/erreur.png' alt='Supprimer ville'></a></td>
  	</tr>
  	<?php }?>

  </table>
  <br />
<?php } else {
  $vilManager->supprimerVille($_GET["idVille"]);
  echo '<h2>La ville à bien été supprimée</h2>';
}
?>
