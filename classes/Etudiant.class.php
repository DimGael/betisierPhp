<?php
	
	class Etudiant{

		private $numeroPersonne;
		private $numeroDepartement;
		private $numeroDivision;

		public function __construct($valeurs){
			$this->hydrate($valeurs);
		}

		public function hydrate($valeurs){
			foreach ($valeurs as $attribut => $valeur) {
				switch ($attribut) {
					case 'per_num':
						$this->setNumeroPersonne($valeur);
						break;

					case 'dep_num' :
						$this->setNumeroDepartement($valeur);
						break;

					case 'div_num':
						$this->setNumeroDivision($valeur);
						break;
				}
			}
		}

		public function getNumeroPersonne(){
			return $this->numeroPersonne;
		}
		public function setNumeroPersonne($numeroPersonne){
			$this->numeroPersonne = $numeroPersonne;
		}


		public function getNumeroDepartement(){
			return $this->numeroDepartement;
		}
		public function setNumeroDepartement($numeroDepartement){
			$this->numeroDepartement = $numeroDepartement;
		}


		public function getNumeroDivision(){
			return $this->numeroDivision;
		}
		public function setNumeroDivision($numeroDivision){
			$this->numeroDivision = $numeroDivision;
		}

	}

?>