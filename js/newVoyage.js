$(document).ready(function(){
    $('#newVoyage').submit(function(){
             var data = $(this).serialize();
             console.log(data);

            if(true){
                  $.ajax({
                   url : 'ajaxDispatcher.php?action=newVoyagePost',
                   data: $(this).serialize(),
                   type : 'POST',
                   dataType : 'html', 
                   success : function(html, statut){ 

                       console.log(html);

                           $("#resultat").html(html);

                   }
                   });
             }

             return false;
         })
});