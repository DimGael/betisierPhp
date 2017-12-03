 <h1> Suppression d'une ville </h1>

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
					<td> <a href = "index.php?page=23&vil=<?php echo $ville->getNumero();?>"><img src="./image/erreur.png" alt="Erreur"> </td>
				</tr>
		<?php
			}
		?>
	</table>
