<?php

	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
 ?>

	<?php
		if (!empty($_GET["id"])){
			echo("<h2>Detail ");
			if($persMan.isEtu($_GET["id"])){
				echo ("sur l'etudiant ");
				$pers = $persMan.toEtu($_GET["id"]);
				echo $pers->getNom();
				?>
				<table>
					<tr>
						<td>Prenom</td>
						<td>Mail</td>
						<td>Tel</td>
						<td>Departement</td>
						<td>ville</td>
					</tr>
					<tr>
						<?php
							echo "<td>$pers.getPre()</td>"."\n".
							"<td>$pers.getMail()</td>"."\n".
							"<td>$pers.getTel()</td>"."\n".
							"<td>$pers.getDep()</td>"."\n".
							"<td>$pers.getVille()</td>"."\n"
						 ?>
					</tr>
				</table>
			<?php }
			else{
				echo("sur le salarie ") ;
				$pers = $persMan.toEtu($_GET["id"]);
				echo $pers->getNom();
			}
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
