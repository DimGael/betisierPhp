<?php
$_SESSION['cit'] = $_GET['cit'];
?>

<h1> Votez pour cette citation </h1>


<form method="post" action="index.php?page=14">
	Note (entre 0 et 20) : <input type ="number" name="vote" id="vote" min="0" max="20" required="true" autofocus="true"><br><br>

	<input type="submit" value="Valider"/>
</form>





