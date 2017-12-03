<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}

	function estConnecte(){
		return isset($_SESSION['prenomPersonneConnecte']);
	}


	function getFrenchDate($date){
		$membres = explode('-', $date);
		$date = $membres[2].'/'.$membres[1].'/'.$membres[0];
		return $date;
	}

	function estAdmin(){
		if(isset($_SESSION['estAdmin']) && !empty($_SESSION['estAdmin']))
			return $_SESSION['estAdmin'];
	}

	//Redirige l'utilisateur à la page choisi
	//$numero : numero de la page sur laquelle rediriger l'utilisateur
	function redirigerPageNumero($numero, $temps){
		header("Refresh:$temps; index.php?page=$numero");
		exit();
	}

	function redirigerAccueil(){
		redirigerPageNumero(0, 2);
	}

	function redirigerConnexion(){
		redirigerPageNumero(11, 2);
	}

	//La méthode pagePourConnecte va renvoyer vrai si l'utilisateur est connecté, sinon elle renvoie faux et redirige l'utilisateur à la page de connexion
	function pagePourConnectes(){
		//Si la personne n'est pas connecté, envoie un message d'erreur et redirige sur la page de connexion
		if(!estConnecte()){
			echo "<h1>Erreur</h1>\n";
			echo "<p>\n";
				echo "<img src=\"image/erreur.png\" alt=\"Erreur\"/>Vous n'avez pas le droit d'accéder à cette page, connectez-vous pour y accéder.\n";
			echo "</p>\n";	

			redirigerConnexion();
			return false;
		}

		//Retourne vrai si l'utilisateur a le droit d'accéder à la page reservé aux connectés
		return true;
	}

	function pagePourEtudiants(){
		if(!estEtudiant()){

			echo "<h1>Erreur</h1>\n";
			echo "<p>\n";
				echo "<img src=\"image/erreur.png\" alt=\"Erreur\"/>Vous n'avez pas le droit d'accéder à cette page, seul les etudiants ont le droit.\n";
			echo "</p>\n";	

			redirigerAccueil();
			return false;
		}

		return true;
	}

	function estEtudiant(){
		if(isset($_SESSION['estEtudiant'])){
			return $_SESSION['estEtudiant'];
		}

		return false;
	}

	function pagePourAdmin(){
		if(!estAdmin()){
			echo "<h1>Erreur</h1>\n";
			echo "<p>\n";
				echo "<img src=\"image/erreur.png\" alt=\"Erreur\"/>Vous n'avez pas le droit d'accéder à cette page.\n";
			echo "</p>\n";	

			redirigerAccueil();
			return false;
		}

		return true;
	}
	
	
?>