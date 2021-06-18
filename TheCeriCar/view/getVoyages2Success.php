<?php if(count($context->voyages)>0) { ?>
<div class="alert alert-success" role="alert">
  <?php echo count($context->voyages) ?> Voyage(s) trouvé(s)
</div>
<table cellpadding="10" class="table table-striped table-active">
	 <thead class="thead-dark">
		<tr><th>Départ</th><th>Arrivée</th><th>Distance</th><th>Heure de départ</th><th>Tarif</th><th>Nombre de place</th><th>Conducteur</th><th>Contraintes</th></tr>
		</thead>
	<?php foreach($context->voyages as $voyage){ ?>
		<tr><td><?php echo $voyage->trajet->depart?></td>
			<td><?php echo $voyage->trajet->arrivee ?></td>
			<td><?php echo $voyage->trajet->distance?> km</td>
			<td><?php echo $voyage->heuredepart?>h00</td>
			<td><?php echo $voyage->tarif ?> €</td>
			<td><?php echo $voyage->nbplace?> places</td>
			<td><?php echo $voyage->conducteur->nom . " ".$voyage->conducteur->prenom ?></td>
			<td><?php echo $voyage->contraintes ?></td>
		</tr>
	<?php } ?>
</table>
<?php }else {  ?>
	<div class="alert alert-danger" role="alert">
 		 Aucun résultat
	</div>
<?php }?>