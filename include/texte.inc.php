<div id="texte">
<?php
if (!empty($_GET["page"])){
	$pdo = new Mypdo();
	$persMan = new PersonneManager($pdo);
	$page=$_GET["page"];}
	else
	{$page=0;
	}
switch ($page) {
//
// Personnes
//

case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;
case 1:
	// inclure ici la page insertion nouvelle personne
	if ($_SESSION['user']!=''){
		include("pages/ajouterPersonne.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/listerPersonnes.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){
		include("pages/modifierPersonne.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
    break;
case 4:
	// inclure ici la page suppression personnes
	if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){
		include_once("pages/supprimerPersonne.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
  break;
//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
	if ($_SESSION['user']!=''){
		include("pages/ajouterCitation.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
    break;

case 6:
	// inclure ici la page liste des citations
	include("pages/listerCitation.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	if ($_SESSION['user']!=''){
		include("pages/ajouterVille.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
    break;

case 8:
// inclure ici la page lister  ville
	include("pages/listerVilles.inc.php");
    break;

//

//
case 9:
	if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){
		include("pages/validerCitation.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
		break;
case 10:
	// inclure ici la page....
	if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){
		include("pages/supprimerCitation.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
    break;

case 11:
	if ($_SESSION['user']!=''){
		 include("pages/modifierVille.inc.php");
		}else{
			include_once('pages/accueil.inc.php');
		}
    break;

case 12:
	// inclure ici la page...
	if ($persMan->getPersFromLogin($_SESSION['user'])->isAdmin()){
		include("pages/supprimerVille.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
    break;
case 13:
	if ($_SESSION['user']!=''){
		include("pages/rechercherCitation.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}
		break;
case 14:
		include("pages/connexion.inc.php");
		break;
case 15:
		include("pages/deconnexion.inc.php");
		break;
case 16:
		if ($_SESSION['user']!=''){
			include("pages/ajouterNote.inc.php");
		}else{
			include_once('pages/accueil.inc.php');
		}
		break;
case 17:
	if ($_SESSION['user']!=''){
		include("pages/supprimerNote.inc.php");
	}else{
		include_once('pages/accueil.inc.php');
	}

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
