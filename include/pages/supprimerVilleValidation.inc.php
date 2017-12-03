<h1> Supprimer une ville </h1>

<?php
$_SESSION['vil'] = $_GET['vil'];

		$db = new Mypdo();
		$villeManager = new VilleManager($db);
		$nomVille = $villeManager->getVilleNom($_SESSION['vil']);
?>

<h2> Voulez-vous vraiment supprimer <?php echo $nomVille->getNom(); ?> ?</h2>

<form method="post"  action="index.php?page=24">
	<input type="submit" value="Valider"/>
</form>