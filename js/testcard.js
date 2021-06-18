$(document).ready(function() {
	$('body').on('click','.card',function (event) {
        var voyage = $(this).data("id");
        var contraintes = $(this).data("contraintes");
        var distance = $(this).data("distance");
        var depart = $(this).find("p").eq(0).data("id");
        var heureDepart = $(this).find("span").eq(0).data("id");
        var arrivee = $(this).find("p").eq(1).data("id");
        var heureArrivee = $(this).find("span").eq(1).data("id");
        var conducteur = $(this).find("p").eq(2).data("id");
        var tarif = $(this).find("span").eq(2).data("id");

        console.log(conducteur);
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=reserverVoyage',
            data: {voyage: voyage, depart: depart, arrivee: arrivee, distance: distance, tarif: tarif, heureDepart: heureDepart,heureArrivee: heureArrivee,conducteur: conducteur, contraintes:contraintes },
            type : 'GET',
            dataType : 'html', // On désire recevoir du HTML
            success : function(code_html, statut){ // code_html contient le HTML renvoyé
                //console.log(code_html);
            $("#content").html(code_html);
            }
            });
    });
});