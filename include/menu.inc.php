<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
		<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
		<ul>
			<li><a href="index.php?page=2">Lister</a></li>
			<?php if ($_SESSION['user']!=''){
				$pdo = new Mypdo();
				$persMan = new PersonneManager($pdo);
				?>
			<li><a href="index.php?page=1">Ajouter</a></li>
			<?php if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){ ?>
			<li><a href="index.php?page=4">Supprimer</a></li>
			<li><a href="index.php?page=3">Modifier</a></li>
		<?php }} ?>
		</ul>
		<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
		<ul>
			<li><a href="index.php?page=6">Lister</a></li>
			<?php if ($_SESSION['user']!=''){ ?>
			<li><a href="index.php?page=5">Ajouter</a></li>
			<li><a href="index.php?page=13">Rechercher</a></li>
			<?php if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){ ?>
			<li><a href="index.php?page=9">Valider</a></li>
			<li><a href="index.php?page=10">Supprimer</a></li>
		<?php }} ?>
		</ul>
		<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
		<ul>
			<li><a href="index.php?page=8">Lister</a></li>
			<?php if ($_SESSION['user']!=''){ ?>
			<li><a href="index.php?page=7">Ajouter</a></li>
			<li><a href="index.php?page=11">Modifier</a></li>
			<?php if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){ ?>
			<li><a href="index.php?page=12">Supprimer</a></li>
		<?php	}} ?>
		</ul>
	</div>
</div>
