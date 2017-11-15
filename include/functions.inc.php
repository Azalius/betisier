<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}
	function getFrenchDate($date){
		$membres = explode ('-', $date);
		$date = $membres[2].'/'.$membres[1].'/'.$membres[0];
		return $date;
	}
	function captchaMath()
	{
		$n1 = mt_rand(1,9);
		$n2 = mt_rand(1,9);
		$resultat = $n1 + $n2;

		return array($resultat, $n1, $n2);
	}

	function captcha()
	{
		list($resultat, $n1, $n2) = captchaMath();
		$_SESSION['captcha'] = $resultat;

	  echo "<img src='image/nb/$n1.jpg' alt='Captcha1' title='Captcha1'/>";
	  echo "+ <img src='image/nb/$n2.jpg' alt='Captcha2' title='Captcha2'/> = ";
	  return $resultat;
	}
	//TODO : toPassword
?>
