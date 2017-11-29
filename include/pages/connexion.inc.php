<?php
if(!empty($_POST['username'])){
   $pdo=new Mypdo();
   $coMan = new ConnexionManager($pdo);
   $persMan = new PersonneManager($pdo);
     if($coMan->CheckConnexion($_POST['username'], $_POST['password']) && $_POST['captcha'] == $_SESSION['captRes'] ){
      ?> <img src="image/valid.png" alt="Valid" title="Vous avez bien été connecté"/>
      <?php
      $personne=$persMan->getPersFromLogin($_POST['username']);
      $_SESSION['user']= $personne->getLog();
      $timer=2;
      $page='index.php?page=0';
      header("Refresh: $timer;url=$page");
      ?>
      Vous avez bien été connecté.<br>
      Vous allez être redirigé dans <?php echo $timer; ?> secondes. <?php
     }elseif($coMan->CheckConnexion($_POST['username'], $_POST['password'])){
       echo "Captcha invalide.";
   }else{
       echo "<div class='Erreur'><p>Nom d'utilisateur ou mot de passe invalide</p></div>";
     }
   }else{
?>
  <h1>Pour vous connecter</h1>
  <form action="index.php?page=14" id="connexion" method="post">

  <label for="username">Nom d'utilisateur : </label>
    <input type="text" name="username" id="username" required/>
  <br>
  <label for="password">Mot de passe : </label>
    <input type="password" name="password" id="password" required/>
  <br>
  <label for="captcha"> <?php $res=captcha(); $_SESSION['captRes']=$res; ?></label>
      <input type="text" name="captcha" id="captcha" required/>
  <br>
  <input type="submit" value="Valider" class="valider">
</form>

<?php
}
 ?>
