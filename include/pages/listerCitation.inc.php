<h1>Liste des citations déposées</h1>
<?php
	$pdo=new Mypdo();
	$citManager = new CitationsManager ($pdo);
	//$perManager = new PersonneManager ($pdo);
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
			<?php $NumPersonne = $citation.getPerNum();
			//$perManager->getPers()->getNom($NumPersonne);
			 $note = $noteManager->getMoyNotes($NumPersonne);
			 ?>
	<tr><td><?php //echo $personne?>
	</td><td><?php echo $citation -> getCitLib();?>
	</td><td><?php echo $citation -> getDate();?>
	</td><td><?php echo $note?>
	</td></tr>
	<?php }?>
	</table>
	<br />
