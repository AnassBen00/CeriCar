<div id="container">
    <div id="page_maincontent">	

      	<div class="col" > 
            <div class="rounded-lg">
                <div class="col col-lg "style = "font-size: 27px; font-weight: 600; font-family: 'Trebuchet MS', serif;text-align:center;padding-top:20px;">
                    <p style="color:#34568B;font-size: 30px;font-weight: 550;">Mes Réservations</p>
                </div>
                <div style="margin:35px 200px 0 200px;">

                        <?php foreach($context->allReservations as $reservation) {
                                foreach($context->voyages as $voyage) { ?>
                                
                                    <div class="card bg-light text-dark rounded-lg" style="height:180px;cursor:pointer;" >
                                        <div class="card-body" style="background-color:#34568B;padding-top:5px;">
                                            <div class="row">
                                                <div class="col col-md-6" style="margin-left:10px;">
                                                    <ul class="list-group " >
                                                        <li class="list-group-item border-0" style="background-color:#34568B;padding:0px;">
                                                            <div class="col">
                                                                <span style ="color: #F2F2F2 ;font-size: 18px;font-weight: 600;font-family: 'Trebuchet MS', serif;" ><?php echo $voyage->departFormat;?></span>
                                                            </div>
                                                            <div class="col" >
                                                                <p style ="color:#F8F8FF ;font-size: 20px;font-weight: 500;font-family: 'Trebuchet MS', serif;" ><?php  echo $voyage->voyage->trajet->depart; ?></p>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item border-0" style="background-color:#34568B;padding:0px;">
                                                            <div class="col">
                                                                <span style ="color: #F2F2F2 ;font-size: 18px;font-weight: 600;font-family: 'Trebuchet MS', serif;" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                                        </svg><?php echo $voyage->dureeFormat;?></span>
                                                            </div>
                                                           
                                                        </li>
                                                        
                                                        <li class="list-group-item border-0" style="background-color:#34568B;padding:0px">
                                                        <div class="col">
                                                                <span style ="color:#F2F2F2 ;font-size: 18px;font-weight: 600;font-family: 'Trebuchet MS', serif;" ><?php echo $voyage->arriveeFormat;?></span>
                                                            </div>
                                                            <div class="col" >
                                                                <p style ="color:#F8F8FF ;font-size: 20px;font-weight: 500;font-family: 'Trebuchet MS', serif; " ><?php  echo $voyage->voyage->trajet->arrivee ;?></p>
                                                            </div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                                <div class="col col-md-4" style="padding-left:20px;padding-top:10px;text-align:right;">
                                                    <div class="col" style="text-align:right;">
                                                        <span style="color:#4595ff;font-size: 28px;font-weight: 600;" >Reservation: <?php echo $reservation->id;?></span>
                                                        <p style="color: #F8F8FF;font-size: 22px;line-height: 20px;font-family: 'Trebuchet MS', serif;" ><?php echo $voyage->voyage->conducteur->nom."".$reservation->voyage->conducteur->prenom ; ?></p>

                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

                                   
                            
                        
                            <?php } ?>
                            <hr style="height: 2px;">   <?php } ?>
                
                </div>            
            </div>
        </div>
    </div>
         
</div>