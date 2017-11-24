<?php
class Mot{
  private $numeroMot;
  private $interdit;

  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }
  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {

      switch ($attribut) {

        case 'mot_id':
        $this->setMotId($valeur);
        break;

        case 'mot_interdit':
        $this->setMotInterdit($valeur);
        break;

        default:
        break;
      }
    }
  }

  public function getMotId(){
    return $this->numeroMot;
  }
  public function setMotId($id){
    $this->numeroMot = $id;
  }

  public function getMotInterdit(){
    return $this->interdit;
  }
  public function setMotInterdit($interdit){
    $this->interdit = $interdit;
  }


}
?>
