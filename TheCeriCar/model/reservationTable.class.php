<?php
// Inclusion de la classe reservation
require_once "reservation.class.php";

class reservationTable {

    
  /**
	* Recuperer les reservations d'un voyage
	*/
  public static function getReservationByVoyage($voyage)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;
	
	  $reservationRepository = $em->getRepository('reservation');
	  $reservation = $reservationRepository->findBy(array('voyage' => $voyage));	
  
    return $reservation;

  }
  
  /**
	* Ajout d'une reservation
	*/

	public static function addReservation($voyage, $voyageur){
        $em = dbconnection::getInstance()->getEntityManager() ;
        $reservation = new reservation();
        $reservation->voyage = $voyage;
        $reservation->voyageur = $voyageur;
        $reservationInstance = $em->persist($reservation);
        $em->flush();
        echo $reservationInstance;
        return $reservationInstance;
  }
  
  /**
	* Recuperer les reservations d'un voyageur
	*/
  public static function getReservationsByVoyageur($voyageur)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;
	
	  $reservationRepository = $em->getRepository('reservation');
	  $reservation = $reservationRepository->findBy(array('voyageur' => $voyageur));	
  
    return $reservation;

	}

  
}


?>
