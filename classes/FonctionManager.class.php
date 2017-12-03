<?php

class FonctionManager{
	private $db;

	public function __construct($pdo){
		$this->db = $pdo;
	}

	public function getAllFonctions(){
		$listeFonctions = array();

		$reqSql = "SELECT fon_num, fon_libelle FROM fonction ORDER BY fon_num";

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($fonction = $req->fetch(PDO::FETCH_OBJ))
			$listeFonctions[] = new Fonction($fonction);

		$req->closeCursor();

		return $listeFonctions;
	}

	public function getFonctionNumero($numeroFonction){
		$fonction = null;
		$reqSql = "SELECT fon_num, fon_libelle FROM fonction WHERE fon_num = ".$numeroFonction;

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($resultat = $req->fetch(PDO::FETCH_OBJ))
			$fonction = new Fonction($resultat);

		$req->closeCursor();

		return $fonction;
	}
}

?>