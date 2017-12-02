<?php

class SalarieManager{
	private $db;

	public function __construct($pdo){
		$this->db = $pdo;
	}

	public function getAllSalarie(){
		$listeSal = array();
		$reqSql = 'SELECT per_num, sal_telprof, fon_num FROM salarie ORDER BY per_num';

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while ($salarie = $req->fetch(PDO::FETCH_OBJ)){
			$listeSal[] = new Salarie($salarie);
		}

		$req->closeCursor();

		return $listeSal;
	}

	public function estSalarie($numeroPersonne){
		return !is_null($this->getSalarieNumero($numeroPersonne));
	}

	public function getSalarieNumero($numeroPersonne){
		$salarie = null;

		$reqSql = 'SELECT per_num, sal_telprof, fon_num FROM salarie WHERE per_num = '.$numeroPersonne;

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($resultat = $req->fetch(PDO::FETCH_OBJ)){
			$salarie = new Salarie($resultat);
		}

		$req->closeCursor();

		return $salarie;
	}

	public function add($salarie){
		$reqSql = "INSERT INTO salarie (per_num, sal_telprof, fon_num)
		VALUES(:per_num, :sal_telprof, :fon_num)";

		$req = $this->db->prepare($reqSql);

		return $req->execute(array(
			'per_num' => $salarie->getNumeroPersonne(),
			'sal_telprof' => $salarie->getTelephonePro(),
			'fon_num' => $salarie->getNumeroFonction()
		));
	}

	public function getAllSalarieFonctionLibelle($libelleFonction){
		$listeSal = array();
		
		$reqSql = "SELECT s.per_num, s.sal_telprof, s.fon_num FROM salarie s
		INNER JOIN fonction f ON f.fon_num = s.fon_num
		WHERE f.fon_libelle = '$libelleFonction'";

		$req = $this->db->prepare($reqSql);
		$req->execute();

		while($resultat = $req->fetch(PDO::FETCH_OBJ)){
			$listeSal[] = new Salarie($resultat);
		}

		$req->closeCursor();

		return $listeSal;
	}

	public function update($salarie){
		$reqSql = "UPDATE salarie SET sal_telprof = :telpro, fon_num = :fon_num WHERE per_num = ".$salarie->getNumeroPersonne();

		$req = $this->db->prepare($reqSql);

		return $req->execute(array(
			'telpro' => $salarie->getTelephonePro(),
			'fon_num' => $salarie->getNumeroFonction()
		));
	}
}

?>