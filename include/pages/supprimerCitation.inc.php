<h1> Supprimer Citation </h1>

<?php


	$pdo = new Mypdo();
	$citationManager = new CitationManager($pdo);
	$personneManager = new PersonneManager($pdo);
	$voteManager = new VoteManager($pdo);

	$listeCitation = $citationManager->getAllCitationsValides();




?>

<table>
	<tr>
		<th>Nom de l'enseignant</th>
		<th>Libellé</th>
		<th>Date</th>
		<th>Moyenne des notes</th>
		<th>Supprimer</th>

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

				<td> <a href = "index.php?page=26&cit=<?php echo $citation->getNumero();?>"><img src="./image/erreur.png" alt="Erreur"> </td>
			</tr>
		<?php
			}
	?>
</table>