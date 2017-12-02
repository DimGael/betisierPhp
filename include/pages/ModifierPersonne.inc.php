<?php 
// Si le formulaire n'a pas été rempli
if(!isset($_POST['categorie']) && !isset($_POST['nom'])){

	//S'il n'y a personne a modifier, redirige l'utilisateur à l'accueil
	if(!isset($_GET['modif'])){
		redirigerAccueil();
	}

	$pdo = new Mypdo();
	$personneManager = new PersonneManager($pdo);
	$etudiantManager = new EtudiantManager($pdo);

	$personne = $personneManager->getPersonneNumero($_GET['modif']);
	//Si le numéro de la personne n'est pas valide, renvoie l'utilisateur à l'accueil
	if(is_null($personne)){
		redirigerAccueil();
	}

	$estEtudiant = $etudiantManager->estEtudiant($personne->getNumero());
	$_SESSION['numPersonneModif'] = $_GET['modif'];
	?>

	<h1>Modifier une personne</h1>

	<form method="post" action="index.php?page=18">

		Nom : <input type="text" name="nom" id="nom" required="true" autofocus="true" 
		value="<?php echo $personne->getNom(); ?>"/><br><br>

		Prénom : <input type="text" name="prenom" id="prenom" required="true" 
		value="<?php echo $personne->getPrenom(); ?>"/><br><br>

		Téléphone : <input type="tel" name="tel" id="tel" required="true" 
		value="<?php echo $personne->getTelephone(); ?>"/><br><br>

		Mail : <input type="email" name="mail" id="mail" required="true" 
		value="<?php echo $personne->getMail(); ?>"/> <br><br>

		Login : <input type="text" name="login" id="login" required="true"
		value="<?php echo $personne->getLogin(); ?>"/><br><br>

		Mot de passe : <input type="password" name="password" id="password"
		placeholder="Ne sera pas modifié" title="Laissez vide pour ne pas modifier"/><br><br>
		
		Categorie :
	  	<input type="radio" name="categorie" value="etudiant" <?php if($estEtudiant){ echo 'checked="true"'; } ?>"> Etudiant
	  	<input type="radio" name="categorie" value="salarie"<?php if(!$estEtudiant){ echo 'checked = "true"'; } ?>> Personnel<br><br>

	  	<input type="submit" value="Valider"/>

	</form>

	<?php
	}
//Si le formulaire a été rempli et que la personne est valide
else if (isset($_SESSION['numPersonneModif'])){

	$pdo = new Mypdo();
	$personneManager = new PersonneManager($pdo);
	$etudiantManager = new EtudiantManager($pdo);

	//Pour vérifier si la personne est de base un étudiant
	$_SESSION['etaitEtudiantModif'] = $etudiantManager->estEtudiant($_SESSION['numPersonneModif']);

	$personne = $personneManager->getPersonneNumero($_SESSION['numPersonneModif']);

	//Si le mot de passe n'a pas été modifié, le hash comme il se doit, sinon on le laisse tel quel
	if(empty($_POST['password']))
		$password = $personne->getPassword();
	else
		$password = $personne->hashPassword($_POST['password']);

	$_SESSION['personneAModifier'] = array(
				'per_num' => $_SESSION['numPersonneModif'],
				'per_nom' => $_POST['nom'],
				'per_prenom' => $_POST['prenom'],
				'per_tel' => $_POST['tel'],
				'per_mail' => $_POST['mail'],
				'per_admin' => 0,
				'per_login' => $_POST['login'],
				'per_pwd' => $password
			);

	//Redirection vers la page modifierEtudiant.inc.php
	if($_POST['categorie'] == 'etudiant')
		redirigerPageNumero(19,0);
	//Redirection vers la page modifierSalarie.inc.php
	else
		redirigerPageNumero(20,0);

}
else{
	redirigerAccueil();
}