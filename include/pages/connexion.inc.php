<?php
if(!empty($_POST['nomUser'])){ //Cas idSAISIE
   $pdo=new Mypdo();
   $coMan = new ConnexionManager($pdo);
     if($coMan->CheckConnexion($_POST['username'], $_POST['password'])){
       
     }else{
       echo "<div class='Erreur'><p>Nom d'utilisateur ou mot de passe invalide</p></div>";
     }
   }
?>
  <h1>Pour vous connecter</h1>
  <form action="index.php?page=14" id="connexion" method="post">

  <label for="username">Nom d'utilisateur : </label>
    <input type="text" name="username" id="username" required/>
  </br>
  <label for="password">Mot de passe : </label>
    <input type="password" name="password" id="password" required/>
  </br>
  <!-- <label for="captcha"><img src="image/nb/<?php // echo $_SESSION['nbAlea1']?>.jpg"> + <img src="image/nb/<?php echo $_SESSION['nbAlea2']?>.jpg"> = </label>
    <input type="text" name="captcha" id="captcha" required/>
  </br> -->
  <input type="submit" value="Valider" class="valider">
</form>

<?php

 ?>
