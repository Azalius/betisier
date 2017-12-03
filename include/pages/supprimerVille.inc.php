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
      <td><a href="index.php?page=12&idVille=<?php echo $ville->getNum();?>"><img class='icone' src='image/erreur.png' alt='Supprimer ville'></a></td>
  	</tr>
  	<?php }?>

  </table>
  <br />
<?php } else {
  $vilManager->supprimerVilleFromNum($_GET['idVille']);
  $timer=2;
  $page='index.php?page=0';
  header("Refresh: $timer;url=$page");
  ?>
  La ville a bien été supprimée.<br>
  Vous allez être redirigé dans <?php echo $timer; ?> secondes. <?php
}
?>
