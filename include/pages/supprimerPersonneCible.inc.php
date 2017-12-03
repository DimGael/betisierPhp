<?php
if(!isset($_GET['supprimer'])){
	redirigerAccueil();
}

$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);

$personne = $personneManager->getPersonneNumero($_GET['supprimer']);

//Numéro dans l'url est invalide
if(is_null($personne)){
	?>
	<img src="image/erreur.png" alt="Erreur"/> Erreur, la personne à supprimer n'existe pas.
	<br><br>
	Redirection automatique dans 2 secondes.
	<?php
	redirigerAccueil();
}


if($etudiantManager->estEtudiant($_GET['supprimer'])){
	//Supprimer les votes puis suprimer l'étu
	$voteManager = new VoteManager($pdo);
	if(!$voteManager->toutSupprimerNumeroPersonne($_GET['supprimer'])){
		?>
		<img src="image/erreur.png"> Erreur lors de la supression de l'étudiant.
		<?php
		redirigerAccueil();
	}


	if(!$etudiantManager->delete($_GET['supprimer'])){
		?>
		<img src="image/erreur.png"> Erreur lors de la supression de l'étudiant.
		<?php
		redirigerAccueil();
	}
	
}
else{
	//Supprimer les citation puis suprimer le salarie
	$salarieManager = new Salarie($pdo);

	$citationManager = new CitationManager($pdo);
	$citationManager->toutSupprimerNumeroPersonne($_GET['supprimer']);
}

//Puis enfin on suprimme la personne
$personneManager->delete($_GET['supprimer']);
?>

<p>
	<img src="image/valid.png" alt="Réussite"/> Vous avez bien suprimé <?php echo $personne->getPrenom()?> 
	<br><br>
	Redirection automatique dans 2 secondes.
</p>

<?php redirigerAccueil(); ?>