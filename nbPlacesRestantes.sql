CREATE OR REPLACE FUNCTION NbPlacesRestantes(idVoyage jabaianb.voyage.id%TYPE)
RETURNS INTEGER
AS
$$
	DECLARE
        nbr INTEGER;
	BEGIN
        SELECT voyage.nbplace - nbPlacesReserves(idVoyage) INTO nbr FROM jabaianb.voyage WHERE voyage.id = idVoyage;
        RETURN nbr;
	END;
$$
LANGUAGE plpgsql;