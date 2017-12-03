<?php
$pdo = new Mypdo();

if(isset($_SESSION['personneAAjouter']) && isset($_POST['telPro']) && isset($_POST['fonction']))
{
	//Ajouter la personne et ajouter le salarié
	$personneManager = new PersonneManager($pdo);

	//Suppression de la variable de session
	$personneAjouter = $_SESSION['personneAAjouter'];
	unset($_SESSION['personneAAjouter']);


	if(!$personneManager->add(new Personne($personneAjouter)))
	{
		//Erreur lors de l'insertion de la personne
	 	?>
	 		<img src="image/erreur.png" alt="Erreur">Erreur lors de l'insertion du salarié
	 	<?php
			redirigerAccueil();
	}
	else
	{
		//Réussite lors de l'insertion de la personne
		$numPersonneAjoutee = $personneManager->getDernierePersonneAjoutee()->getNumero();

		$salarieManager = new SalarieManager($pdo);
		if(!$salarieManager->add(new Salarie(array(
			'per_num' => $numPersonneAjoutee,
			'sal_telprof' => $_POST['telPro'],
			'fon_num' => $_POST['fonction']
		)))){
			//Erreur lors de l'insertion du salarié
			$personneManager->delete($numPersonneAjoutee);
			?>
		 		<img src="image/erreur.png" alt="Erreur">Erreur lors de l'insertion du salarié
		 	<?php
			redirigerAccueil();
		}
		else{
			//Réussite lors de l'insertion du salarié
			?>
		 		<img src="image/valid.png" alt="Réussite de l'insertion"> Le salarié a été ajouté !
			<?php
			redirigerAccueil();

		}
	}
}
else if(isset($_SESSION['personneAAjouter']) && isset($_SESSION['etudiant'])){
	if($_SESSION['etudiant']){
		//Redirection vers la page ajouter Etudiant
		redirigerPageNumero(12);
	}
	else
	{
		?>
		<h1>Ajouter un salarié</h1>

		<form method="post" action="index.php?page=12">
			Téléphone professionnel : <input type="tel" required="true" name="telPro" id="telPro"/><br><br>

			Fonction :
			<select name="fonction" id="fonction">
				<?php
					$fonctionManager = new FonctionManager($pdo);
					$listeFonctions = $fonctionManager->getAllFonctions();
					foreach ($listeFonctions as $fonction) {
						echo '<option value="'.$fonction->getNumero().'"">'.$fonction->getLibelle().'</option>';
						echo "\n";
					}
				?>
			</select><br><br>

			<input type="submit" value="Valider">
		</form>
		<?php
	}
}
else{

	redirigerAccueil();
}

?>