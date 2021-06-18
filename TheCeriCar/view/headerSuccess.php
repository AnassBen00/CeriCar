<nav class="navbar navbar-expand-sm navbar-dark bg-info">
      <a class="navbar-brand" href="monApplication.php">THE CERICAR</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="monApplication.php?action=rechercheVoyage" >Rechercher un trajet </a>
          </li>
       <?php if($context->getSessionAttribute('user_id'))  { ?>
      
      
      <?php } ?>
    </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php if(!isset($_SESSION["user_id"]) ) { ?>
      <li class="nav-item active">
        <a class="nav-link" href="monApplication.php?action=login">Se connecter</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="monApplication.php?action=register">S'inscrire</a>
      </li>
     <?php } else{?>
      <li class="nav-item active">
        <a id="affichermesVoyages" class="nav-link" href="monApplication.php?action=mesVoyages">Mes voyages</a>
      </li>
      <li class="nav-item active">
        <a id="affichermesReservations" class="nav-link" href="monApplication.php?action=mesReservations">Mes Reservations</a>
      </li>
      <li class="nav-item active">
        <a id="utilisateur-id" class="nav-link" data-id= "<?php echo $context->getSessionAttribute('user_id') ?>"><?php echo $context->getSessionAttribute('user_prenom') ?></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="monApplication.php?action=logout">Se déconnecter</a>
      </li>
     <?php } ?>
    </ul>
      </div>
    </nav>


    <script>

    $("#affichermesReservations").click(function(){
         
      
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=mesReservations',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
            
    });
</script>

<script>

    $("#affichermesVoyages").click(function(){
         
      
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=mesVoyages',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
            
    });
</script>