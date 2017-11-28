<?php


	$pdo = new Mypdo();
	$citationManager = new CitationManager($pdo);
	$personneManager = new PersonneManager($pdo);
	$voteManager = new VoteManager($pdo);

	$listeCitation = $citationManager->get2CitationsValides();




?>
<h1>Liste des citations déposées</h1>
<p> 
	Actuellement,
	<?php
		echo $citationManager->getNbCitations();
	?>
	 citations sont enregistrées.

</p>

<table>
	<tr>
		<th>Nom de l'enseignant</th>
		<th>Libellé</th>
		<th>Date</th>
		<th>Moyenne des notes</th>
		<?php
		if(estEtudiant()){
		?>
		<th>Noter</th>
		<?php
		}
		?>
	</tr>

	<?php
		foreach ($listeCitation as $citation) {
			$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
	?>
		<tr>
			<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
			<td> <?php echo $citation->getLibelle() ?> </td>
			<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
			<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



			<?php
			if(estEtudiant()){
					if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
			?>
						<td> <img src="./image/erreur.png" alt="Erreur"> </td>
			<?php
					}
					else{
			?>
						<td> <img src="./image/modifier.png" alt="Modifier"> </td>
			<?php
					}
			}
			?>




		</tr>
	<?php
		}
	?>
</table>