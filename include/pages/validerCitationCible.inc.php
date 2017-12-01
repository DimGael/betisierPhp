<?php

	if(isset($_GET['valider'])){
		//Validation de la citation
		$pdo = new Mypdo();
		$citationManager = new CitationManager($pdo);
		if(!$citationManager->valider($_GET['valider'])){
			?>
				<img src="image/erreur.png" alt="Erreur lors de la validation">
				Il y a eu une erreur lors de la validation de la citation.
			<?php
		}
		else{
			?>
				<img src="image/valid.png" alt="Validation effectuée !"/>
				La citation a été validée !
			<?php
		}
		echo "<br>Vous allez être redirigé dans 2 secondes.";
		//Redirection vers la page valider Citation
		redirigerPageNumero(15);
	}
	else if(isset($_GET['supprimer'])){
		//Suppression de la citation
		$pdo = new Mypdo();
		$citationManager = new CitationManager($pdo);

		if(!$citationManager->supprimer($_GET['supprimer'])){
			?>
				<img src="image/erreur.png" alt="Erreur lors de la supressions">
				Il y a eu une erreur lors de la supression de la citation.
			<?php
		}
		else{
			?>
				<img src="image/valid.png" alt="Supression effectuée !"/>
				La citation a été suprimmée !
			<?php
		}
		echo "<br>Vous allez être redirigé dans 2 secondes.";
		//Redirection vers la page valider Citation
		redirigerPageNumero(15);
	}
	else
	{
		redirigerAccueil();
	}


?>