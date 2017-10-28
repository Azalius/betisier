<?php
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
 ?>

<?php if (empty($_POST['categorie']) && empty($_POST['annee']) && empty($_POST['fonction'])){ ?>
	<h1>Ajouter une personne</h1>
	<form action="index.php?page=1" id="insert" method="post">
		Nom : <input type="text" name="nom"  id="nom"><br>
		Prenom : <input type="text" name="prenom"  id="prenom"><br>
		Telephone: <input type="text" name="telephone"  id="telephone"><br>
		Mail: <input type="text" name="mail"  id="mail"><br>
		Login: <input type="text" name="login"  id="login"><br>
		Mote de passe: <input type="password" name="password"  id="password"><br>
		<input type="radio" name="categorie" value="etudiant" checked> Etudiant
	  <input type="radio" name="categorie" value="salarie"> Personnel<br>
		<input type="submit" value="Valider"/>
	</form>
<?php } else if (!empty($_POST['categorie']) && empty($_POST['annee']) && empty($_POST['fonction'])){ ?>
	<h1>Ajouter un <?php echo $_POST['categorie']; ?></h1>
	<?php if ($_POST['categorie'] == "etudiant"){ ?>
		<form action="index.php?page=1" id="etu" method="post">

		</form>
	<?php } else { ?>
		<form action="index.php?page=1" id="etu" method="post">
			Telephone professionnel : <input type="text" name="telpro"  id="telpro"><br>
			Fonction : <select name = "fonction"><?php foreach ($persMan->getAllFunction() as $num => $lib) {
				  echo '<option value ='.$num.'>'.$lib.'</option>';
			} ?> </select>
			<input type="submit" value="Valider"/>
		</form>
	<?php } ?>
<?php } else if (empty($_POST['categorie']) && empty($_POST['departement']) && !empty($_POST['fonction'])){ ?>
	<?php $persMan->finAjoutSalarie($_POST) ?>
	<h2>Le salarie à bien ete ajoute</h2>
<?php } else if (empty($_POST['categorie']) && !empty($_POST['departement']) && empty($_POST['fonction'])){ ?>
	<?php $persMan->finAjoutEtudiant($_POST) ?>
	<h2>L'etudiant à bien ete ajoute</h2>
<?php } ?>
