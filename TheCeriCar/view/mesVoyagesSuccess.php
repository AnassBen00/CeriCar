<div id="container">
    <div id="page_maincontent">	

      	<div class="col" > 
            <div class="rounded-lg">
                <div class="col col-lg "style = "font-size: 27px; font-weight: 600; font-family: 'Trebuchet MS', serif;padding-top:20px;">
                    <p style="color:#34568B;font-size: 30px;font-weight: 550;float:left;margin-left:10px">Mes Voyages</p>
                    <div class="col col-sm-3" style="float:right;">
                  <a id="nouveauVoyage" href="monApplication.php?action=newVoyage" class="btn btn-light btn-lg btn-block" style="color:#17a2b8;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> Nouveau voyage</a>
                  </div>
                </div>
               
                <div style="margin:85px 200px 0 200px;">

              <?php foreach($context->voyagesData as $voyageData) { ?>
                      <div class="row">
                          <div class="col-sm">
                        <div class="card voyage rounded-lg">
                        
                        <div class="card-body">
                          
                              <div class="row">
                            <div class="col-sm">
                              <table cellpadding="5">
                                <tr><th><?php echo $voyageData->departFormat?></th><th><?php echo $voyageData->voyage->trajet->depart;?></th></tr>
                                <tr><td colspan="2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
</svg>  <?php echo $voyageData->dureeFormat?></td></tr>
                                <tr><th><?php echo $voyageData->arriveeFormat?></th><th><?php echo $voyageData->voyage->trajet->arrivee;?></th></tr>
                                <tr><td colspan="2"> </td></tr>
                              </table>
                            </div>
                            <div class="col-sm">
                                  <input type="hidden" name="voyages[]" value="<?php echo $correspendance->voyagesData[0]->voyage->id ?>">
                                  <table cellpadding="5">
                                    <?php if(trim($voyageData->voyage->contraintes) !=="") { ?>
                                  <tr><th>Contraintes</th><td><?php echo trim($voyageData->voyage->contraintes) ?></td></tr>
                                    <?php } ?>
                                  <tr><th colspan="2">Conducteur</th></tr>
                                  <tr><td colspan="2"><img src="https://picsum.photos/200" class="profilpic"> <?php echo $voyageData->voyage->conducteur->nom." ".$voyageData->voyage->conducteur->prenom?></td></tr>
                                  <tr><td colspan="2"><b><?php echo $voyageData->placeReserve?> Passager(s)</b></td></tr>
                                  </table>
                            </div>
                          </div>
                              <?php if($voyageData->placeReserve >0) { ?>
                            <div><a href="#" class="showreservations">Afficher le(s) <?php echo $voyageData->placeReserve?> Passager(s)</a></div>
                          <div class="table table-striped reservations" style="display: none" >
                            <table style="width: 100%">
                              <?php foreach($voyageData->reservations as $reservation) {?>

                              <tr>
                                <td>
                                  <b> <?php echo $reservation->voyageur->nom . " ".$reservation->voyageur->prenom;?></b><br>
                                  <i> <?php echo $reservation->voyageur->identifiant;?></i>
                                </td>
                              </tr>

                              <?php } ?>
                            </table>
                          </div>
                              <?php } ?>
                          </div>
                            </div></div>
                    </div>    
                            <?php } ?>
                </div>            
            </div>
        </div>
    </div>
         
</div>

<script>

    $("#nouveauVoyage").click(function(){
         
      
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=newVoyage',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
            
    });
</script>