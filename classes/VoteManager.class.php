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
			$reqSql = 'SELECT vot_valeur FROM vote WHERE cit_num = '.$numeroCitation 'AND per_num = '.$numeroPersonne; 

			$req = $this->db->prepare($reqSql);
            $req->execute();

            while($moyenne = $req->fetch(PDO::FETCH_OBJ)){
				$resultat = $moyenne->moyenne;
			}

			$req->closeCursor();

			return !is_null($resultat);
		}
	}

?>