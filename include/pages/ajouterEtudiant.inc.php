<?php
$pdo = new Mypdo();

//------ AJOUT DU SALARIE ET DE LA PERSONNE
if(isset($_POST['annee']) && isset($_POST['departement']) && isset($_SESSION['personneAAjouter'])){
	//Ajouter la personne et ajouter l'étudiant ou le salarié
	$personneManager = new PersonneManager($pdo);
	if(!$personneManager->add(new Personne($_SESSION['personneAAjouter'])))
	{
		//Erreur lors de l'insertion de la personne
	 	?>
	 		<img src="image/erreur.png" alt="Erreur">Erreur lors de l'insertion de l'étudiant
	 	<?php
			redirigerAccueil();
	}
	else
	{
		//Réussite lors de l'insertion de la personne
		$numPersonneAjoutee = $personneManager->getDernierePersonneAjoutee()->getNumero();

		$etudiantManager = new EtudiantManager($pdo);

		 if(!$etudiantManager->add(new Etudiant(array(
			'per_num' => $numPersonneAjoutee,
			'div_num' => $_POST['annee'],
			'dep_num' => $_POST['departement']
			))))
		 {
		 	//Erreur lors de l'insertion de l'étudiant
			//Supprimer la personne ajoutée avant
		 	
		 	?>
		 		<img src="image/erreur.png" alt="Erreur">Erreur lors de l'insertion de l'étudiant
		 	<?php
			redirigerAccueil();
		 }
		 else{
		 	//Réussite lors de l'insertion de l'étudiant
		 	?>
		 		<img src="image/valid.png" alt="Réussite de l'insertion"> L'étudiant a été ajouté !
		 	<?php
		 	redirigerAccueil();
		}
	}

	unset($_SESSION['personneAAjouter']);
	unset($_SESSION['etudiant']);
}


//------ AFFICHAGE DU FORMULAIRE AJOUTER UN ETUDIANT
else if(isset($_SESSION['personneAAjouter']) && isset($_SESSION['etudiant'])){
	if($_SESSION['etudiant']){
		//Si la personne à ajouter est un étudiant
		$divisionManager = new DivisionManager($pdo);
		$departementManager = new DepartementManager($pdo);
		$villeManager = new VilleManager($pdo);
		?>

		<h1>Ajouter un etudiant</h1>

		<form method="post" action="index.php?page=11">
			Année :
			<select name="annee">
				<?php
					//Afficher toutes les divisions
				$listeDivisions = $divisionManager->getAllDivisions();

				foreach ($listeDivisions as $division) {
					echo '<option value="'.$division->getNumero().'">'.$division->getNom().'</option>';
					echo "\n";
				}
				?>
				
			</select><br><br>

			Département :
			<select name="departement">
				<?php
				//Afficher tous les départements
				$listeDepartements = $departementManager->getAllDepartements();
				foreach ($listeDepartements as $departement) {
					echo '<option value="'.$departement->getNumero().'">'.$departement->getNom().' ('.$villeManager->getVilleNumero($departement->getNumeroVille())->getNom().')</option>';
					echo "\n";
				}
				?>
			</select>
			<br><br>

			<input type="submit" value="Valider"/>
		</form>
		<?php
	}
	else
	{
		//Si l'utilisateur voulait rajouter un salarié, le redirige vers l'ajout de salarié
		Header("Location:index.php?page=12");
		exit();
	}

}



// --- SI L'UTILISATEUR PASSE PAR L'URL SANS AVOIR RIEN REMPLI
else{
	redirigerAccueil();
}

?>