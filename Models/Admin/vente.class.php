<?php
require_once("connexion.php");

class Vente
{
    public $statut = 0;
    public $dateins = null;
    public $idcat;
    public $cat;
    public $id;

    //ajouter une categorie
    public function setVente($fac, $datev, $client, $tel, $statutv, $statut, $total)
    {
        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_vente (FACTURE, DATEV, CLIENT, TEL, STATUTV, STATUT, TOTAL)        VALUES (?,?,?,?,?,?,?)
    ");
        $addline = $add->execute(array($fac, $datev, $client, $tel, $statutv, $statut, $total)) or die(print_r($add->errorInfo()));
        return $addline;
    }

    //afficher les ventes de la quincaillerie
    public function getVentes()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_vente.vente_id AS vente_id,tbl_vente.tiers_id AS tiers,tbl_vente.mtotal AS mtotal,
         tbl_vente.paye AS paye,tbl_vente.reste AS reste,tbl_devise.short,tbl_vente.bindex AS bindex,tbl_vente.aindex AS aindex,
         tbl_vente.datev AS datev,tbl_tiers.tiers,tbl_types.type as type,tbl_pompe.cpt as cpt,tbl_staff.noms as pompiste,
         tbl_vente_carburant.prix as prix,tbl_vente_carburant.qty as qty,tbl_pompe.code as pompe
         FROM tbl_vente,tbl_vente_carburant,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
         WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
         and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
         and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id         ORDER BY `tbl_vente`.`vente_id` DESC");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    //client
    public function getVenteC($client)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_vente.vente_id AS vente_id,tbl_vente.tiers_id AS tiers_id,tbl_vente.mtotal AS mtotal,qty,
        tbl_tiers.tiers as tiers,tbl_vente.paye AS paye,tbl_vente.reste AS reste,tbl_vente.datev AS datev,tbl_devise.short 
        FROM tbl_vente,tbl_tiers,tbl_devise,tbl_vente_carburant
            WHERE tbl_devise.devise_id= tbl_vente.devise_id AND tbl_vente.tiers_id = tbl_tiers.tier_id
            and tbl_vente_carburant.vente_id=tbl_vente.vente_id AND tbl_vente.tiers_id=?  ORDER BY DATEV DESC");
        $statement->execute([$client]);
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }
    //client
    public function getDettes()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_vente.vente_id AS vente_id,tbl_vente.tiers_id AS tiers,tbl_vente.mtotal AS mtotal,
        tbl_vente.paye AS paye,tbl_vente.reste AS reste,tbl_devise.short,tbl_vente.bindex AS bindex,tbl_vente.aindex AS aindex,
        tbl_vente.datev AS datev,tbl_users.username,tbl_tiers.tiers,tbl_types.type as type,tbl_pompe.cpt as cpt,tbl_staff.noms as pompiste,
        tbl_vente_carburant.prix as prix,tbl_vente_carburant.qty as qty,tbl_pompe.code as pompe,tbl_tiers.tier_id
        FROM tbl_vente,tbl_vente_carburant,tbl_users,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
        WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
        and tbl_vente_carburant.vente_id =tbl_vente.vente_id 
        and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant and tbl_vente.pompiste = tbl_staff.staff_id
        and tbl_vente.reste > 0 ORDER BY tbl_vente.datev DESC");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function getVenteId($id)
    {
        $db = getConnection();
        $sql = "SELECT tbl_vente.vente_id,tbl_tiers.tier_id, tbl_vente.datev,tbl_devise.short, tbl_tiers.tiers, 
        tbl_vente.mtotal as total, tbl_vente.paye, tbl_vente.reste,tbl_staff.noms,tbl_vente.pompiste,tbl_devise.devise_id
        FROM tbl_vente,tbl_tiers,tbl_devise,tbl_staff
       WHERE tbl_devise.devise_id= tbl_vente.devise_id AND tbl_vente.tiers_id = tbl_tiers.tier_id 
       and tbl_vente.pompiste = tbl_staff.staff_id and tbl_vente.vente_id = {$id}";
        $result = $db->query($sql);
        $data = $result->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    public function venteId($id){
        $db = getConnection();
        $statement = "SELECT tbl_vente_carburant.vente_id, tbl_vente_carburant.carburant_id, tbl_vente_carburant.qty,tbl_types.type,
        tbl_vente_carburant.total,tbl_vente_carburant.prix,tbl_vente.paye,tbl_vente.reste,tbl_vente.pompe_id,tbl_pompe.pompe
        FROM tbl_vente,tbl_vente_carburant,tbl_pompe,tbl_types,tbl_carburant
         WHERE tbl_vente_carburant.vente_id= {$id}  and tbl_vente.pompe_id =tbl_pompe.pompe_id 
         and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
         and tbl_types.id_type = tbl_carburant.id_type 
        and tbl_vente_carburant.vente_id =tbl_vente.vente_id";
        $orderItemResult = $db->query($statement);
        $orderItemData = $orderItemResult->fetch(PDO::FETCH_OBJ);
        return $orderItemData;
    }
    //CLIENT DETTE TOTAL
    public function getDette($client)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(reste) as DETTE,SHORT,qty
            FROM tbl_vente,tbl_tiers,tbl_devise,tbl_vente_carburant
            WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_vente_carburant.vente_id=tbl_vente.vente_id
            AND tbl_vente.tiers_id = tbl_tiers.tier_id AND tbl_vente.tiers_id=? 
            and tbl_vente.devise_id=1 ");
        $statement->execute([$client]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }
    public function getDette2($client)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(reste) as DETTE,SHORT,qty
            FROM tbl_vente,tbl_tiers,tbl_devise,tbl_vente_carburant
            WHERE tbl_devise.devise_id= tbl_vente.devise_id AND tbl_vente.tiers_id = tbl_tiers.tier_id  
            and tbl_vente_carburant.vente_id=tbl_vente.vente_id
            AND tbl_vente.tiers_id=? and tbl_vente.devise_id=2 ");
        $statement->execute([$client]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }

    //TOTAL VENTE CLIENT

    public function getTotal($client)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(paye) as TOTAL,SHORT
            FROM tbl_vente,tbl_tiers,tbl_devise
            WHERE tbl_devise.devise_id= tbl_vente.devise_id AND tbl_vente.tiers_id = tbl_tiers.tier_id AND tbl_vente.tiers_id=? and
             tbl_vente.devise_id=1 ");
        $statement->execute([$client]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }

    
    public function getTotalLittreDette($client)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(qty) as QTY,date
            FROM tbl_vente,tbl_tiers,tbl_devise,tbl_vente_carburant
            WHERE tbl_devise.devise_id= tbl_vente.devise_id AND tbl_vente.tiers_id = tbl_tiers.tier_id 
            and tbl_vente_carburant.vente_id=tbl_vente.vente_id and tbl_vente.reste > 0
            AND tbl_vente.tiers_id=?  ");
        $statement->execute([$client]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }

    public function getTotal2($client)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(paye) as TOTAL,SHORT
        FROM tbl_vente,tbl_tiers,tbl_devise
        WHERE tbl_devise.devise_id= tbl_vente.devise_id AND tbl_vente.tiers_id = tbl_tiers.tier_id AND tbl_vente.tiers_id=? and
         tbl_vente.devise_id=2");
        $statement->execute([$client]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }


    public function deleteVente($id)
    {
        $db = getConnection();
        $delete = $db->prepare("DELETE FROM tbl_vente WHERE ID =?");
        $ok = $delete->execute(array($id));
        return $ok;
    }
    
public function setPayment($reste,$balance,$id){
    
    $db = getConnection();
    $update = $db->prepare("UPDATE tbl_vente SET reste=?,paye=? WHERE vente_id =?");
    $ok = $update->execute(array($reste,$balance,$id)) or die(print_r($update->errorInfo()));
    return $ok;
    
}
}
