<?php

	$pdo = new Mypdo();
	$villeMan = new VilleManager($pdo);
 ?>


	<h1>Liste des villes</h1>
	<table>
		<p>
			Actuellement
			<?php echo $villeMan->nbVille(); ?>
			 villes sont enregistrées
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
