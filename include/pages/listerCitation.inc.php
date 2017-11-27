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
	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th><?php if ($perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum())){
		echo "<th>Noter</th>";
	}?></tr>
	<?php
		foreach ($citations as $citation){?>
			<?php $NumPersonne = $citation->getPerNum();
						$NumCitation = $citation->getCitNum();
						$nomPersonne = $perManager->getPers($NumPersonne)->getNom();
						$prePersonne = $perManager->getPers($NumPersonne)->getPre();
						$note = $noteManager->getMoyNotes($NumCitation);
						$note=bcdiv($note, 1, 2);
			 ?>
	<tr><td><?php echo $prePersonne." ".$nomPersonne?>
	</td><td><?php echo $citation -> getCitLib();?>
	</td><td><?php echo getFrenchDate($citation -> getDate());?>
	</td><td><?php echo $note;?>
	</td><?php if ($perManager->isEtu($perManager->getPersFromLogin($_SESSION['user'])->getNum()) && $noteManager->getNoteCitationPersonne($NumCitation,$perManager->getPersFromLogin($_SESSION['user'])->getNum())){
		echo "<td>
		 <img src='image/erreur.png' alt='Déja noté'/>
		 </td>";} else {
			 echo "<td>
			 <a href='index.php?page=16&citation=$NumCitation'><img src='image/modifier.png' alt='Déja noté'/></a>
			 </td>";}
		  ?>
	 </tr>
	<?php }?>
	</table>
	<br />
