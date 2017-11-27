<?php 
    class VilleManager {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllVilles(){
            $listeVille = array();

            $sql = "SELECT vil_num, vil_nom FROM ville ORDER BY vil_num";

            $req = $this->db->prepare($sql);
            $req->execute();

            while ($ville = $req->fetch(PDO::FETCH_OBJ)){

                $listeVille[] = new Ville ($ville);

            }

            $req->closeCursor();

            return $listeVille;
        }

    public function getVilleNumero($numeroVille){
        $villeRes = null;

        $reqSql = 'SELECT vil_num, vil_nom FROM VILLE WHERE vil_num = '.$numeroVille;

        $req = $this->db->prepare($reqSql);
        $req->execute();

        while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
            $villeRes = new Ville($ville);
        }

        $req->closeCursor();

        return $villeRes;
    }

    public function add($nom){

        $sql = "INSERT INTO ville(vil_nom) VALUES (:vn)";
        $req = $this->db->prepare($sql);
        $req->bindValue(':vn', $nom);
        $req->execute();
        return true;
    }

    public function getVilleNom($nomVille){
        $villeRes = null;

        $reqSql = "SELECT vil_num, vil_nom FROM VILLE WHERE vil_nom = '$nomVille'";

        $req = $this->db->prepare($reqSql);
        $req->execute();

        while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
            $villeRes = new Ville($ville);
        }

        $req->closeCursor();

        return $villeRes;
    }

    //Retourne vrai si la ville est déjà enregistrée
    public function nomVilleExisteDeja($nomVille){
        return !is_null($this->getVilleNom($nomVille));
    }
}

?>