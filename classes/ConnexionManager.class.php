<?php
class ConnexionManager{
	private $db;
		public function __construct($db){
			$this->db=$db;
		}

    public function CheckConnexion($login, $pass){
      $password = $pass;

      $sql = 'SELECT per_login, per_pwd FROM PERSONNE WHERE per_login = '.$login;
      $requete = $this->db->prepare($sql);
      $requete->execute();

      $user = $requete->fetch(PDO::FETCH_OBJ);

      if ($user == null){
        return false;
      }
      else{
        $salt = "48@!alsd";
        $passwordMD5 = md5(md5($password).$salt);
        if ($passwordMD5 == $user->per_pwd){
          return true;
        }
        return false;
      }

    }

?>
