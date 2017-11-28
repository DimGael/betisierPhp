<?php

class CitationManager{
	private $db;


	public function __construct($db){
		$this->db = $db;
	}

	public function getAllCitations(){
		$listeCitations;

		$sql = 'SELECT cit_num, per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM CITATION';
		$req = $this->bd->prepare($sql);
		$req->execute();

		while($citation = $req->fetch(PDO::FETCH_OBJ)){
			$listeCitations[] = new Citation($citation);
		}

		$req->closeCursor();

		return $listeCitations;
	}

	public function get2CitationsValides(){
		$listeCitations;

		$sql = 'SELECT cit_num, per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo FROM CITATION
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
		$reqSql = 'SELECT COUNT(*) as nbCitations FROM CITATION WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL';

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
		$reqSql = "INSERT INTO CITATION (per_num, per_num_etu,cit_libelle, cit_date, cit_valide, cit_date_depo)
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
}

?>