<?php
	class Departement{
		private $numero;
		private $nom;
		private $villeNumero;

		public function __construct($valeurs){
			$this->hydrate($valeurs);
		}

		public function hydrate($valeurs){
			foreach ($valeurs as $key => $value) {
				switch ($key) {
					case 'dep_num':
						$this->setNumero($value);
						break;

					case 'dep_nom':
						$this->setNom($value);
						break;

					case 'vil_num':
						$this->setNumeroVille($value);
						break;
				}
			}
		}

		public function getNumero(){
			return $this->numero;
		}
		public function setNumero($numero){
			$this->numero = $numero;
		}

		public function getNom(){
			return $this->nom;
		}
		public function setNom($nom){
			$this->nom = $nom;
		}

		public function getNumeroVille(){
			return $this->villeNumero;
		}
		public function setNumeroVille($numero){
			$this->villeNumero = $numero;
		}
	}
?>