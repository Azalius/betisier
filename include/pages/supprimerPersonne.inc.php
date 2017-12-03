<?php
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);

	if(!empty($_GET["del"])){ // TODO check droit
		$persMan->delPers($_GET["del"]);
		echo '<h2>Personne supprimée<h2>';
	}
 ?>

	<h1>Supprimer des personnes : </h1>
	Attention : supprimer une personne suprimera toutes ces citations et ses votes
	<p>
		Actuellement
		<?php echo $persMan->nbPers(); ?>
		 personnes sont enregistrées
	</p>
	<table>
		<tr>
			<td>Nom</td>
			<td>Prenom</td>
			<td>Supprimer</td>
		</tr>
			<?php
				$allPers = $persMan->getAllPers();
				foreach ($allPers as $pers){
					echo '<tr><td>'.
					$pers->getNom().'</td><td>'.
					$pers->getPre().'</td>
					<td><a href="index.php?page=4&del='.$pers->getNum().'"><img src = "image/erreur.png" alt="supprimer"/></a>
					</td></tr>'."\n";
				}
			 ?>
	</table>
