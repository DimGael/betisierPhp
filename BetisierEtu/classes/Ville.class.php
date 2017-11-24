<?php
class Ville{
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
                case 'vil_num':
                $this->setNumero($valeur);
                break;
                
                case 'vil_nom' :
                $this->setNom($valeur);
                break;            }
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
}