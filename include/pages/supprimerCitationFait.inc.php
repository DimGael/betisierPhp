<?php
$pdo = new Mypdo();
$citationmanager = new CitationManager($pdo);

$citationmanager-> supprimerCitation($_SESSION['cit']);
?>

<h1> Citation supprimée </h1>

	<p>
		Redirection automatique dans 2 secondes.
	</p>
<?php
redirigerAccueil();
?>