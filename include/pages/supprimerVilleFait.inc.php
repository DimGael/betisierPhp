<?php
$pdo = new Mypdo();
$villemanager = new VilleManager($pdo);

$villemanager-> supprimerVille($_SESSION['vil']);
?>

<h1> Ville supprimée </h1>

	<p>
		Redirection automatique dans 2 secondes.
	</p>
<?php
redirigerAccueil();
?>