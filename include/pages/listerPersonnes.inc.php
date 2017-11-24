<?php
//Affichage des détails d'une personne
		$pdo = new Mypdo();
		if(isset($_GET['personne']) && !empty($_GET['personne']))
	{

		$personneManager = new PersonneManager($pdo);
		$salarieManager = new SalarieManager($pdo);
		$etudiantManager = new EtudiantManager($pdo);

		$personne = $personneManager->getPersonneNumero($_GET['personne']);





		if($etudiantManager->estEtudiant($personne->getNumero())){
			
			$etudiant = $etudiantManager->getEtudiantNumero($personne->getNumero());

			$departementManager = new DepartementManager($pdo);
			$departement = $departementManager->getDepartementNumero($etudiant->getNumeroDepartement());

			$villeManager = new VilleManager($pdo);
			$ville = $villeManager->getVilleNumero($departement->getNumeroVille());
?>

	<h1>Détail sur l'etudiant <?php echo $personne->getNom() ?></h1>

	<table>
		<tr>
			<th>Prénom</th>
			<th>Mail</th>
			<th>Tel</th>
			<th>Département</th>
			<th>Ville</th>
		</tr>

		<tr>
			<td><?php echo $personne->getPrenom() ?></td>
			<td><?php echo $personne->getMail() ?></td>
			<td><?php echo $personne->getTelephone() ?></td>
			<td><?php echo $departement->getNom() ?></td>
			<td><?php echo $ville->getNom()?></td>
		</tr>
	</table>



<?php
		}
		else if($salarieManager->estSalarie($personne->getNumero())){
			$salarie = $salarieManager->getSalarieNumero($personne->getNumero());
			$fonctionManager = new FonctionManager($pdo);
			$fonction = $fonctionManager->getFonctionNumero($salarie->getNumeroFonction());
?>

	<h1>Détail sur le salarié <?php echo $personne->getNom()?></h1>

	<table>
		<tr>
			<th>Prénom</th>
			<th>Mail</th>
			<th>Tel</th>
			<th>TelPro</th>
			<th>Fonction</th>
		</tr>

		<tr>
			<td><?php echo $personne->getPrenom() ?></td>
			<td><?php echo $personne->getMail() ?></td>
			<td><?php echo $personne->getTelephone() ?></td>
			<td><?php echo $salarie->getTelephonePro() ?></td>
			<td><?php echo $fonction->getLibelle() ?></td>
		</tr>
	</table>



<?php
		}
		else{
			echo 'Erreur';
			Header('Location:index.php?page=2');
			exit;
		}
?>









<?php
//Affichage de toutes les personnes
	}
	else
	{

	$personneManager = new PersonneManager($pdo);
	$listePersonnes = $personneManager->getAllPersonnes();
?>


<h1>Liste des personnes enregistrées</h1>
<p>
	Actuellement, <?php echo sizeof($listePersonnes) ?> personnes sont enregistrées.
</p>

<table>

	<tr>
		<th>Numéro</th>
		<th>Nom</th>
		<th>Prénom</th>
	</tr>


	<?php
		foreach ($listePersonnes as $personne) {
	?>
			<tr>
				<td><a href = "index.php?page=2&personne=<?php echo $personne->getNumero(); ?>"><?php echo $personne->getNumero(); ?></a></td>
				<td><?php echo $personne->getNom(); ?></td>
				<td><?php echo $personne->getPrenom(); ?></td>
			</tr>
	<?php
		}
	?>

</table>

<?php
	}
?>
