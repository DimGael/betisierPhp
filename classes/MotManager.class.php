<?php
class MotManager{
  public function __construct($db){
    $this->db = $db;
  }
  public function verifCit($citation){
    if(isset($citation) && !empty($citation)){
        $motsInterdits = array();
        $sqlFullText = ('SELECT mot_id, mot_interdit FROM mot WHERE MATCH (mot_interdit) AGAINST ("'.$citation.'" IN BOOLEAN MODE)');
        $reponse = $this->db->prepare($sqlFullText);
        $reponse->execute();
        while($ligne = $reponse->fetch()){
          $motsInterdits[] = new Mot($ligne);
        }

      }
      return $motsInterdits;
    }
}
?>
