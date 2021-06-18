<?php if(count($context->voyagesdirect)>0 || count($context->voyagesCorrespendance)>0) { ?>
<div class="alert alert-success" role="alert">
  <?php echo count($context->voyagesCorrespendance) ?> Voyage(s) trouvé(s)
</div>

	
	 

<?php
	 

	
	 foreach($context->voyagesCorrespendance as $voyage){?>

	 <div class="card bg-light text-dark rounded-lg" style="height:160px;cursor:pointer;" role="button" data-id="<?php 
			$array = array();
			foreach($context->listvoyages[$voyage->id] as $voyages){
				array_push($array,$voyages->id);}
				echo json_encode($array);
			 ?>" data-contraintes="<?php echo $voyage->contraintes ?>"  data-distance="<?php echo $voyage->trajet->distance ?>"  >
    	<div class="card-body" style="background-color:#34568B;padding-top:5px;">
			<div class="row">
				<div class="col col-lg-4" style="margin-left:10px;">
					<ul class="list-group " >
						<li class="list-group-item border-0" style="background-color:#34568B;padding:0px;">
							<div class="col">
								<span id="cardHeureDepart" name="cardHeureDepart" style ="color: #F2F2F2 ;font-size: 18px;font-weight: 600;font-family: 'Trebuchet MS', serif;" data-id="<?php echo $voyage->heuredepart ?>"><?php echo $voyage->heuredepart?>:00</span>
							</div>
							<div class="col" >
								<p id="cardDepart" name="cardDepart" style ="color:#F8F8FF ;font-size: 20px;font-weight: 500;font-family: 'Trebuchet MS', serif;" data-id="<?php echo $voyage->trajet->depart?>"><?php echo $voyage->trajet->depart ?></p>
							</div>
						</li>
						<li class="list-group-item border-0" style="background-color:#34568B;padding:0px">
						<div class="col">
								<span id="cardHeureArrivee" name="cardHeureArrivee" style ="color:#F2F2F2 ;font-size: 18px;font-weight: 600;font-family: 'Trebuchet MS', serif;" data-id="<?php echo $context->heurearrivee[$voyage->id] ?>"><?php echo $context->heurearrivee[$voyage->id]?>:00</span>
							</div>
							<div class="col" >
								<p id="cardArrivee" name="cardArrivee" style ="color:#F8F8FF ;font-size: 20px;font-weight: 500;font-family: 'Trebuchet MS', serif; " data-id="<?php echo $voyage->trajet->arrivee ?>"><?php echo $voyage->trajet->arrivee ?></p>
							</div>
						</li>
						
					</ul>
					
				</div>
				
				<div class="col col-md-3" style="padding-top:44px;">
				<?php if(count($context->listvoyages[$voyage->id]) > 1) { ?>
					<p style ="color:#EEEEEE ;font-size: 16px;font-weight: 500;font-family: 'Trebuchet MS', serif;"> <?php echo count($context->listvoyages[$voyage->id])-1 ?> Correspendance</p>
				
				<?php } ?>
				
				</div>
				<div class="col col-md-4" style="padding-right:0px;">
					<div class="col" style="text-align:right;">
						<span id="cardTarif" name="cardTarif" style="color:#4595ff;font-size: 28px;font-weight: 600;" data-id="<?php echo $voyage->tarif ?>"><?php echo $voyage->tarif ?> € </span>
					</div>
					<div class="col" style="margin-left:10px;text-align:right;">
                		<p id="cardConducteur" name="cardConducteur" style="color: #F8F8FF;font-size: 22px;line-height: 20px;font-family: 'Trebuchet MS', serif;" data-id="<?php 
						$array = array();
						foreach($context->conducteurs[$voyage->id] as $conducteurs){
							array_push($array,$conducteurs->id);}
							echo json_encode($array);
						?>">
						<?php foreach($context->conducteurs[$voyage->id] as $conducteurs){
							echo $conducteurs->nom." ".$conducteurs->prenom."/"; }?>
							</p>
            		</div>
					<div class="col" style="margin-left:10px;text-align:right;">
                		<p style="color: #2ecc71;font-size: 22px;line-height: 20px;font-family: 'Trebuchet MS', serif;" data-id="<?php echo $voyage->nbplace ?>" ><?php echo $voyage->nbplace?>  Place restantes </p>
            		</div>
					
            	</div>

			</div>
				
		</div>
  	</div>

	  <hr style="height: 2px;">
	 	
	 <?php }
	 ?>



<?php }else {  ?>
	<div class="alert alert-danger" role="alert">
 		 Aucun résultat
	</div>
<?php }?>