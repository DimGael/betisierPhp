<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>

		<!-- PERSONNES -->
		<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
		<ul>

			<li><a href="index.php?page=2">Lister</a></li>	


			<?php
				if (estConnecte()) {
			?>
			<li><a href="index.php?page=1">Ajouter</a></li> 
				<?php
					if(estAdmin())
					{
				?>
					<li><a href="index.php?page=4">Supprimer</a></li>
					<li><a href="index.php?page=17">Modifier</a></li>
			<?php
					}
				}
			?>


		</ul>

		<!-- CITATIONS -->
		<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
		<ul>

			<?php
				if (estConnecte()) {
			?>
			<li><a href="index.php?page=5">Ajouter</a></li> 
			<?php
				}
			?>


			<li><a href="index.php?page=6">Lister</a></li>

			<?php
				if (estConnecte()) {
			?>
			<li><a href="index.php?page=21">Rechercher</a></li>
				<?php
					if(estAdmin()){
				?>
				<li><a href="index.php?page=15">Valider</a></li>
				<li><a href="index.php?page=25">Supprimer</a></li>
			<?php
					}
				}
			?>
		</ul>

		<!-- VILLE -->
		<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
		<ul>


			<li><a href="index.php?page=8">Lister</a></li>

			<?php
				if (estConnecte()) {
			?>
			<li><a href="index.php?page=7">Ajouter</a></li>
				<?php
					if(estAdmin()){
				?>			
					<li><a href="index.php?page=22">Supprimer</a></li>
			<?php
					}
				}
			?>
		</ul>
	</div>
</div>