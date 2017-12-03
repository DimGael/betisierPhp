<?php
$pdo = new Mypdo();
$votemanager = new VoteManager($pdo);

$votemanager->add(new Vote(array(
	'cit_num' => $_SESSION['cit'],
	'per_num' => $_SESSION['numPersonneConnecte'],
	'vot_valeur' => $_POST['vote']
)));
?>

<h1> Note affectée! </h1>

	<p>
		Redirection automatique dans 2 secondes.
	</p>
<?php
redirigerAccueil();
?>