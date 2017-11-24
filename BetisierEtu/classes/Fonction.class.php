<?php

class Fonction{

	private $numero;
	private $libelle;

	public function __construct($valeurs){
		$this->hydrate($valeurs);
	}

	public function hydrate($valeurs){
		foreach ($valeurs as $key => $value) {
			switch ($key) {
				case 'fon_num':
					$this->setNumero($value);
					break;

				case 'fon_libelle':
					$this->setLibelle($value);
					break;
			}
		}
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public function getNumero(){
		return $this->numero;
	}


	public function setLibelle($libelle){
		$this->libelle = $libelle;
	}

	public function getLibelle(){
		return $this->libelle;
	}
}

?>