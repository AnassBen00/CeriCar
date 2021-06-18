$("#submitReservation").click(function(){
         
    var voyage = $("#voyageChoisi").data("id");
    var voyageur = $("#utilisateur-id").data("id");

    console.log(voyage,voyageur);
     
    $.ajax({
        url : 'ajaxDispatcher.php?action=reserverVoyage',
        data: {voyage: voyage,voyageur: voyageur},
        type : 'GET',
        dataType : 'html', 
        success : function(code_html, statut){ 
           
            $("#page_maincontent").html(code_html);
        }
        });
        
});