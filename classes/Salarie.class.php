<?php

class Salarie {
	
	private $numeroPersonne;
	private $telephonePro;
	private $numeroFonction;

	public function __construct($valeurs){
		$this->hydrate($valeurs);
	}

	public function hydrate($valeurs){
		foreach ($valeurs as $attribut => $valeur) {
			switch ($attribut) {
				case 'per_num':
					$this->setNumeroPersonne($valeur);
					break;

				case 'sal_telprof':
					$this->setTelephonePro($valeur);
					break;

				case 'fon_num':
					$this->setNumeroFonction($valeur);
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


	public function getTelephonePro(){
		return $this->telephonePro;
	}

	public function setTelephonePro($telephonePro){
		$this->telephonePro = $telephonePro;
	}


	public function getNumeroFonction(){
		return $this->numeroFonction;
	}

	public function setNumeroFonction($numeroFonction){
		$this->numeroFonction = $numeroFonction;
	}
}

?>