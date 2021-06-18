<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

  /**
	* Recuperer l'utilisateur par son pseudo et le mot de passe 
	*/
  public static function getUserByLoginAndPass($login,$pass)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$userRepository = $em->getRepository('utilisateur');
	$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));	
	
	if ($user == false){
		echo 'Erreur sql';
			   }
	return $user; 
	}
/**
	* Recuperer l'utilisateur par son id
	*/
	public static function getUserById($id){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');	
		$user = $userRepository->findOneBy(array('id' => $id));	  

		return $user;


  }
  /**
	* Recuperer l'utilisateur par son pseudo
	*/

	public static function getUserByLogin($login)
    {
          $em = dbconnection::getInstance()->getEntityManager() ;

        $userRepository = $em->getRepository('utilisateur');
        $user = $userRepository->findOneBy(array('identifiant' => $login));

        return $user; 
    }

    /**
	* Ajout d'un utilisateur
	*/
    public static function addUtilisateur($nom, $prenom, $login, $password){
        $em = dbconnection::getInstance()->getEntityManager() ;
        $utilisateur = new utilisateur();
        $utilisateur->nom = $nom;
        $utilisateur->prenom = $prenom;
        $utilisateur->identifiant = $login;
        $utilisateur->pass = sha1($password);
        $user = $em->persist($utilisateur);
        $em->flush();
        return $user;
	}
	

	


  
}


?>
