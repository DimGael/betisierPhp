<?php

class CitationManager{
	private $db;


	public function __construct($db){
		$this->db = $db;
	}

	public function getAllCitationsValides(){
		$listeCitations;

		$sql = 'SELECT cit_num, per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation
				WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL';
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function getAllCitationsNonValides(){
		$listeCitations;

		$sql = 'SELECT cit_num, per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation
				WHERE cit_valide = 0';
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function get2CitationsValides(){
		$listeCitations;

		$sql = 'SELECT cit_num, per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation
				WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL
				LIMIT 2';
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function getNbCitations(){
		$reqSql = 'SELECT COUNT(*) as nbCitations FROM citation WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL';

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($resultat = $req->fetch(PDO::FETCH_OBJ)){
			foreach ($resultat as $key => $value) {
				$taille = $value;
			}
		}
		$req->closeCursor();

		return $taille;
	}

	//La méthode insère la citation non validée
	public function add($citation){
		$reqSql = "INSERT INTO citation (per_num, per_num_etu,cit_libelle, cit_date, cit_valide, cit_date_depo)
			VALUES(:per_num, :per_num_etu, :cit_libelle, :cit_date, 0, :cit_date_depo)";

		$req = $this->db->prepare($reqSql);

		return $req->execute(array(
			'per_num' => $citation->getNumeroPersonne(),
			'per_num_etu' => $citation->getNumeroEtudiant(),
			'cit_libelle' => $citation->getLibelle(),
			'cit_date' => $citation->getDate(),
			'cit_date_depo' => $citation->getDateDeposition()
		));
	}

	public function valider($numeroCitation){
		$vraiDate = new DateTime(date("d-m-Y H:i:s").' +1 hour');

		$reqSql="UPDATE citation SET cit_valide = 1, cit_date_valide = '".$vraiDate->format("Y-m-d")."' WHERE cit_num = ".$numeroCitation;

		$req=$this->db->prepare($reqSql);

		return $req->execute();
	}

	public function supprimer($numeroCitation){
		$reqSql="DELETE FROM citation WHERE cit_num = ".$numeroCitation;

		$req=$this->db->prepare($reqSql);

		return $req->execute();

	}

	public function toutSupprimerNumeroPersonne($numeroPersonne){
		$reqSql = "DELETE FROM citation WHERE per_num = $numeroPersonne";

		$req=$this->db->prepare($reqSql);

		return $req->execute();
	}



	// Recherche

	public function rechercheParNom($NomPersonne){
		$listeCitations;
		$listeCitations = null;

		$sql = 'SELECT cit_num, c.per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation c, personne p
				WHERE c.per_num = p.per_num
				AND cit_valide = 1 AND cit_date_valide IS NOT NULL AND p.per_nom = "'.$NomPersonne.'"';
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function rechercheParDate($Date){
		$listeCitations;
		$listeCitations = null;

		$sql = 'SELECT cit_num, per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation c
				WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL AND cit_date = "'.$Date.'"';
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function rechercheParNote($Note){
		$listeCitations;
		$listeCitations = null;

		$sql = 'SELECT c.cit_num, c.per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation c, vote v
				WHERE c.cit_num = v.cit_num
				AND cit_valide = 1 AND cit_date_valide IS NOT NULL AND v.vot_valeur = '.$Note;
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function rechercheParNomEtDate($NomPersonne, $Date){
		$listeCitations;
		$listeCitations = null;

		$sql = 'SELECT cit_num, c.per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM citation c, personne p
				WHERE c.per_num = p.per_num
				AND cit_valide = 1 AND cit_date_valide IS NOT NULL AND p.per_nom = "'.$NomPersonne.'" AND cit_date ="'.$Date.'"' ;
		
		$req = $this->db->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function supprimerCitation($numCit){


		$this->supprimerVoteCitation($numCit);



        $sql ="DELETE FROM citation WHERE cit_num = '$numCit'";

        $req = $this->db->prepare($sql);

            return $req->execute();
    }

    public function supprimerVoteCitation($numCit){
    	$sql ="DELETE FROM vote WHERE cit_num = '$numCit'";

        $req = $this->db->prepare($sql);

            return $req->execute();
    }
	
}

?>