<?php

class Vote{
	private $numeroCitation;
	private $numeroPersonne;
	private $valeur;


	public function __construct($valeurs){
		$this->hydrate($valeurs);
	}

	public function hydrate($valeurs){
		foreach ($valeurs as $attribut => $valeur) {
			switch ($attribut) {
				case 'cit_num':
					$this->setNumeroCitation($valeur);
					break;

				case 'per_num':
					$this->setNumeroPersonne($valeur);
					break;

				case 'vot_valeur':
					$this->setValeur($valeur);
					break;
			}
		}
	}

	public function setNumeroCitation($numeroCitation){
		$this->numeroCitation = $numeroCitation;
	}

	public function getNumeroCitation(){
		return $this->numeroCitation;
	}


	public function setNumeroPersonne($numeroPersonne){
		$this->numeroPersonne = $numeroPersonne;
	}

	public function getNumeroPersonne(){
		return $this->numeroPersonne;
	}


	public function setValeur($valeur){
		$this->valeur = $valeur;
	}

	public function getValeur(){
		return $this->valeur;
	}
}

?>