<?php
// Si le formulaire n'a pas été rempli
if(!isset($_POST['annee']) && !isset($_POST['departement'])){

	$pdo = new Mypdo(); 
	?>

	<h1>Modifier un étudiant</h1>
	<form method="post" action="index.php?page=11">
		Année :
		<select name="annee">
			<?php
				//Afficher toutes les divisions
			$divisionManager = new DivisionManager($pdo);
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
			$departementManager = new DepartementManager($pdo);
			$listeDepartements = $departementManager->getAllDepartements();
			foreach ($listeDepartements as $departement) {
				echo '<option value="'.$departement->getNumero().'">'.$departement->getNom().'</option>';
				echo "\n";
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

}
//Si l'utilisateur est venue avec l'url
else{
		redirigerAccueil();
}
?>