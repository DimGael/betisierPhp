<?php
//Verification si l'utilisateur a le droit d'accéder à cette page
//Pour qu'un utilisateur accède à cette page, il doit juste être connecté
if(isset($_POST['nomPersonne']))
{
	if(!empty($_POST['nomPersonne']) && !empty($_POST['prenomPersonne']) && !empty($_POST['telPersonne']) && !empty($_POST['mailPersonne']) 
		&& !empty($_POST['loginPersonne']) && !empty($_POST['passwordPersonne']) && !empty($_POST['categorie']))
	{
		$pdo = new Mypdo();

		//Il faut vérifier si le login exste déjà
		$personneManager = new PersonneManager($pdo);
		if($personneManager->existeLogin($_POST['loginPersonne']))
		{
			?>
			<h1>Erreur login déjà utilisé</h1>
			<p>
				Le login <?php echo $_POST['loginPersonne']?> est déjà utilisé.
				Redirection automatique dans 2 secondes.
			</p>
			<?php
			redirigerPageNumero(1);
		}
		else{

			$_SESSION['personneAAjouter'] = array(
				'per_nom' => $_POST['nomPersonne'],
				'per_prenom' => $_POST['prenomPersonne'],
				'per_tel' => $_POST['telPersonne'],
				'per_mail' => $_POST['mailPersonne'],
				'per_admin' => 0,
				'per_login' => $_POST['loginPersonne'],
				'per_pwd' => $_POST['passwordPersonne']
			);

			$_SESSION['etudiant'] = $_POST['categorie'] == 'etudiant';

			//Redirection à la page ajouter un étudiant
			redirigerPageNumero(11);
		}
	}
}
else
{
	?>

	<h1>Ajouter une personne</h1>

	<form method="post" action="index.php?page=1">

		Nom : <input type="text" name="nomPersonne" id="nomPersonne" required="true" autofocus="true" /><br><br>
		Prénom : <input type="text" name="prenomPersonne" id="prenomPersonne" required="true" /><br><br>
		Téléphone : <input type="tel" name="telPersonne" id="telPersonne" required="true" /><br><br>
		Mail : <input type="email" name="mailPersonne" id="mailPersonne" required="true" /> <br><br>
		Login : <input type="text" name="loginPersonne" id="loginPersonne" required="true"/><br><br>
		Mot de passe : <input type="password" name="passwordPersonne" id="passwordPersonne" required="true"/><br><br>
		
		Categorie :
	  	<input type="radio" name="categorie" value="etudiant" checked="true"> Etudiant
	  	<input type="radio" name="categorie" value="salarie"> Personnel<br><br>

	  	<input type="submit" value="Valider"/>

	</form>

	<?php
}

?>