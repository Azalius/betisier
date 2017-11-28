<?php
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
	$resMan = new RessourceManager($pdo);
 ?>
	<h1>Modifier une personne</h1>
	<?php if(empty($_GET["pers"])){
		foreach ($_POST as $num => $lib){
 		 $_SESSION[$num] = $lib;
 	 	}
		if (!empty($_POST["annee"])){
			echo '<h2>Etudiant ajoute</h2>';
		}
		if (!empty($_POST["fonction"])){
			echo 'Salarie ajoute';
		}
	?>
	<table>
		<p>
			Actuellement
			<?php echo $persMan->nbPers(); ?>
			 personnes sont enregistrées
		</p>
		<tr>
			<td>Nom</td>
			<td>Prenom</td>
			<td>Modifier</td>
		</tr>
			<?php foreach ($persMan->getAllPers() as $pers){
				echo "<tr>";
				echo "<td>".$pers->getNom()."</td>";
				echo "<td>".$pers->getPre()."</td>";
				echo '<td><a href="http://localhost/bet/index.php?page=3&pers='.$pers->getNum().'"><img src = "image/modifier.png" alt = "modifier"/></a></td>';
				echo "</tr>";
			}
			?></table>
		<?php
	}else{
				if(empty($_POST["nom"])){
					$pers = $persMan->getPers($_GET["pers"]);
					if($persMan->isEtu($_GET["pers"])){
						$pers = $persMan->toEtu($_GET["pers"]);
					}
					else{
						$pers = $persMan->toProf($_GET["pers"]);
					}
					echo '<form action="index.php?page=3&pers='.$_GET["pers"].'" id="insert" method="post">';
						echo 'Nom : <input type="text" name="nom"  id="nom" value = "'.$pers->getNom().' "><br>';
						echo 'Prenom : <input type="text" name="prenom"  id="prenom" value = "'.$pers->getPre().'"><br>';
						echo 'Telephone: <input type="text" name="telephone"  id="telephone" value = "'.$pers->getTel().' "><br>';
						echo 'Mail: <input type="text" name="mail"  id="mail" value = "'.$pers->getMail().' "><br>';
						echo 'Login: <input type="text" name="login"  id="login" value = " '.$pers->getLog().'"><br>';
						echo 'Mot de passe: <input type="password" name="password"  id="password"><br>';
						echo '<input type="submit" value="Valider"/>';
					echo '</form>';
				}
				else{
					if ($persMan->isEtu($_GET["pers"])){ ?>
						<form action="index.php?page=1" id="etu" method="post">
							Annee: <select name = "annee"><?php foreach ($resMan()->getAllAnnee() as $num => $lib) {
								  echo '<option value ='.$num;
									if ($num == $persMan->toEtu($_GET["pers"])->getVille()) {echo ' selected = "selected" ';}
									echo '>'.$lib.'</option>';
							} ?> </select> <br>
							Departement: <select name = "departement">
								<?php foreach ($persMan->getAllDepartement() as $num => $lib) {
								  echo '<option value ='.$num;
									if ($num == $persMan->toEtu($_GET["pers"])->getDep()) {echo ' selected = "selected" ';}
									echo '>'.$lib.'</option>';
							} ?> </select> <br>
							<input type="submit" value="Valider"/>
						</form>
					<?php } else { //TODO si login deja utilise ?>
						<form action="index.php?page=1" id="etu" method="post">
							Telephone professionnel : <input type="text" name="telpro" id="telpro" value = "<?php echo($persMan->toProf($_GET["pers"])->getPro()) ?>"><br>
							Fonction : <select name = "fonction"><?php foreach ($resMan()->getAllFunction() as $num => $lib) {
								  echo '<option value ='.$num;
									if ($lib == $persMan->toProf($_GET["pers"])->getFonc()) {echo ' selected = "selected" ';}
									echo '>'.$lib.'</option>';
							} ?> </select></br>
							<input type="submit" value="Valider"/>
						</form>
			<?php	}
		}
	}
		?>
