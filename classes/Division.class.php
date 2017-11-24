<?php
Class Division{
	private $numero;
  private $nom;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeur) {

			switch ($attribut) {
				case 'div_num':
				$this->setNumero($valeur);
				break;

				case 'div_nom':
				$this->setNom($valeur);
				break;

				default:
				break;
			}
		}
	}

  public function getNom(){
    return $this->nom;
  }
  public function setNom($nom){
    $this->nom = $nom;
  }
  public function getNumero(){
    return $this->numero;
  }
  public function setNumero($num){
    $this->numero = $num;
  }

}
