<div id="content">
    <div id="voyageChoisi" class ="shadow p-3 mb-5 bg-white rounded" style="background-color:#fafbfc;border-width:3px" data-id="<?php 
			$array = array();
			foreach($context->voyages as $voyage){
				array_push($array,$voyage->id);}
				echo json_encode($array);
			 ?>">
        <?php if(count($context->voyages)>1){
            foreach($context->voyages as $voyagecourrant){?>
            <div class="row">
            <div class="col-6 col-md-6" style="text-align:center;">
                <div class="col" style="text-align:center;">
                    <p style="color:#4a4a4a;font-size: 24px;font-weight: 500;"> <?php echo $voyagecourrant->trajet->depart ?> </p>
                </div>
                <div class="col" style="text-align:center;">
                    <span style="color:#054752;font-size: 20px;font-weight: 500;"> <?php echo $voyagecourrant->heuredepart?>:00</span>
                </div>
            </div>
            
            <div class="col-6 col-md-6" style="text-align:center;">
                <div class="col" style="text-align:center;">
                    <p style="color:#4a4a4a;font-size: 24px;font-weight: 500;"> <?php echo $voyagecourrant->trajet->arrivee ?></p>
                </div>
                <div class="col" style="text-align:center;">
                    <span style="color:#054752;font-size: 20px;font-weight: 500;"> <?php echo $voyagecourrant->heuredepart+explode('.',$voyagecourrant->trajet->distance/100)[0]?>:00 </span>
                </div>
            </div>
        </div>


        <?php }?>
        <div class="row">
            <div class="col" style="text-align:center;" >
                    <div class="col" style="text-align:center;">
                        <span style="color:#4595ff;font-size: 28px;font-weight: 600;"> <?php echo $context->tarif ?> € </span>
                    </div>
                    <hr style="height: 2px;">
                    <div class="col" style="text-align:center;">
                        <span style="color:#054752;font-size: 16px;font-weight: 500;"> <?php echo $context->distance ?> Km </span>
                    </div>
            </div>
        </div>
        <?php } else{?>
        <div class="row">
            <div class="col-6 col-md-4" style="text-align:center;">
                <div class="col" style="text-align:center;">
                    <p style="color:#4a4a4a;font-size: 24px;font-weight: 500;"> <?php echo $context->depart ?> </p>
                </div>
                <div class="col" style="text-align:center;">
                    <span style="color:#054752;font-size: 20px;font-weight: 500;"> <?php echo $context->heureDepart?>:00</span>
                </div>
            </div>
            <div class="col-6 col-md-4" >
                <div class="col" style="text-align:center;">
                    <span style="color:#4595ff;font-size: 28px;font-weight: 600;"> <?php echo $context->tarif ?> € </span>
                </div>
                <hr style="height: 2px;">
                <div class="col" style="text-align:center;">
                    <span style="color:#054752;font-size: 16px;font-weight: 500;"> <?php echo $context->distance ?> Km </span>
                </div>
            </div>
            <div class="col-6 col-md-4" style="text-align:center;">
                <div class="col" style="text-align:center;">
                    <p style="color:#4a4a4a;font-size: 24px;font-weight: 500;"> <?php echo $context->arrivee ?></p>
                </div>
                <div class="col" style="text-align:center;">
                    <span style="color:#054752;font-size: 20px;font-weight: 500;"> <?php echo $context->heureArrivee?>:00 </span>
                </div>
            </div>
        </div>
        <?php } ?>
        <hr style="height: 8px;">
        <div class="row">
        <?php foreach($context->conducteurs as $conducteur) {?>
            <div class="col col-sm-2">
                <div class="rounded-circle" style="background-color:##cfd1d4;">
                    <p>img</p>
                </div>
            </div>
            <div class="col" style="text-align:Left;">
                <p style ="color: rgb(5, 71, 82);font-size: 18px;font-weight: 600;font-family: 'Trebuchet MS', serif;" ><?php echo $conducteur->nom . " ".$conducteur->prenom?></p>
            </div>
        <?php } ?>
        </div>
        <hr style="height: 8px;">
        <div class="row">
            <div class="col" style="margin-left:10px">
                <p style="color: rgb(112, 140, 145);font-size: 16px;line-height: 20px;font-family: 'Trebuchet MS', serif;"><?php echo $context->contraintes ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg" style="text-align:center;">
               
                    <button id="submitReservation" class="btn btn-info reservation" style="font-size: 18px;font-weight: 500;font-family: 'Trebuchet MS', serif;">Reserver</button>

               

            </div>
        </div>

    </div>
</div>

<script>

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
                console.log(code_html);
                $("#page_maincontent").html(code_html);
            }
            });
            
    });
</script>