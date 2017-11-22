<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">

		<div id="connect">
      <?php
      if ($_SESSION['user'] !=''){
        echo "Utilisateur : <a>".$_SESSION['user']."</a>";
        ?>
        <a href="index.php?page=15">Déconnexion</a>

    <?php } else { ?>
      <a href="index.php?page=14">Connexion</a>
    <?php } ?>
		</div>
		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
