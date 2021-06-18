$(document).ready(function(){
	$('#recherche').submit(function(){
        
		 	$("#resultat").html( "<center><div class=\"spinner-border text-dark\" role=\"status\"><span class=\"sr-only\">Loading...</span></div><p>Recherche en cours...</p></center>" );
		 	var villeDepart = $("#formDepart").val();
			 var villeArrivee = $("#formArrivee").val();
			 var nbrvoyageurs = $("#nbrvoyageurs").val();
			 

		 	 $.ajax({
		       url : 'ajaxDispatcher.php?action=ajaxRechercheVoyage',
		       data: {depart: villeDepart, arrivee: villeArrivee, nbrvoyageurs: nbrvoyageurs },
		       type : 'POST',
		       dataType : 'html', 
		       success : function(code_html, statut){ 
		       	
		          $("#resultat").html(code_html);
		       }
	   		});


		 	return false;
		 })
});