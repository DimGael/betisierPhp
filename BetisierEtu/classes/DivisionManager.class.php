<?php
	Class DivisionManager{
		private $db;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllDivisions(){
			$liste = array();

			$sql = "SELECT div_num, div_nom FROM division";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($div = $req->fetch(PDO::FETCH_OBJ)){

				$liste[] = new Division($div);

			}

			return $liste;
		}

		public function getDivisionNom($nomDivision){
			$division = null;

			$sql = "SELECT div_num, div_nom FROM DIVISION
			WHERE div_nom = '$nomDivision'";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($div = $req->fetch(PDO::FETCH_OBJ)){
				$division = new Division($div);
			}

			return $division;
		}
	}
