<?php

class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllEtudiants(){
		$listeEtu = array();
		$reqSql = 'SELECT per_num, dep_num, div_num FROM etudiant ORDER BY per_num';

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while ($etudiant = $req->fetch(PDO::FETCH_OBJ)){
			$listeEtu[] = new Etudiant($etudiant);
		}

		$req->closeCursor();

		return $listeEtu;
	}

	public function estEtudiant($numeroPersonne){
		return !is_null($this->getEtudiantNumero($numeroPersonne));
	}

	public function getEtudiantNumero($numeroPersonne){
		$etudiant = null;
		$reqSql = "SELECT per_num, dep_num, div_num FROM etudiant WHERE per_num = ".$numeroPersonne;

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($resultat = $req->fetch(PDO::FETCH_OBJ)){
			$etudiant = new Etudiant($resultat);
		}

		$req->closeCursor();

		return $etudiant;
	}

	public function add($etudiant){
		$reqSql = "INSERT INTO etudiant (per_num, dep_num, div_num)
		VALUES(:per_num, :dep_num, :div_num)";

		$req = $this->db->prepare($reqSql);

		return $req->execute(array(
			'per_num' => $etudiant->getNumeroPersonne(),
			'dep_num' => $etudiant->getNumeroDepartement(),
			'div_num' => $etudiant->getNumeroDivision()
		));
	}

	public function delete($numeroPersonne){
		$reqSql = "DELETE FROM etudiant WHERE per_num = $numeroPersonne";

		$req = $this->db->prepare($reqSql);

		return $req->execute();
	}

	public function update($etudiant){
		$reqSql = "UPDATE etudiant SET dep_num = :dep, div_num = :div WHERE per_num = ".$etudiant->getNumeroPersonne();

		$req = $this->db->prepare($reqSql);

		return $req->execute(array(
			'dep' => $etudiant->getNumeroDepartement(),
			'div' => $etudiant->getNumeroDivision()
		));
	}

}

?>