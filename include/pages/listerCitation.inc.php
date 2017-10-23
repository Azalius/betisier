<h1>Liste des citations déposées</h1>
<?php
	$pdo=new Mypdo();
	$citManager = new CitationsManager ($pdo);
	$perManager = new PersonneManager ($pdo);
	$noteManager = new NoteManager ($pdo);
	$citations = $citManager -> getAllCitations();
?>
<table>
	<p>
		Actuellement
		<?php echo $citManager->nbCitations() ?>
		citations sont enregistrées.
	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th></tr>
	<?php
		foreach ($citations as $citation){?>
			<?php $NumPersonne = $citation->getPerNum();
						$NumCitation = $citation->getCitNum();
						$nomPersonne = $perManager->getPers($NumPersonne)->getNom();
						$prePersonne = $perManager->getPers($NumPersonne)->getPre();
						$note = $noteManager->getMoyNotes($NumCitation);
			 ?>
	<tr><td><?php echo $prePersonne." ".$nomPersonne?>
	</td><td><?php echo $citation -> getCitLib();?>
	</td><td><?php echo getFrenchDate($citation -> getDate());?>
	</td><td><?php echo $note;?>
	</td></tr>
	<?php }?>
	</table>
	<br />
