CREATE OR REPLACE FUNCTION nbPlacesReserves(idVoyage  jabaianb.voyage.id%TYPE)
RETURNS INTEGER
AS
$$
	DECLARE
        nbr INTEGER;
	BEGIN
        SELECT COUNT(*) INTO nbr FROM jabaianb.reservation WHERE voyage = idVoyage;
        RETURN nbr;
	END;
$$
LANGUAGE plpgsql;
