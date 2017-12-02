<?php
// Si le formulaire n'a pas été rempli
if(!isset($_POST['annee']) || !isset($_POST['departement'])){

	$pdo = new Mypdo();
	$etudiantManager = new EtudiantManager($pdo);

	$estEtudiant = false;

	if($etudiantManager->estEtudiant($_SESSION['personneAModifier']['per_num'])){
		$etudiant = $etudiantManager->getEtudiantNumero($_SESSION['personneAModifier']['per_num']);
		$estEtudiant = true;
	}
	$divisionManager = new DivisionManager($pdo);
	$departementManager = new DepartementManager($pdo);

	?>

	<h1>Modifier un étudiant</h1>
	<form method="post" action="index.php?page=19">
		Année :
		<select name="annee">
			<?php
			if($estEtudiant){
				//Afficher la division de l'etudiant
				echo '<option value="'.$divisionManager->getDivisionNumero($etudiant->getNumeroDivision())->getNumero().'">'.$divisionManager->getDivisionNumero($etudiant->getNumeroDivision())->getNom().'</option>';
				echo "\n";
			}

			//Afficher toutes les divisions sauf celle de l'étudiant
			$listeDivisions = $divisionManager->getAllDivisions();

			foreach ($listeDivisions as $division) {
				if($etudiant->getNumeroDivision() != $division->getNumero())
				{
					echo '<option value="'.$division->getNumero().'">'.$division->getNom().'</option>';
					echo "\n";
				}
			}
			?>
			
		</select><br><br>

		Département :
		<select name="departement">
			<?php
			if($estEtudiant){
				echo '<option value="'.$departementManager->getDepartementNumero($etudiant->getNumeroDepartement())->getNumero().'">'.$departementManager->getDepartementNumero($etudiant->getNumeroDepartement())->getNom().'</option>';
				echo "\n";
			}


			//Afficher tous les départements sauf celui de l'étudiant
			$listeDepartements = $departementManager->getAllDepartements();
			foreach ($listeDepartements as $departement) {
				if($etudiant->getNumeroDepartement() != $departement->getNumero())
				{
					echo '<option value="'.$departement->getNumero().'">'.$departement->getNom().'</option>';
					echo "\n";
				}
			}
			?>
		</select>
		<br><br>

		<input type="submit" value="Valider"/>
	</form>

	<?php 
}

//Si le formulaire a été rempli et que l'utilisateur ne vient pas avec l'url
else if(isset($_SESSION['personneAModifier'])){
	$pdo = new Mypdo();
	$personneManager = new PersonneManager($pdo);


	//Modifier la personne
	$personneAModif = new Personne($_SESSION['personneAModifier']);
	unset($_SESSION['personneAModifier']);

	if(!$personneManager->update($personneAModif)){
		//Erreur lors de la modification de la personne
			?>
		 		<img src="image/erreur.png" alt="Erreur">Erreur lors de la modification du salarié
		 	<?php
			redirigerAccueil();
	}

	$etudiantManager = new EtudiantManager($pdo);

	//Modifier ou créer un nouvel étudiant
	$etaitEtu = true;

	//Si la personne était un salarié (n'était pas un étudiant), supprimer toutes ses citations, puis supprimer l'etudiant
	if(!$etudiantManager->estEtudiant($personneAModif->getNumero())){
		$etaitEtu = false;
		$citationManager = new CitationManager($pdo);
		$salarieManager = new SalarieManager($pdo);

		if(!$citationManager->toutSupprimerNumeroPersonne($personneAModif->getNumero())){
			//Erreur lors de la suppression des citations
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de la supression de l'ancien salarié.
			<?php
			redirigerAccueil();
		}
		if(!$salarieManager->delete($personneAModif->getNumero())){
			//Erreur lors de la suppression du salarie
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de la supression de l'ancien salarié.
			<?php
			redirigerAccueil();
		}
	}


	//Si c'était un salarié, créer un nouvel étudiant
	if(!$etaitEtu){
		if(!$etudiantManager->add(new Etudiant(array(
			'per_num' => $personneAModif->getNumero(),
			'dep_num' => $_POST['departement'],
			'div_num' => $_POST['annee']
		)))){
			//S'il y a eu erreur lors de l'insertion
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de l'ajout du nouvel etudiant.
			<?php
			redirigerAccueil();
		}
	}
	//Sinon update le salarié
	else{
		if(!$etudiantManager->update(new Etudiant(array(
			'per_num' => $personneAModif->getNumero(),
			'dep_num' => $_POST['departement'],
			'div_num' => $_POST['annee']
		)))){
			//S'il y a eu erreur lors de la modification
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de la modification de l'etudiant.
			<?php
			redirigerAccueil();
		}
	}

	?>
	<img src="image/valid.png" alt="Succés"> La personne a été modifiée ! <br><br>Redirection automatique dans 2 secondes.
	<?php
	redirigerAccueil();

}
//Si l'utilisateur est venue avec l'url
else{
		redirigerAccueil();
}
?>