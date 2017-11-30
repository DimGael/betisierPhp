<?php
class MotManager{
  public function __construct($db){
    $this->db = $db;
  }
  public function verifMot($mot){

    if(isset($mot) && !empty($mot)){
        $motsInterdit = null;
        $sqlFullText = ('SELECT mot_id, mot_interdit FROM mot WHERE MATCH (mot_interdit) AGAINST ("'.$mot.'" IN BOOLEAN MODE)');
        $reponse = $this->db->prepare($sqlFullText);

        $reponse->execute();

        while($ligne = $reponse->fetch()){
          $motsInterdit = new Mot($ligne);
        }

      }
      return $motsInterdit;
    }
}
?>
