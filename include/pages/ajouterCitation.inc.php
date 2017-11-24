<?php
if(pagePourConnectes())
{
	if(isset($_))
	?>
	<h1>Ajouter une citation</h1>

	<form method="post" action="index.php?page=5">

		Enseignant :
		<SELECT>
			<?php

			?>
		</SELECT>

		<br><br>

		Date Citation : <input type="date" required="true" name="dateCitation" id="dateCitation" placeholder="xx/xx/xx" />

		<br><br>

		Citation : <br>
		<textarea name="citation" id="citation" required="true" rows="4" cols="35" maxlength="256" style="resize:none" placeholder="Ecrire ici la citation que vous voulez ajouter."></textarea>

		<br><br>

		<input type="submit" value="Valider">

	</form>
	<?php
}
?>