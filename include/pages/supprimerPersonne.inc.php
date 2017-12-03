<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonnes = $personneManager->getAllPersonnes();
?>

<h1>Supprimer des personnes enregistrées</h1>
<p>
	Actuellement, <?php echo sizeof($listePersonnes) ?> personnes sont enregistrées.
</p>

<table>

	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Supprimer</th>
	</tr>

	<?php
		foreach ($listePersonnes as $personne) {
	?>
			<tr>
				<td><?php echo $personne->getNom(); ?></td>
				<td><?php echo $personne->getPrenom(); ?></td>
				<td><a href="index.php?page=28&supprimer=<?php echo $personne->getNumero(); ?>"><img src="image/erreur.png" alt="suprimmer" title="Cliquez pour suprimmer"/></a></td>
			</tr>
	<?php
		}
	?>

</table>	