CREATE OR REPLACE FUNCTION VoyageCorrespendance2(villedepart text, villearrivee text, nbr_voyageurs numeric) returns table( id numeric, conducteur integer, trajet integer, tarif integer, nbplace integer, heuredepart integer, contraintes VARCHAR, correspendance boolean, correspendanceVoyage numeric ) as $$ 
DECLARE
depart_cursor REFCURSOR;
depart2_cursor REFCURSOR;
depart_row RECORD;
arrivee_row RECORD;
arrivee_voyage jabaianb.voyage.id%TYPE;
arrivee_distance jabaianb.trajet.distance%TYPE;
arrivee_heureDepart jabaianb.voyage.heuredepart%TYPE;

rec RECORD ;

BEGIN
OPEN depart_cursor FOR SELECT voyage.id, voyage.conducteur, voyage.trajet, voyage.tarif, voyage.nbplace, voyage.heuredepart, voyage.contraintes, trajet.arrivee, trajet.distance FROM jabaianb.voyage INNER JOIN jabaianb.trajet ON voyage.trajet = trajet.id WHERE trajet.depart = villedepart;
LOOP
	FETCH depart_cursor into depart_row;
	EXIT WHEN NOT FOUND ; 
		IF depart_row.arrivee = villearrivee THEN
			IF NbPlacesRestantes(depart_row.id) >= nbr_voyageurs THEN
				id:= depart_row.id;
				conducteur:= depart_row.conducteur;
				trajet:= depart_row.trajet;
				tarif:= depart_row.tarif;
				nbplace:= NbPlacesRestantes(depart_row.id);
				heuredepart:= depart_row.heuredepart;
				contraintes:= depart_row.contraintes;
                correspendance:= false;
                correspendanceVoyage:= null;
				RETURN NEXT; 
             ELSE 
				/*RAISE EXCEPTION USING MESSAGE="Nbr places inconvenable";*/
                  RAISE NOTICE 'place1 %,%',NbPlacesRestantes(depart_row.id),nbr_voyageurs;

             END IF ;   
		ELSE
			IF EXISTS ( SELECT voyage.id, voyage.conducteur, voyage.trajet, voyage.tarif, voyage.nbplace, voyage.heuredepart, voyage.contraintes, trajet.depart FROM jabaianb.voyage INNER JOIN jabaianb.trajet ON voyage.trajet = trajet.id WHERE trajet.depart = depart_row.arrivee AND trajet.arrivee = villearrivee) THEN
					SELECT voyage.id, trajet.distance, voyage.heuredepart into arrivee_voyage, arrivee_distance, arrivee_heureDepart  FROM jabaianb.voyage INNER JOIN jabaianb.trajet ON voyage.trajet = trajet.id WHERE trajet.depart = depart_row.arrivee AND trajet.arrivee = villearrivee;
                    IF depart_row.distance + arrivee_distance > 1440 THEN
						/*RAISE EXCEPTION USING MESSAGE="Distance inconvenable";*/
                        RAISE NOTICE '%',depart_row.distance + arrivee_distance;
					ELSIF depart_row.heuredepart + (depart_row.distance/100) > arrivee_heureDepart THEN
						RAISE NOTICE '%,%',depart_row.distance/100,depart_row.heuredepart + (depart_row.distance/100);
						/*RAISE EXCEPTION USING MESSAGE="Horraire inconvenable";*/
                    ELSIF NbPlacesRestantes(arrivee_voyage) < nbr_voyageurs THEN
						/*RAISE EXCEPTION USING MESSAGE="Nbr places inconvenable"; */
                        RAISE NOTICE ' place %,%',NbPlacesRestantes(arrivee_voyage),nbr_voyageurs;
					ELSE 
						id:= depart_row.id;
						conducteur:= depart_row.conducteur;
						trajet:= depart_row.trajet;
						tarif:= depart_row.tarif;
						nbplace:= depart_row.nbplace;
						heuredepart:= NbPlacesRestantes(depart_row.heuredepart);
						contraintes:= depart_row.contraintes;
                        correspendance:= true;
						correspendanceVoyage:= arrivee_voyage;
						RETURN NEXT; 
                        
						RETURN 	QUERY SELECT * FROM VoyageCorrespendance2(depart_row.arrivee,villearrivee,nbr_voyageurs);
					END IF;
                    
			ELSE 
				/*RFOR rec IN SELECT arrivee FROM jabaianb.trajet INNER JOIN jabaianb.voyage ON trajet.id = voyage.trajet WHERE trajet.arrivee NOT LIKE villedepart LOOP
					
					RETURN QUERY SELECT * FROM VoyageCorrespendance2(villedepart,rec.arrivee,nbr_voyageurs);
				END LOOP;*/
			END IF;
        END IF;
END LOOP;
CLOSE depart_cursor;
EXCEPTION 
WHEN RAISE_EXCEPTION THEN 
		RAISE NOTICE '%',SQLERRM;
END;
$$ LANGUAGE 'plpgsql';