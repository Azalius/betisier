<?php
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
	$resMan = new RessourceManager($pdo);
 ?>

<?php if (empty($_POST['categorie']) && empty($_POST['annee']) && empty($_POST['fonction'])){ ?>
	<h1>Ajouter une personne</h1>
	<form action="index.php?page=1" id="insert" method="post">
		Nom : <input type="text" name="nom"  id="nom"><br>
		Prenom : <input type="text" name="prenom"  id="prenom"><br>
		Telephone: <input type="text" name="telephone"  id="telephone"><br>
		Mail: <input type="text" name="mail"  id="mail"><br>
		Login: <input type="text" name="login"  id="login"><br>
		Mot de passe: <input type="password" name="password"  id="password"><br>
		<input type="radio" name="categorie" value="etudiant" checked> Etudiant
	  <input type="radio" name="categorie" value="salarie"> Personnel<br>
		<input type="submit" value="Valider"/>
	</form>
<?php } else if (!empty($_POST['categorie']) && empty($_POST['annee']) && empty($_POST['fonction'])){ ?>
	<h1>Ajouter un <?php echo $_POST['categorie']; ?></h1>
	<?php
	 foreach ($_POST as $num => $lib){
		 $_SESSION[$num] = $lib;
	 }
	 ?>
	<?php if ($_POST['categorie'] == "etudiant"){ ?>
		<form action="index.php?page=1" id="etu" method="post">
			Annee: <select name = "annee"><?php foreach ($resMan()->getAllAnnee() as $num => $lib) {
				  echo '<option value ='.$num.'>'.$lib.'</option>';
			} ?> </select> <br>
			Departement: <select name = "departement"><?php foreach ($persMan->getAllDepartement() as $num => $lib) {
				  echo '<option value ='.$num.'>'.$lib.'</option>';
			} ?> </select> <br>
			<input type="submit" value="Valider"/>
		</form>
	<?php } else { //TODO si login deja utilise ?>
		<form action="index.php?page=1" id="etu" method="post">
			Telephone professionnel : <input type="text" name="telpro"  id="telpro"><br>
			Fonction : <select name = "fonction"><?php foreach ($resMan()->getAllFunction() as $num => $lib) {
				  echo '<option value ='.$num.'>'.$lib.'</option>';
			} ?> </select>
			<input type="submit" value="Valider"/>
		</form>
	<?php } ?>
<?php } else if (empty($_POST['categorie']) && empty($_POST['departement']) && !empty($_POST['fonction'])){ ?>
	<?php $persMan->AjoutSalarie($_POST) ?>
	<h2>Le salarie à bien ete ajoute</h2>
<?php } else if (empty($_POST['categorie']) && !empty($_POST['departement']) && empty($_POST['fonction'])){ ?>
	<?php $persMan->AjoutEtudiant($_POST) ?>
	<h2>L'etudiant à bien ete ajoute</h2>
<?php } ?>
