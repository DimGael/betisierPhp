<h1> Supprimer une citation </h1>

<?php
$_SESSION['cit'] = $_GET['cit'];

		$db = new Mypdo();
		$citationManager = new CitationManager($db);
		
?>

<h2> Voulez-vous vraiment supprimer cette citation? </h2>

<form method="post"  action="index.php?page=27">
	<input type="submit" value="Valider"/>
</form>