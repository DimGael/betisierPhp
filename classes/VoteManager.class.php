<?php

	class VoteManager{

		private $db;

		public function __construct($db){
			$this->db = $db;
		}

		public function getMoyenneVotesCitation($numeroCitation){
 

			$reqSql = 	'SELECT AVG(vot_valeur) as moyenne FROM VOTE WHERE cit_num = '.$numeroCitation;

			$req = $this->db->prepare($reqSql);
            $req->execute();

			while($moyenne = $req->fetch(PDO::FETCH_OBJ)){
				$resultat = $moyenne->moyenne;
			}

			$req->closeCursor();

			return $resultat;
		}


		public function aVote($numeroPersonne, $numeroCitation){
			$resultat = null;
			$reqSql = 'SELECT vot_valeur FROM vote WHERE cit_num = '.$numeroCitation.' AND per_num = '.$numeroPersonne; 

			$req = $this->db->prepare($reqSql);
            $req->execute();

            while($res = $req->fetch(PDO::FETCH_OBJ)){
				$resultat = $res->vot_valeur;
			}

			$req->closeCursor();

			return !is_null($resultat);
		}


		public function add($vote){
			 $sql = "INSERT INTO  vote (cit_num, per_num, vot_valeur) VALUES (:cit, :pers, :note)";
			 $req = $this->db->prepare($sql);

			 return $req->execute(array(
			 	'cit' => $vote->getNumeroCitation(),
			 	'pers' => $vote->getNumeroPersonne(),
			 	'note' => $vote->getValeur()
			));
		}
	}

?>