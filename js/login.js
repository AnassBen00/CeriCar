$(document).ready(function(){
    $('#login').submit(function(){

             var data = $(this).serialize();



                  $.ajax({
                   url : 'ajaxDispatcher.php?action=login',
                   data: $(this).serialize(),
                   type : 'GET',
                   success : function(html, statut){ 
                    // Modification du header
                           $.get('ajaxDispatcher.php?action=header',function(data){
                               $("#header").html(data);
                               
                           });
                        // Afficher la vue du recherche voyage
                        $.get('ajaxDispatcher.php?action=rechercheVoyage',function(data){
                            $("#page_maincontent").html(data);
                           
                        });

                   }
                   });


             return false;
         })
});