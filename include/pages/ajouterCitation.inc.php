<?php
if(pagePourConnectes())
{
	$pdo = new Mypdo();

	if(isset($_POST['citation']) && isset($_POST['enseignant'])){
		//Verifier la citation


		//Ajouter la citation
		$vraiDate = new DateTime(date("d-m-Y H:i:s").' +1 hour');

		new $citationValeurs = array(
			'per_num' => $_POST['Enseignant'],
			'per_num_etu' => $_SESSION['numPersonneConnecte'],
			'cit_libelle' => $_POST['citation'],
			'cit_date' => $_POST['dateCitation'],
			'cit_valide' => 0,
			'cit_date_depo' => $vraiDate
		);

		
	}
	else
	{

		$salarieManager = new SalarieManager($pdo);
		$personneManager = new PersonneManager($pdo);
		$listeProf = $salarieManager->getAllSalarieFonctionLibelle("Enseignant");
		?>
		<h1>Ajouter une citation</h1>

		<form method="post" action="index.php?page=5">

			Enseignant :
			<select name="enseignant">
				<?php

					foreach ($listeProf as $enseignant) {
							$personneEnseignant = $personneManager->getPersonneNumero($enseignant->getNumeroPersonne());

							echo '<option value="'.$enseignant->getNumeroPersonne().'">'.$personneEnseignant->getNom().'</option>';
							echo "\n";
					}
				?>
			</select>

			<br><br>

			Date Citation : <input type="date" required="true" name="dateCitation" id="dateCitation" />

			<br><br>

			Citation : <br>
			<textarea name="citation" id="citation" required="true" rows="4" cols="35" maxlength="256" style="resize:none" placeholder="Ecrire ici la citation que vous voulez ajouter."></textarea>

			<br><br>

			<input type="submit" value="Valider">

		</form>
		<?php
	}
}
?>