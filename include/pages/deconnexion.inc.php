<img src="image/valid.png" alt="Valid" title="Vous vous êtes correctement déconnecté"/>
<?php

$_SESSION['user']='';
$timer=2;
$page='index.php?page=0';
header("Refresh: $timer;url=$page");
?>
Vous avez bien été déconnecté.<br>
Vous allez être redirigé dans <?php echo $timer; ?> secondes.
