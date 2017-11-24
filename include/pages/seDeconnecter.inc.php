<?php
if(!estConnecte()){
	redirigerConnexion();
}

else{
	session_destroy();
?>
	<img src="image/valid.png"/> Vous avez bien été déconnecté !<br><br>
		Redirection automatique dans 2 secondes.


<?php
	redirigerAccueil();
}
?>
