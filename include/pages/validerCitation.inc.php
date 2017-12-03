<h1>Validation des citation</h1>



<?php

	$pdo = new Mypdo();
	$citationManager = new CitationManager($pdo);
	$personneManager = new PersonneManager($pdo);

	$listeCitationNonValide = $citationManager->getAllCitationsNonValides();

	if(empty($listeCitationNonValide)){
		?>
			<p>
				Il n'y a aucune citations à valider.
			</p>
		<?php
	}
	else{

?>
	<table>
		<tr>
			<th>Nom de l'enseignant</th>
			<th>Libellé</th>
			<th>Date</th>
			<th>Valider</th>
			<th>Supprimer</th>

			<?php 
				foreach ($listeCitationNonValide as $citation) {
							
					$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
					?>
					<tr>
						<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
						<td> <?php echo $citation->getLibelle() ?> </td>
						<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
						<td><a href="index.php?page=16&valider=<?php echo $citation->getNumero() ?>"><img src="image/valid.png" title="Cliquez ici pour valider la citation" alt="Valider"/></a></td>
						<td><a href="index.php?page=16&supprimer=<?php echo $citation->getNumero() ?>"><img src="image/erreur.png" title="Cliquez pour supprimer la citation" alt="Supprimer"/></a></td>
					</tr>
					<?php
				}
			 ?>
	</table>
<?php 
}
?>