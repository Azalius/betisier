<?php

	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
 ?>

	<?php
		if (!empty($_GET["id"])){
			echo("<h2>Detail</h2>");
		}
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
					"<a href=".'"'."index.php?page=2&id=".$pers->getNum().'">'.$pers->getNum().'</a></td><td>'.
					$pers->getNom().'</td><td>'.
					$pers->getPre().'</td></tr>'."\n";
				}
			 ?>
			 <p>Cliquez sur le numero de la personne pour plus d'information</p>
	</table>
