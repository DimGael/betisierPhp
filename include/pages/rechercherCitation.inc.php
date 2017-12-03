<h1> Rechercher une citation </h1> 
<?php
	$pdo = new Mypdo();
	$citationManager = new CitationManager($pdo);
	$personneManager = new PersonneManager($pdo);
	$voteManager = new VoteManager($pdo);

	if((!empty($_POST['nom'])) || (!empty($_POST['date'])) || (!empty($_POST['note']))){ //Test pour savoir si au moins une des valeurs est vraie

		if((!empty($_POST['nom'])) && (!empty($_POST['date'])) && (!empty($_POST['note']))){ //Test pour savoir si les trois champs sont remplis
			$listeCitation = $citationManager->rechercheParTout($_POST['nom'], $_POST['date'], $_POST['note']);
							if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{
						?>
							<table>
								<tr>
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>
									<?php
										}
									?>
								</tr>
							</table>
							<?php
								}
		}
		else{
			if((!empty($_POST['nom'])) && (!empty($_POST['date']))){ //Test pour savoir si nom et date sont remplis

				$listeCitation = $citationManager->rechercheParNomEtDate($_POST['nom'], $_POST['date']);
							if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{
						?>
							<table>
								<tr>
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>

									<?php
										}
									?>
								</tr>
							</table>
						<?php
							}
						}

			
			else{
				if((!empty($_POST['nom'])) && (!empty($_POST['note']))){ //Test pour savoir si nom et date sont remplis
				$listeCitation = $citationManager->rechercheParNomEtNote($_POST['nom'], $_POST['note']);  
					if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{
						?>
							<table>
								<tr>
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>
									<?php
										}
									?>
								</tr>
							</table>
							<?php
								}
				}
				else{
					if((!empty($_POST['note'])) && (!empty($_POST['date']))){ //Test pour savoir si note et date sont remplis
						$listeCitation = $citationManager->rechercheParDateEtNote($_POST['date'], $_POST['note']);  
						if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{
						?>
							<table>
								<tr>
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>
									<?php
										}
									?>
								</tr>
							</table>
							<?php
								}
					}
					else{
						if((!empty($_POST['nom']))){ //Si nom est rempli
							$listeCitation = $citationManager->rechercheParNom($_POST['nom']);
							if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{
						?>
							<table>
								<tr>
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>

									<?php
										}
									?>
								</tr>
							</table>
						<?php
							}
						}
						if((!empty($_POST['date']))){ //Si date est rempli
							$listeCitation = $citationManager->rechercheParDate($_POST['date']);
							if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{
						?>
							<table>
								<tr>
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>
									<?php
										}
									?>
								</tr>
							</table>
							<?php
								}
						}
						
						if((!empty($_POST['note']))){ //Si note est rempli
							$listeCitation = $citationManager->rechercheParNote($_POST['note']);
							if($listeCitation == null){
								echo "Pas de résultats à afficher";
							}
							else{

						?>
							<table>
								<tr> 
									<th>Nom de l'enseignant</th>
									<th>Libellé</th>
									<th>Date</th>
									<th>Moyenne des notes</th>
									<?php
										foreach ($listeCitation as $citation) {
											$personne = $personneManager->getPersonneNumero($citation->getNumeroPersonne());
									?>
										<tr>
											<td> <?php echo $personne->getPrenom().' '.$personne->getNom(); ?> </td>
											<td> <?php echo $citation->getLibelle() ?> </td>
											<td> <?php echo getFrenchDate($citation->getDate()) ?> </td>
											<td> <?php echo $voteManager->getMoyenneVotesCitation($citation->getNumero()) ?> </td>



											<?php
											if(estEtudiant()){
													if($voteManager->aVote($_SESSION['numPersonneConnecte'], $citation->getNumero())){
											?>
														<td> <img src="./image/erreur.png" alt="Erreur"> </td>
											<?php
													}
													else{
											?>
														<td> <a href = "index.php?page=13&cit=<?php echo $citation->getNumero();?>"><img src="./image/modifier.png" alt="Modifier"></a> </td>
											<?php
													}
											}
										?>
										</tr>
									<?php
										}
									?>
									</tr>
								</table>
								<?php
								}
							}
						}
					}
				}
			}
		}
	
	else{
?>



<form method="post" action="#">
	Nom de l'enseignant : <input type="text" name="nom" id="nom"/><br>
	Date : <input type="date" name="date" id="date"/><br>
	Note obtenue : <input type="number" name="note" id="note" min="0" max="20" step="0.01" /><br>

	<input type="submit" value="Rechercher"/>


</form>

<?php

}
?>
