<?php

	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
 ?>


	<h1>Liste des personnes : </h1>
	<table>
		<p>
			Actuellement
			<?php echo $persMan->nbPers(); ?>
			 personnes sont enregistrées
		</p>
		<tr>
			<td>Numéro</td>
			<td>Nom</td>
			<td>Prenom</td>
		</tr>
			<?php
				$allPers = $persMan->getAllPers();
				foreach ($allPers as $pers){
					echo '<tr><td>'.
					$pers->getNum().'</td><td>'.
					$pers->getNom().'</td><td>'.
					$pers->getPre().'</td></tr>'."\n";
				}
			 ?>
	</table>
