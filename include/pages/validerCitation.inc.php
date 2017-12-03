<h1> Vailder une citation </h1>

<?php
$pdo=new Mypdo();
$citManager = new CitationsManager ($pdo);
$perManager = new PersonneManager ($pdo);
$citations = $citManager -> getCitationsNonValides();

if (empty($_GET['citation'])){
 ?>
 <p>Actuellement
 <?php echo $citManager->nbCitationsNonValides() ?>
  citations sont en attente de validation.

  <table>
  	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Valider</th>
      <?php
  		foreach ($citations as $citation){?>
  			<?php $NumPersonne = $citation->getPerNum();
  						$NumCitation = $citation->getCitNum();
  						$nomPersonne = $perManager->getPers($NumPersonne)->getNom();
  						$prePersonne = $perManager->getPers($NumPersonne)->getPre();
  			 ?>
  	<tr><td><?php echo $prePersonne." ".$nomPersonne?>
  	</td><td><?php echo $citation -> getCitLib();?>
  	</td><td><?php echo getFrenchDate($citation -> getDate());?>
  	</td><td>
      <?php
  	 echo "<a href='index.php?page=9&citation=$NumCitation'><img src='image/valid.png' alt='Valider'/></a>"
    ?></td></tr>
  	<?php }?>
  	</table>
  <?php } else {
    $citManager->validerCitationFromNum($_GET['citation']);
    echo "La citation a bien été validée.";
  }
