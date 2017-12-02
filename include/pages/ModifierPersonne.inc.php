<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonnes = $personneManager->getAllPersonnes();
?>

<h1>Modifier une personne enregistrées</h1>
<p>
	Actuellement, <?php echo sizeof($listePersonnes) ?> personnes sont enregistrées.
</p>

<table>

	<tr>
		<th>Numéro</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Modifier</th>
	</tr>


	<?php
		foreach ($listePersonnes as $personne) {
	?>
			<tr>
				<td><a href = "index.php?page=2&personne=<?php echo $personne->getNumero(); ?>"><?php echo $personne->getNumero(); ?></a></td>
				<td><?php echo $personne->getNom(); ?></td>
				<td><?php echo $personne->getPrenom(); ?></td>
				<td><a href="#"><img src="image/modifier.png" alt="Modifier" title="Cliquez pour modifier"/></a></td>
			</tr>
	<?php
		}
	?>

</table>