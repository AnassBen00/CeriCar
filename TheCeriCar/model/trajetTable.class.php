<?php
// Inclusion de la classe utilisateur
include_once "trajet.class.php";

class trajetTable {

    
	/**
	* Recuperer le trajet par les villes de depart et villes
	*/
  
  public static function getTrajet($depart,$arrivee )
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;
    
		$trajetRepository = $em->getRepository('trajet');
		$trajet= $trajetRepository->findOneBy(array('depart'=>$depart,'arrivee'=>$arrivee ));

    return $trajet;
    
  }

  /**
	* Recuperer le trajet par son id
	*/
  public static function getTrajetById($id)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;
    
		$trajetRepository = $em->getRepository('trajet');
		$trajet= $trajetRepository->findOneBy(array('id'=>$id));

    return $trajet;
    
  }
  /**
	* Recupere les listes des villes
	*/
  public static function getVilles(){
	$em = dbconnection::getInstance()->getEntityManager() ;
	$qb = $em->createQueryBuilder();
	$query = $qb->select('t.depart ville')
			   ->from(trajet::class, 't')->distinct()->orderBy('t.depart')->getQuery();
	$villes = $query->execute();
	return $villes;
}



  
}


?>
