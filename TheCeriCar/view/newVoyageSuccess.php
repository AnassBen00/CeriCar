<div style="margin-left:75px;margin-top:30px;margin-right:2px;" class="container">
      <form method="GET" action="" id="newVoyage">
            <div class="row">
                <div class="col col-lg "style = "font-size: 27px; font-weight: 600; font-family: 'Trebuchet MS', serif;text-align:center;padding-top:20px;">
                    <p style="color:#34568B;font-size: 30px;font-weight: 550;">Nouveau Voyage</p>
                </div>
            </div>

            <div class="row"> 

                    <div class="col">
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="depart">Ville de départ</label>
  </div>
<select name="depart" id="depart" class="custom-select">
	
	<?php foreach($context->villes as $ville) { ?>
		<?php if(isset($_REQUEST['depart']) && $_REQUEST['depart'] == $ville['ville']){ ?>
		<option value="<?php echo $ville['ville'] ?>" selected><?php echo $ville['ville'] ?></option>
		<?php }else{ ?>
		<option value="<?php echo $ville['ville'] ?>"><?php echo $ville['ville'] ?></option>
	<?php } } ?> 
</select>
</div>
</div>
<div class="col">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="arrivee">Ville d'arrivée</label>
  </div>
<select name="arrivee" id="arrivee" class="custom-select">
	<?php foreach($context->villes as $ville) { ?>
		<?php if(isset($_REQUEST['arrivee']) && $_REQUEST['arrivee'] == $ville['ville']){ ?>
		<option value="<?php echo $ville['ville'] ?>" selected><?php echo $ville['ville'] ?></option>
		<?php }else{ ?>
		<option value="<?php echo $ville['ville'] ?>"><?php echo $ville['ville'] ?></option>
	<?php } } ?> 
</select>
</div>
</div>

</div>
<hr style="height: 8px;">
<div class="row">
	<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Nombre de Places</div>
        </div>
        <input type="number" max="5" min="1" class="form-control" name="nbplace" id="nbplace" value="1">
      </div>
</div>
<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Prix par Km</div>
        </div>
        <input type="number" max="50" min="0" step="0.001" class="form-control" name="tarifparkm" id="tarifparkm" value="1">
      </div>
</div>
</div>
<hr style="height: 8px;">
<div class="row">
	<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Heure De Depart</div>
        </div>
        <input type="number" max="23" min="0" class="form-control" name="heuredepart"  id="heuredepart" value="0">
      </div>
</div>
<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Contraintes</div>
        </div>
        <textarea name="contraintes" id="contraintes" ></textarea>
      </div>
</div>
</div>
<div class="row">
<div class="col" style="text-align:center;">
<button type="submit" class="btn btn-info" style="font-size: 20px;font-weight: 600;font-family: 'Trebuchet MS', serif" >Ajouter</button>
</div>
</div>
                </form>
                </div>
                <div id="resultat" style="margin-top:10px;">

                </div>

<script>
$(document).ready(function(){
    $('#newVoyage').submit(function(){
             var data = $(this).serialize();
             console.log(data);

            if(true){
                  $.ajax({
                   url : 'ajaxDispatcher.php?action=newVoyagePost',
                   data: $(this).serialize(),
                   type : 'POST',
                   dataType : 'html', // On désire recevoir du HTML
                   success : function(html, statut){ // code_html contient le HTML renvoyé

                       //console.log(html);

                           $("#resultat").html("<div class='alert alert-success' role='alert'>Le voyage a été créé <a href='?action=mesVoyages'>Consulter vos voyages </a></div>");

                   }
                   });
             }

             return false;
         })
});
</script>