<?php
//Faire en sorte que seul un étudiant puisse accéder à cette page
$pdo = new Mypdo();

if(isset($_POST['citation']) && isset($_POST['enseignant'])){
	//Verifier la citation
	$motManager = new MotManager($pdo);

	$libelleArray = explode(" ", $_POST['citation']);
	$listeMotsInterdits = array();

	foreach ($libelleArray as $mot) {
		if(!is_null($motManager->verifMot($mot))){
			$listeMotsInterdits[] = $mot;
		}
	}


	if(empty($listeMotsInterdits)){
		//Ajouter la citation
		$vraiDate = new DateTime(date("d-m-Y H:i:s").' +1 hour');

		$citationValeurs = array(
			'per_num' => $_POST['enseignant'],
			'per_num_etu' => $_SESSION['numPersonneConnecte'],
			'cit_libelle' => htmlspecialchars($_POST['citation']),
			'cit_date' => $_POST['dateCitation'],
			'cit_date_depo' => $vraiDate->format("Y-m-d H:i:s")
		);

		$citationManager = new CitationManager($pdo);

		$citation = new Citation($citationValeurs);


		//Enregistrement de la citation
		if(!$citationManager->add($citation)){
			//Echec lors de l'insertion de la Citation
			?>
			<img src="image/valid.png"/> Erreur lors de l'ajout de la citation.
			Redirection automatique dans 2 secondes.
			<?php
			redirigerAccueil();
		}
		else{
			//Succés lors de l'insertion de la citation
			?>
				<img src="image/valid.png"/>La citation a été rajoutée, elle sera affichée lorsqu'elle aura été validé par un administrateur.
				Redirection automatique dans 2 secondes.
			<?php
			redirigerAccueil();

		}
	}

	
}

$salarieManager = new SalarieManager($pdo);
$personneManager = new PersonneManager($pdo);
$listeSalarie = $salarieManager->getAllSalarie();
?>
<h1>Ajouter une citation</h1>

<form method="post" action="index.php?page=5">

	Enseignant :
	<select name="enseignant">
		<?php

			foreach ($listeSalarie as $enseignant) {
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
	<textarea name="citation" id="citation" required="true" rows="4" cols="35" maxlength="256" style="resize:none" placeholder="Ecrire ici la citation que vous voulez ajouter."><?php

		if(!empty($listeMotsInterdits)){
				$motInterdit = 0;
			foreach ($libelleArray as $mot) {
				if($mot == $listeMotsInterdits[$motInterdit]){
					$motInterdit++;
					echo '--- ';
				}
				else
					echo "$mot ";
			}
		}
	?></textarea>

	<br><br>
		<?php
			if(!empty($listeMotsInterdits)){
				echo "<p>\n";
				foreach ($listeMotsInterdits as $motInterdit) {
					echo "\t\t\t<img src=\"image/erreur.png\"/> Le mot '<em>$motInterdit</em>' n'est pas autorisé.";
					echo "<br>\n";
				}
				echo "\t\t</p>\n";
				echo "<br><br>\n\n";
			}
		?>

	<input type="submit" value="Valider">

</form>
<?php
?>