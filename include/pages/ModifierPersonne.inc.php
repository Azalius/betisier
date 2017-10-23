<?php

	$pdo = new Mypdo();
	$persMan = new VilleManager($pdo);
 ?>


	<h1>Liste des personnes</h1>
	<table>
		<p>
			Actuellement
			<?php echo $persMan->nbPers(); ?>
			 personnes sont enregistrées
		</p>
		<tr>
			<td>Numéro</td>
			<td>Nom</td>
		</tr>
			<?php
				$allVilles = $villeMan->getAllVille();
				foreach ($allVilles as $ville){
					echo '<tr><td>'.$ville->getNum().'</td><td>'.
					$ville->getNom().'</td></tr>'."\n";
				}
			 ?>
	</table>
