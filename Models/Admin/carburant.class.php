<?php
require_once("connexion.php");

Class Carburant
{
    public $carburant;
    
    //                
     
    //ajouter un article
    public function setCarburant($carburant)
    {   
        $this->carburant=$carburant;
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_carburant (name_carburant) VALUES (?)");
        $addline1 = $add1->execute(array($carburant)) or die(print_r($add1->errorInfo()));       
       
        return $addline1;
    }
    
    public function setOrder($fournisseur,$carburant,$livreur,$mat,$prix,$qty,$date,$id)
    {   
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_order (fournisseur_id,carburant_id,livreur,matricule,prixa,littre,datel,user_id) VALUES (?,?,?,?,?,?,?,?)");
        $addline1 = $add1->execute(array($fournisseur,$carburant,$livreur,$mat,$prix,$qty,$date,$id)) or die(print_r($add1->errorInfo()));       
       
        return $addline1;
    }
    
    public function setPompe($pompe,$code,$statut,$index,$carburant_id)
    {   
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_pompe (pompe,code,statut,cpt,carburant_id ) VALUES (?,?,?,?,?)");
        $addline1 = $add1->execute(array($pompe,$code,$statut,$index,$carburant_id)) or die(print_r($add1->errorInfo()));       
       
        return $addline1;
    }
    
    public function getCarburants()
        {
            $db = getConnection();
            $statement = $db->prepare("SELECT id_carburant,type,unity,qty,dateprix,prix FROM tbl_carburant as c,tbl_types as t WHERE c.id_type =t.id_type");
            $statement->execute();
            $tbP = array();
            while($data =  $statement->fetchObject()){
                $tbP[] = $data;
            }
             return $tbP;
        }
    
        public function getCarburant($id)
        {
            $db = getConnection();
            $statement = $db->prepare("SELECT id_carburant,type,unity,qty,dateprix,prix 
            FROM tbl_carburant as c,tbl_types as t WHERE c.id_type =t.id_type and id_carburant = ?");
            $statement->execute([$id]);
            $tbP = $statement->fetchObject();
            return $tbP;
        }

        public function getPompeActif()
        {
            $db = getConnection();
            $statement = $db->prepare("SELECT * FROM tbl_pompe where statut = 'active'");
            $statement->execute();
            $tbP = array();
            while($data =  $statement->fetchObject()){
                $tbP[] = $data;
            }
             return $tbP;
        }

        
        public function getPompes()
        {
            $db = getConnection();
            $statement = $db->prepare("SELECT id_carburant,type,unity,qty,prix,pompe,cpt,code,p.statut 
            FROM tbl_pompe as p, tbl_carburant as c,tbl_types as t WHERE c.id_type =t.id_type and p.carburant_id =c.id_carburant");
            $statement->execute();
            $tbP = array();
            while($data =  $statement->fetchObject()){
                $tbP[] = $data;
            }
             return $tbP;
        }


        
        public function getCarburantDispo($id)
        {
            $db = getConnection();
            $data = $db->prepare("SELECT qty FROM tbl_carburant where id_carburant = ? ");
            $data->execute(array($id));
            $rc = $data->fetchObject();
            return $rc;
        }

        
        public function getPompeIndex($id)
        {
            $db = getConnection();
            $data = $db->prepare("SELECT cpt FROM tbl_pompe where pompe_id = ? ");
            $data->execute(array($id));
            $rc = $data->fetchObject();
            return $rc;
        }
    
        public function deleteCarburant($id){
            $db = getConnection();
            $sql =$db->prepare( "DELETE FROM tbl_carburant WHERE id_carburant=?");
            $ok = $sql->execute(array($id));
           return $ok;
        }

        public function updateCarburant($carburant,$id){
                $db = getConnection();
                $update = $db->prepare("UPDATE tbl_carburant SET name_carburant=? WHERE id_carburant =?");
                $ok = $update->execute(array($carburant,$id)) or die(print_r($update->errorInfo()));
                return $ok;
        }
        
        public function newPrice($prix,$id){
            $db = getConnection();
            $update = $db->prepare("UPDATE tbl_carburant SET prix=? WHERE id_carburant =?");
            $ok = $update->execute(array($prix,$id)) or die(print_r($update->errorInfo()));
            return $ok;
    }
   
        public function Approvisionner($qte,$id)
        {   
            $db = getConnection();
            $update = $db->prepare("UPDATE tbl_carburant SET qty=?WHERE id_carburant =?");
            $ok = $update->execute(array($qte,$id)) or die(print_r($update->errorInfo()));
            return $ok;
        }



   
}
?>