<?php 
//Si la personne a rempli le formulaire
if(isset($_POST['telPro']) && isset($_SESSION['personneAModifier'])){
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

	//Modifier ou créer un nouveau Salarie

	$etaitEtu = false;
	//Si la personne était un étudiant, supprimer tous ses votes, puis supprimer l'etudiant
	if($_SESSION['etaitEtudiantModif']){
		$etaitEtu = true;
		$etudiantManager = new EtudiantManager($pdo);
		$voteManager = new VoteManager($pdo);

		if(!$voteManager->toutSupprimerNumeroPersonne($personneAModif->getNumero())){
			//Erreur lors de la suppression des votes
			unset($_SESSION['etaitEtudiantModif']);
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de la supression de l'ancien étudiant.
			<?php
			redirigerAccueil();
		}	
		if(!$etudiantManager->delete($personneAModif->getNumero())){
			//Erreur lors de la suppression de l'étudiant
			unset($_SESSION['etaitEtudiantModif']);
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de la supression de l'ancien étudiant.
			<?php
			redirigerAccueil();
		}
	}
	unset($_SESSION['etaitEtudiantModif']);


	$salarieManager = new SalarieManager($pdo);

	//Si c'était un étudiant, créer un nouveau salarié
	if($etaitEtu){
		if(!$salarieManager->add(new Salarie(array(
			'per_num' => $personneAModif->getNumero(),
			'sal_telprof' => $_POST['telPro'],
			'fon_num' => $_POST['fonction']
		)))){
			//S'il y a eu erreur lors de l'insertion
			?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de l'ajout du nouveau salarie.
			<?php
			redirigerAccueil();
		}
	}
	//Sinon update un salarie
	else{
		if(!$salarieManager->update(new Salarie(array(
			'per_num' => $personneAModif->getNumero(),
			'sal_telprof' => $_POST['telPro'],
			'fon_num' => $_POST['fonction']
		)))){
			//S'il y a eu erreur lors de la modification?>
				<img src="image/erreur.png" alt="Erreur"> Erreur lors de la modification du salarie.
			<?php
			redirigerAccueil();

		}
	}

	?>
	<img src="image/valid.png" alt="Succés"> La personne a été modifiée ! <br><br>Redirection automatique dans 2 secondes.
	<?php
	redirigerAccueil();

}
//Si la personne est venu avec l'URL
else if(!isset($_SESSION['personneAModifier'])){
		redirigerAccueil();
}
else
{
	

	$pdo = new Mypdo();
	$salarieManager = new SalarieManager($pdo);
	$fonctionManager = new FonctionManager($pdo);

	$estSalarie = false;

	if($salarieManager->estSalarie($_SESSION['personneAModifier']['per_num'])){
		$salarie = $salarieManager->getSalarieNumero($_SESSION['personneAModifier']['per_num']);
		$estSalarie = true;
	}


	?>

	<h1>Modifier un Salarié</h1>


	<form method="post" action="index.php?page=20">
		Téléphone professionnel : <input type="tel" required="true" name="telPro" id="telPro"
		<?php if($estSalarie){echo 'value="'.$salarie->getTelephonePro().'"';} ?>/><br><br>

		Fonction :
		<select name="fonction" id="fonction">
			<?php 
				//Si c'est un salarie, affiche sa fonction en premier
				if($estSalarie){
					echo '<option value="'.$salarie->getNumeroFonction().'">'.$fonctionManager->getFonctionNumero($salarie->getNumeroFonction())->getLibelle().'</option>';
				}
			?>
			<?php
				$listeFonctions = $fonctionManager->getAllFonctions();
				foreach ($listeFonctions as $fonction) {
					//Si ce n'est pas un salarié, affiche toutes les fonctions
					if(!$estSalarie){
						echo '<option value="'.$fonction->getNumero().'">'.$fonction->getLibelle().'</option>';
						echo "\n";					
					}
					//Si c'est un salarie et que la fonction n'est pas la sienne
					else if(!($fonction->getNumero() == $salarie->getNumeroFonction())){
						echo '<option value="'.$fonction->getNumero().'">'.$fonction->getLibelle().'</option>';
						echo "\n";		
					}
				}
			?>
		</select><br><br>

		<input type="submit" value="Valider">
	</form>

<?php
}

?>
