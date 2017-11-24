	<?php
		$db = new Mypdo();
		$villeManager = new VilleManager($db);
		$listeVille = $villeManager->getAllVilles();
	?>


	<h1>Liste des villes</h1>
	<table>
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
		</tr>

		<?php
			foreach ($listeVille as $ville) {
		?>
				<tr>
					<td> <?php echo $ville->getNumero() ?> </td>
					<td> <?php echo $ville->getNom() ?> </td>
				</tr>
		<?php
			}
		?>
	</table>