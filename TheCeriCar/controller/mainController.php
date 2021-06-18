<?php

class mainController
{
	/**
	* Tester une requete sans parametres
	*/
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}
	/** 
	*  Tester une requete avec parametres
	*/
	public static function superTest($request,$context)
	{
		if(!array_key_exists("param1",$request) OR !array_key_exists("param2",$request)){
			return context::ERROR;
		}else{
			$context->param1=$_GET["param1"];
			$context->param2=$_GET["param2"];
			
			
			return context::SUCCESS;
		}
		
	}
	/**
	* Retourner un trajet par les villes de depart et arrivée
	*/
	public static function getTrajet($request,$context)
	{
		
		$context->trajet= trajetTable::getTrajet($_GET["depart"],$_GET["arrivee"]);
		$context->id=$context->trajet->id;
		if($context->trajet){
			return context::SUCCESS;
		}
	    return context::ERROR;
	}

	/**
	* Retourner les voyages d'un trajet
	*/

	public static function getVoyages($request,$context)
	{
		
		$context->voyages= voyageTable::getVoyagesByTrajet($_GET["param1"]);
		if($context->voyages){
			return context::SUCCESS;
		}
	    return context::ERROR;
	}

	/**
	* Retourner les reservations d'un voyage
	*/

	public static function getReservation($request,$context)
	{
		
		$context->reservation= reservationTable::getReservationByVoyage($_GET["param1"]);
		if($context->reservation){
			return context::SUCCESS;
		}
	    return context::ERROR;
	}

	/**
	* Retourner un utilisateur par son id
	*/
	public static function getUser($request,$context)
	{
		
		$context->user= utilisateurTable::getUserById($_GET["param1"]);
		
		if($context->user){
			return context::SUCCESS;
		}
	    return context::ERROR;
		
		
	
	}
	/**
	* Retourner les voyages d'un trajet 
	*/

	public static function getVoyages2($request,$context)
	{
		$context->trajet= trajetTable::getTrajet($_GET["depart"],$_GET["arrivee"]);
		
		$context->voyages= voyageTable::getVoyagesByTrajet($context->trajet->id);
		
		if($context->voyages){
			return context::SUCCESS;
		}
	    return context::ERROR;
	
	}

	/**
	* Retourner les voyages à partir d'un formulaire
	*/
	
	public static function rechercheVoyage($request,$context)
	{
		
		if(key_exists("depart",$request) && key_exists("arrivee",$request)){
			$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			$context->voyages = voyageTable::getVoyagesByTrajet($trajet->id);
			if($context->voyages ) return context::SUCCESS;
			return context::ERROR;
		}
		
		return context::SUCCESS;
	}

	/**
	* Retourner les voyages à partir d'un formulaire utilisant ajax
	*/
	public static function ajaxRechercheVoyage($request,$context){
		if($request['depart'] != null && $request['arrivee'] != null){
			$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			if($trajet){
					
					//Recuperer les voyages direct et par correspendance
					$Correspendances = voyageTable::getCorrespondance($request['depart'], $request['arrivee'],$request['nbrvoyageurs']);

					//Tableau des voyages par correspendance
					$context->voyagesCorrespendance =  new ArrayObject();

					//Tableau des conducteurs
					$context->conducteurs = new ArrayObject();

					//Tableau de voyages
					$context->listvoyages = new ArrayObject();

					//Tableau des heure d'arrivée
					$context->heurearrivee = new ArrayObject();

					for($i=0;$i<count($Correspendances);$i++){

						if($Correspendances[$i]['correspendance']){
							
							$voyage1 = voyageTable::getVoyageById($Correspendances[$i]['id']);
							$voyage2 = voyageTable::getVoyageById($Correspendances[$i]['correspendancevoyage']);
							
							
							$voyage1->trajet->arrivee = $voyage2->trajet->arrivee;
							$voyage1->trajet->distance= $voyage1->trajet->distance +$voyage2->trajet->distance;

							$voyage1->tarif= $voyage1->tarif + $voyage2->tarif;
							$context->voyagesCorrespendance->append($voyage1);
							
							$context->conducteurs[$voyage1->id]= array(utilisateurTable::getUserById($voyage1->conducteur->id),utilisateurTable::getUserById($voyage2->conducteur->id));
							$context->listvoyages[$voyage1->id] = array($voyage1,$voyage2);
						
							$heure=explode('.',$voyage2->trajet->distance/100);
							
							$context->heurearrivee[$voyage1->id] = $voyage2->heuredepart+$heure[0];
							
							$i++; 


						}else{
							$voyage =voyageTable::getVoyageById($Correspendances[$i]['id']);
							$context->voyagesCorrespendance->append($voyage);
							$context->conducteurs[$voyage->id] = array(utilisateurTable::getUserById($voyage->conducteur->id)); 
							$context->listvoyages[$voyage->id] = array($voyage);
							
							$heure=explode('.',$voyage->trajet->distance/100);
						
							$context->heurearrivee[$voyage->id] = $voyage->heuredepart+$heure[0];
						}
					}
					
					
					if($context->voyagesCorrespendance ){
						return context::SUCCESS;
					}
					else{
						$context->ERROR = "Aucun voyage trouvé";
						return context::ERROR;
					}
					
				
				
			}
			else{
			$context->ERROR = "Aucun trajet trouvé";
			return context::ERROR;
			}
		}
		$context->ERROR = "Départ et arrivée non saisis";
		return context::ERROR;
	}

	/**
	* Retourner les voyages d'un utilisateur
	*/
	public static function mesVoyages($request,$context)
	{
		if($context->getSessionAttribute("user_id")!=NULL) $context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		else return context::ERROR;
		$voyagesData = array();
		$voyages = voyageTable::getVoyagesByUser($context->user->id);
		foreach($voyages as $voyage){
			array_push($voyagesData, new voyageData($voyage));
		}
		$context->voyagesData = $voyagesData;
		return context::SUCCESS;
	}

	/**
	* Afficher la vue d'ajout d'un nouveau voyage
	*/

	public static function newVoyage($request,$context)
	{
		if($context->getSessionAttribute("user_id")!=NULL) {
			$context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		}
		else 
			return context::ERROR;
		$context->villes = trajetTable::getVilles();
		return context::SUCCESS;
	}

	/**
	* Ajouter un nouveau Voyage
	*/

	public static function newVoyagePost($request, $context){
		$context->success = "false";
		if($context->getSessionAttribute("user_id")!=NULL) $context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		else {
			$context->error = "Not connected";
			return context::ERROR;
		}
		
		if(key_exists("depart",$request) && key_exists("tarifparkm",$request) && key_exists("arrivee",$request) && key_exists("heuredepart",$request) && key_exists("nbplace",$request) && key_exists("contraintes",$request)){

			$context->tarifparkm = $request['tarifparkm'];
			$context->depart = $request['depart'];
			$context->arrivee = $request['arrivee'];
			$context->heuredepart = $request['heuredepart'];
			$context->nbplace = $request['nbplace'];
			$context->contraintes = $request['contraintes'];
			if($request['depart']==$request['arrivee']){
				$context->error = "La ville de depart doit etre differente de celle d'arrivée";
				return context::ERROR;
			}
			if($context->tarifparkm<=0){
				$context->error = "Le tarif par km doit etre superieure à 0";
				return context::ERROR;	
			}
			if($context->nbplace<=0){
				$context->error = "Le nombre de places doit etre superieure à 0";
				return context::ERROR;	
			}
			if($context->heuredepart<0 || $context->heuredepart >23){
				$context->error = "Heure de départ incorrect";
				return context::ERROR;	
			}
			else{

				$context->voyage = voyageTable::nouveauVoyage($context->depart, $context->arrivee, $context->heuredepart,$context->nbplace, $context->tarifparkm, $context->contraintes, $context->user);
				if(!$context->voyage){
					$context->error = "ERREUR: Le voyage n'a pas pu etre ajouté";
					return context::ERROR;	
				}
				$context->success = "true";
				return context::SUCCESS;
			}

		}
		$context->error = "Données Incomplete";
		return context::ERROR;
	}

	/**
	* Afficher les details d'un voyage
	*/
	
	public static function afficherVoyage($request,$context){
		
		
		$context->voyages = new ArrayObject();
		foreach($request['voyage'] as $voy){
			$voyage = voyageTable::getVoyageById($voy);
			$context->voyages->append($voyage);

		}
		$context->depart=$request['depart'];
		$context->arrivee=$request['arrivee'];
		$context->distance=$request['distance'];
		$context->tarif=$request['tarif'];
		$context->heureDepart=$request['heureDepart'];
		$context->heureArrivee=$request['heureArrivee'];
		$context->contraintes=$request['contraintes'];
		$context->conducteurs = new ArrayObject();
		foreach($request['conducteur'] as $con){
			$conducteur = utilisateurTable::getUserById($con);
			$context->conducteurs->append($conducteur);

		}

		return context::SUCCESS;
	}

	/**
	* Ajouter une nouvelle réservation
	*/
	public static function reserverVoyage($request,$context){
		
		
		foreach($request['voyage'] as $voyage){
			$voyageur = $request['voyageur'];
			
			if(reservationTable::addReservation(voyageTable::getVoyageById($voyage),  utilisateurTable::getUserById($voyageur))){
				return context::ERROR;
			}
			else{
				return context::SUCCESS;
			}
			
		}
		

		
	}

	/**
	* Afficher les reservations d'un utilisateur
	*/

	public static function mesReservations($request,$context) {

		$utilisateur = utilisateurTable::getUserById($_SESSION["user_id"]);
		$context->allReservations = reservationTable::getReservationsByVoyageur($utilisateur->id);
		$voyageData = array();
		foreach($context->allReservations  as $reservation){
			
			array_push($voyageData, new voyageData($reservation->voyage));
		}
		$context->voyages = $voyageData;
		return context::SUCCESS;

	}

	/**
	* Ajouter un nouveau utilisateur
	*/
	public static function register($request,$context)
	{
		if(key_exists("nom",$request) && key_exists("prenom",$request) && key_exists("identifiant",$request) && key_exists("password",$request)){
			$context->nom = $request['nom'];
			$context->prenom =  $request['prenom'];
			$context->identifiant =  $request['identifiant'];
			$context->password =  $request['password'];
			if(utilisateurTable::getUserByLogin($request['identifiant'])){
				$context->errorMSG = "Pseudo déjà utilisé";
				return context::ERROR;
			}
			else{																						
				$user = utilisateurTable::addUtilisateur($context->nom, $context->prenom, $context->identifiant, $context->password);
				$context->success = true;																 		
			}
		} 
		return context::SUCCESS;
	}

	/**
	* Methode d'authentification 
	*/

	public static function login($request,$context)
	{
		if(key_exists("identifiant",$request) && key_exists("password",$request)){

			$context->identifiant =  $request['identifiant'];
			$context->password =  $request['password'];
			$user = utilisateurTable::getUserByLoginAndPass($context->identifiant, $context->password);
			if($user){
				unset($_SESSION["user_id"]);
				unset($_SESSION["user_prenom"]);
				$context->setSessionAttribute('user_id',$user->id);
				$context->setSessionAttribute('user_prenom',$user->prenom);
				 
				
				return context::SUCCESS;
			}
			else{
				$context->errorMSG = "Pseudo ou mot de passe est incorrect";
				return context::ERROR;
			}
		}
		return context::SUCCESS;
	}

	/**
	* Afficher le header
	*/

	public static function header($request,$context)
	{
		return context::SUCCESS;
	}

	/**
	* Methode de déconnection
	*/
	public static function logout($request, $context){
		
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_prenom"]);
		echo "tst";
		header('location: monApplication.php'); 
	}
	
	


	public static function index($request,$context){
		
		return context::SUCCESS;
	}


}
