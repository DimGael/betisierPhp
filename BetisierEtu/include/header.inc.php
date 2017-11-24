<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
 
</head>
	<body>
	<div id="header">
		<div id="connect">

			<?php
				if(!estConnecte())
				{
			?>
			<a href="index.php?page=9">Connexion</a>
			<?php
				}
				else
				{
					?>
						<a href="index.php?page=10">Utilisateur : <?php echo $_SESSION['prenomPersonneConnecte']?> Déconnexion</a>
					<?php
				}

			?>
		</div>	
		<div id="entete">
			<div id="logo">
				<img id="imLogo" src="image/lebetisier.gif"/>
			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
	