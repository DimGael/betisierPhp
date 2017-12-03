<?php 

if(isset($_POST['nomVille']))
{
	if(!empty($_POST['nomVille'])){
		$pdo = new Mypdo();
		$villeManager = new VilleManager($pdo);

		//Vérifier si la ville n'est pas déjà enregistrée
		if($villeManager->nomVilleExisteDeja($_POST['nomVille'])){
			?>
				<img src="image/erreur.png"/>Erreur, la ville existe déjà !
			<?php
			redirigerAccueil();
		}
		else{
			if($villeManager->add($_POST['nomVille'])){
				?>
					<img src="image/valid.png"/> La ville <em>"<?php echo $_POST['nomVille']; ?>"</em> a été ajoutée.
				<?php
				redirigerAccueil();
			}
			else{
				?>
					<img src="image/erreur.png"/>Erreur inconnue lors de l'ajout de la ville.
				<?php
				redirigerAccueil();
			}
		}
	}
}
else{
?>
	<h1>Ajouter une ville</h1>

	<form method="post" action="index.php?page=7">

		Nom : <input type="text" name="nomVille" id="nomVille" required="true" autofocus="true"/>
		<br><br>

		<input type="submit" value="Valider"/>

	</form>
<?php
}
?>