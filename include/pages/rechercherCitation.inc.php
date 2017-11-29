<?php
$pdo = new Mypdo();
$citMan = new CitationsManager($pdo);
$perManager = new PersonneManager($pdo);
$noteManager = new NoteManager($pdo);
$isSearch = !empty($_POST["nom"]) ||!empty($_POST["note"]) || !empty($_POST["date"]);
if (!$isSearch){
 ?>

<h1>Rechercher une citation</h1>
<form action="index.php?page=13" id="ajout" method="post">
  Nom de l'Enseignant :  <input type="text" name="nom"  id="nom"><br>
  Date : <input type="date" name="date"  id="date"><br>
  Note obtenue <input type="text" name="note"  id="note"><br>
  <input type="submit" value="Rechercher"/>
</form>

<?php } else { ?>

  <h1>Nous avons trouvé XX citation qui correspondent à vos criteres : </h1>
  <table>
  	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th>
  	<?php
  		foreach ($citMan->getFilteredCitations(new Filter($_POST)) as $citation){
  			      $NumPersonne = $citation->getPerNum();
  						$NumCitation = $citation->getCitNum();
  						$nomPersonne = $perManager->getPers($NumPersonne)->getNom();
  						$prePersonne = $perManager->getPers($NumPersonne)->getPre();
  						$note = $noteManager->getMoyNotes($NumCitation);
  						$note=bcdiv($note, 1, 2);
  			      ?>
            	<tr><td><?php echo $prePersonne." ".$nomPersonne?>
            	</td><td><?php echo $citation -> getCitLib();?>
            	</td><td><?php echo getFrenchDate($citation -> getDate());?>
            	</td><td><?php echo $note;?></td></tr>
            <?php } ?>
    </table>

<?php } ?>
