<?php
// Inclusion de la classe voyage
require_once "voyage.class.php";

class voyageTable {

    /**
	* Recuperer un voyage par son id
	*/
	public static function getVoyageById($id){
		
		$em = dbconnection::getInstance()->getEntityManager() ;
	  $voyageRepository = $em->getRepository('voyage');
	  $voyages = $voyageRepository->findOneBy(array('id' => $id));	
	  
	  
	  return $voyages;
  }
  	/**
	* Recuperer les voyages d'un trajet
	*/
  	public static function getVoyagesByTrajet($trajet){
		
  		$em = dbconnection::getInstance()->getEntityManager() ;
		$voyageRepository = $em->getRepository('voyage');
		$voyages = $voyageRepository->findBy(array('trajet' => $trajet));	
		
		
		return $voyages;
	}

	/**
	* Recuperer les voyages direct et par correspendance par la ville de depart la ville d'arrivee et le nbr de voyageurs
	*/

	public static function getCorrespondance($depart,$arrivee,$nbrvoyageurs){
		$em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
		
	   $query = $em->prepare(" select * from VoyageCorrespendance2('{$depart}','{$arrivee}',{$nbrvoyageurs});");
	   
	   $bool = $query->execute();
	   if ($bool == false){
		   return NULL;
	   }
	   $voyages = $query->fetchAll();
	   return $voyages; 
   }
   /**
	* Recuperer les voyages d'un utilisateurs
	*/
	public static function getVoyagesByUser($id) {
		$em = dbconnection::getInstance()->getEntityManager();
		$voyageRepository = $em->getRepository('voyage');
		$voyages = $voyageRepository->findBy(array('conducteur' => $id));
		return $voyages;
	}
	/**
	* Recuperer les places disponibles d'un voyage
	*/
	public static function getPlaceDisponible($voyageid){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$voyageRepository = $em->getRepository('voyage');
		$connexion = $em->getConnection() ;
		$query = "SELECT * FROM NbPlacesRestantes($voyageid);";
		$nbPlace = $connexion->fetchColumn($query);
		return $nbPlace;
	}
	/**
	* Ajout d'un nouveau voyage
	*/
	public static function nouveauVoyage($depart, $arrivee, $heuredepart, $nbplace, $tarifparkm, $contraintes, $user){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$voyageRepository = $em->getRepository('voyage');
		$trajet = trajetTable::getTrajet($depart,$arrivee);
		$tarif = $tarifparkm * $trajet->distance;
		if($trajet && $user && $tarif>0){
			$voyage = new voyage();
			$voyage->trajet = $trajet;
			$voyage->conducteur = $user;
			$voyage->nbplace = $nbplace;
			$voyage->heuredepart = $heuredepart;
			$voyage->tarif = $tarif;
			$voyage->contraintes = trim($contraintes);
			$em->persist($voyage);
			$em->flush();
			return $voyage;
		}
		return null;
	}



  
}


?>
