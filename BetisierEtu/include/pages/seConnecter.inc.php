<?php
if(estConnecte()){
	?>
	<h1>Erreur</h1>
	<p>
		<img src="image/erreur.png" alt="Erreur"> Vous êtes déjà connecté.<br><br>
		Redirection automatique dans 2 secondes.
	</p>
	<?php
	redirigerAccueil();
}
else
{
?>
<h1>Pour Vous Connecter</h1>

<?php
	$additionCorrect = false;

	if(isset($_SESSION['nbRandom1']) && isset($_POST['resultatAddition']))
	{
		$additionCorrect =  $_SESSION['nbRandom1'] + $_SESSION['nbRandom2'] == $_POST['resultatAddition'];
		unset($_SESSION['nbRandom1']);
		unset($_SESSION['nbRandom2']);
	}
	else{
		$additionCorrect = false;
	}

	if($additionCorrect && isset($_POST['login']) && isset($_POST['mdp']))
	{
		$pdo = new Mypdo();
		// ----------- Vérifier les login
		// ------- Vérifier si le nom d'utilisateur existe
		$personneManager = new PersonneManager($pdo);
		$etudiantManager = new EtudiantManager($pdo);

		if(!$personneManager->existeLogin($_POST['login'])){
			header("Location:index.php?page=9&loginIncorrect=1");
			exit();
		}

		// ------- Vérifier si le login et le mdp correspondent
		// --- Récupération de la personne dans une variable Personne
		$personne = $personneManager->getPersonneLogin($_POST['login']);

		if(!$personne->estValideMdp($_POST['mdp'])){
			header("Location:index.php?page=9&mdpIncorrect=1");
			exit();	
		}

		// ----------- Connecter la personne
		// ------- Connexion
		$_SESSION['prenomPersonneConnecte'] = $personne->getPrenom();
		$_SESSION['estAdmin'] = $personne->getAdmin();

		// ------- Affichage de la connexion et de la redirection
		?>
		<img src="image/valid.png"/> Vous avez bien été connecté !<br><br>
		Redirection automatique dans 2 secondes.

		<?php
		redirigerAccueil();

	}
	else
	{
		?>

<form method="post" action="index.php?page=9">
	Nom d'utilisateur : <input type="text" name="login" id="login" autofocus="true" required="true" />
	<br>
	<?php
		if(isset($_GET['loginIncorrect']))
		{
			?>
			<img src="image/erreur.png"/> Votre login n'existe pas.
			<?php
		}
	?>
	<br>


	Mot de passe : <input type="password" name="mdp" id="mdp" required="true" />
	<br>
	<?php
		if(isset($_GET['mdpIncorrect']))
		{
			?>
			<img src="image/erreur.png"/> Votre login est correct mais le mot de passe ne correspond pas.
			<?php
		}
	?>
	<br>

	<?php
		$_SESSION['nbRandom1'] = rand()%9+1;
		$_SESSION['nbRandom2'] = rand()%9+1;
	?>

	<img src="image/nb/<?php echo $_SESSION['nbRandom1'] ?>"/> + <img src="image/nb/<?php echo $_SESSION['nbRandom2'] ?>"/> = <input type="text" name="resultatAddition" id="resultatAddition" placeholder="Résultat de l'addition" /> <br>

	<?php
	if((!$additionCorrect || empty($_POST['resultatAddition'])) && isset($_POST['resultatAddition']))
	{
		echo '<img src="image/erreur.png"/>';

		if(empty($_POST['resultatAddition']))
			echo " Vous n'avez rien saisi, saisissez le résultat.";
		else
			echo " Le résultat que vous avez saisi n'était pas correct";

		 echo '<br>';
	}

	?>

	<input type="submit" value="Valider" />
</form>

<?php
	}
}
?>