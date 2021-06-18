$(document).ready(function() {
	$('body').on('click','.card',function (event) {
        var voyage = $(this).data("id");
        var contraintes = $(this).data("contraintes");
        var distance = $(this).data("distance");
        var depart = $(this).find("p").eq(0).data("id");
        var heureDepart = $(this).find("span").eq(0).data("id");
        var arrivee = $(this).find("p").eq(1).data("id");
        var heureArrivee = $(this).find("span").eq(1).data("id");
        if($(this).data("id").length == 1) {
            var conducteur = $(this).find("p").eq(2).data("id");
        }
        else{
            var conducteur = $(this).find("p").eq(3).data("id");
        }
        var tarif = $(this).find("span").eq(2).data("id");

       
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=afficherVoyage',
            data: {voyage: voyage, depart: depart, arrivee: arrivee, distance: distance, tarif: tarif, heureDepart: heureDepart,heureArrivee: heureArrivee,conducteur: conducteur, contraintes:contraintes },
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                $("#content").html(code_html);
            }
            });
    });
});