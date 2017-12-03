<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];}
	else
	{$page=0;
	}
switch ($page) {
//
// Personnes
//

case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;
case 1:
	// inclure ici la page insertion nouvelle personne
	if(pagePourConnectes())
	{
		include("pages/ajouterPersonne.inc.php");
	}
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/listerPersonnes.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/ModifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/supprimerPersonne.inc.php');
    break;
//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
	if(pagePourConnectes())
	{
		if(pagePourEtudiants()){
    		include("pages/ajouterCitation.inc.php");
    	}
    }
    break;

case 6:
	// inclure ici la page liste des citations
	include("pages/listerCitation.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	if(pagePourConnectes())
	{
		include("pages/ajouterVille.inc.php");
	}
    break;

case 8:
// inclure ici la page lister  ville
	include("pages/listerVilles.inc.php");
    break;

//

//
case 9:
	// inclure ici la page Connexion
	include("pages/seConnecter.inc.php");
    break;
    
case 10:
	// inclure ici la page Deconnexion
	include("pages/seDeconnecter.inc.php");
    break;
    
case 11:
	// inclure ici la page ajouter Etudiant
	if(pagePourConnectes())
	{
		include("pages/ajouterEtudiant.inc.php");
	}
    break;

case 12:
	// inclure ici la page ajouter salarié
	if(pagePourConnectes())
	{
		include("pages/ajouterSalarie.inc.php");
	}
    break;

case 13:
		if(pagePourConnectes())
	{
		if(pagePourEtudiants()){
    		include("pages/voter.inc.php");
    	}
    }
    break;  

case 14:
	if(pagePourConnectes())
	{
		if(pagePourEtudiants()){
    		include("pages/voterCible.inc.php");
    	}
    }
<<<<<<< HEAD
    break; 

case 15 :  
	if(pagePourConnectes())
	{
		include("pages/rechercherCitation.inc.php");
	}
    break;
  
=======
    break;  

case 15:
	
	if(pagePourConnectes()){
		if(pagePourAdmin()){
			include("pages/validerCitation.inc.php");
		}
	}
	break;

case 16:
	
	if(pagePourConnectes()){
		if(pagePourAdmin()){
			include("pages/validerCitationCible.inc.php");
		}
	}
	
	break;

case 17:
	if(pagePourConnectes()){
		if(pagePourAdmin()){
			include("pages/modifierPersonneMenu.inc.php");
		}
	}
	break;

case 18:
	if(pagePourConnectes()){
		if(pagePourAdmin()){
			include("pages/modifierPersonne.inc.php");
		}
	}
	break;

case 19:
	if(pagePourConnectes()){
		if(pagePourAdmin()){
			include("pages/modifierEtudiant.inc.php");
		}
	}
	break;

case 20:
	if(pagePourConnectes()){
		if(pagePourAdmin()){
			include("pages/modifierSalarie.inc.php");
		}
	}
	break;  
>>>>>>> 15a457ea8d77d88d716d3ca064179f9b0332b733
    
default : 	include_once('pages/accueil.inc.php');
}
	
?>
</div>
