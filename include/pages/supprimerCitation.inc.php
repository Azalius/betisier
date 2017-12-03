<h1>Liste des citations déposées</h1>
<?php
	$pdo=new Mypdo();
	$citManager = new CitationsManager ($pdo);
	$perManager = new PersonneManager ($pdo);
	$noteManager = new NoteManager ($pdo);
	$citations = $citManager -> getAllCitations();

if (!empty($_GET['del'])){
  $citManager->supprimerCitationSeul($_GET['del']);
  echo '<h2>La citation à bien été supprimée</h2>';
}


?>
<p>Actuellement
<?php echo $citManager->nbCitations() ?>
 citations sont enregistrées.
</p>
<table>
	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th><th>Supprimer</th></tr>
	<?php
		foreach ($citations as $citation){?>
			<?php 		$NumPersonne = $citation->getPerNum();
						$NumCitation = $citation->getCitNum();
						if ($NumPersonne != ''){
						$nomPersonne = $perManager->getPers($NumPersonne)->getNom();
						$prePersonne = $perManager->getPers($NumPersonne)->getPre();
						}
						$note = $noteManager->getMoyNotes($NumCitation);
			 ?>
	<tr><td><?php if ($NumPersonne != ''){ echo $prePersonne." ".$nomPersonne; }?>
	</td><td><?php echo $citation -> getCitLib();?>
	</td><td><?php echo getFrenchDate($citation -> getDate());?>
	</td><td><?php echo $note;?>
  </td><td><a href = " <?php echo "index.php?page=10&del=".$NumCitation; ?> "><img src="image/erreur.png" alt="supprimer"/></a>
	</td></tr>
	<?php }?>
	</table>
	<br>
