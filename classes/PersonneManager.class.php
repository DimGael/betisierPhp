<?php

	class PersonneManager{
		private $db;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllPersonnes(){
			$listePersonnes = array();

            $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd FROM PERSONNE ORDER BY per_num";

            $req = $this->db->prepare($sql);
            $req->execute();

            while ($personne = $req->fetch(PDO::FETCH_OBJ)){
                $listePersonnes[] = new Personne($personne);
            }

            $req->closeCursor();

            return $listePersonnes;
		}

		public function getPersonneNumero($numeroPersonne){
			$personne = null;

			$sql = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd FROM PERSONNE
					WHERE per_num = \''.$numeroPersonne.'\'';
			$req = $this->db->prepare($sql);
			$req->execute();

			while ($res = $req->fetch(PDO::FETCH_OBJ)) {
				$personne = new Personne($res);	
			}

			$req->closeCursor();

			return $personne;
		}

		public function getPersonneLogin($login){
			$personne = null;

			$sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd FROM PERSONNE
					WHERE per_login = '".$login."'";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($res = $req->fetch(PDO::FETCH_OBJ)) {
				$personne = new Personne($res);	
			}

			$req->closeCursor();

			return $personne;
		}

		public function existeLogin($login){
			return !is_null($this->getPersonneLogin($login));
		}

		public function add($personne){
			$sql = "INSERT INTO Personne (per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd)
					VALUES(:nom, :pre, :tel, :mail, :admin, :login, :pwd)";
			$req = $this->db->prepare($sql);

			return $req->execute(array(
				'nom' => $personne->getNom(),
				'pre' => $personne->getPrenom(),
				'tel' => $personne->getTelephone(),
				'mail' => $personne->getMail(),
				'admin' => $personne->getAdmin(),
				'login' => $personne->getLogin(),
				'pwd' =>	$personne->getPassword()
			));
		}

		public function getDernierePersonneAjoutee(){
			$personne = null;

			$sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd
			FROM PERSONNE ORDER BY per_num DESC LIMIT 1";

			$req = $this->db->prepare($sql);
			$req->execute();

			while($res = $req->fetch(PDO::FETCH_OBJ)){
				$personne = new Personne($res);	
			}

			$req->closeCursor();

			return $personne;
		}
	}

?>