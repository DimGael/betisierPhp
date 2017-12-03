<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonnes = $personneManager->getAllPersonnes();
?>

<h1>Modifier une personne enregistrée</h1>
<p>
	Actuellement, <?php echo sizeof($listePersonnes) ?> personnes sont enregistrées.
</p>

<table>

	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Modifier</th>
	</tr>


	<?php
		foreach ($listePersonnes as $personne) {
	?>
			<tr>
				<td><?php echo $personne->getNom(); ?></td>
				<td><?php echo $personne->getPrenom(); ?></td>
				<td><a href="index.php?page=18&modif=<?php echo $personne->getNumero(); ?>"><img src="image/modifier.png" alt="Modifier" title="Cliquez pour modifier"/></a></td>
			</tr>
	<?php
		}
	?>

</table>