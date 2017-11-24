<?php

class Citation{
	
	private $numero;
	private $numeroPersonne;
	private $numeroPersonneValide;
	private $numeroPersonneEtudiant;
	private $libelle;
	private $date;
	private $valide;
	private $dateValide;
	private $dateDeposition;


	public function __construct($valeurs){
		$this->hydrate($valeurs);
	}

	public function hydrate($valeurs){
		foreach ($valeurs as $attributs => $valeur) {
			switch ($attributs) {
				case 'cit_num':
					$this->setNumero($valeur);
					break;

				case 'per_num':
					$this->setNumeroPersonne($valeur);
					break;

				case 'per_num_valide':
					$this->setNumeroPersonneValide($valeur);
					break;

				case 'cit_libelle' :
					$this->setLibelle($valeur);
					break;

				case 'cit_date' :
					$this->setDate($valeur);
					break;

				case 'cit_valide':
					$this->setValide($valeur);
					break;

				case 'cit_date_valide':
					$this->setDateValide($valeur);
					break;

				case 'cit_date_depo':
					$this->setDateDeposition($valeur);
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



	public function setNumeroPersonne($numeroPersonne){
		$this->numeroPersonne = $numeroPersonne;
	}

	public function getNumeroPersonne(){
		return $this->numeroPersonne;
	}


	public function setNumeroPersonneValide($numeroPersonneValide){
		$this->numeroPersonneValide = $numeroPersonneValide;
	}

	public function getNumeroPersonneValide(){
		return $this->numeroPersonneValide;
	}


	public function setLibelle($libelle){
		$this->libelle = $libelle;
	}

	public function getLibelle(){
		return $this->libelle;
	}


	public function setDate($date){
		$this->date = $date;
	}

	public function getDate(){
		return $this->date;
	}


	public function setValide($valide){
		$this->valide = $valide;
	}

	public function getValide(){
		return $this->valide;
	}


	public function setDateValide($dateValide){
		$this->dateValide = $dateValide;
	}

	public function getDateValide(){
		return $this->dateValide;
	}


	public function setDateDeposition($dateDeposition){
		$this->dateDeposition = $dateDeposition;
	}

	public function getDateDeposition(){
		return $this->dateDeposition;
	}

	public function estValide(){
		return $this->valide == 1 && !is_null($this->dateValide);
	}
}


?>