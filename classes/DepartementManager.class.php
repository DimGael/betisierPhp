<?php

class DepartementManager{
	
	private $db;

	public function __construct($pdo){
		$this->db = $pdo;
	}

	public function getAllDepartements(){
		$listeDepartements = array();

		$reqSql = "SELECT dep_num, dep_nom, vil_num FROM departement ORDER BY dep_num";

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($departement = $req->fetch(PDO::FETCH_OBJ))
			$listeDepartements[] = new Departement($departement);

		$req->closeCursor();

		return $listeDepartements;
	}

	public function getDepartementNumero($numeroDepartement){
		$departement = null;

		$reqSql = 'SELECT dep_num, dep_nom, vil_num FROM departement WHERE dep_num = '.$numeroDepartement;

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($resultat = $req->fetch(PDO::FETCH_OBJ))
			$departement = new Departement($resultat);

		$req->closeCursor();

		return $departement;
	}

	//Devenu inutile
	public function getDepartementNom($nomDepartement){
			$departement = null;

			$sql = "SELECT dep_num, dep_nom, vil_num FROM departement
			WHERE dep_nom = '$nomDepartement'";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($dep = $req->fetch(PDO::FETCH_OBJ)){
				$departement = new Departement($dep);
			}

			return $departement;
	}
}

?>