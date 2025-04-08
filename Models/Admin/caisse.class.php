<?php
require_once("connexion.php");

class Caisse
{
    public $adresse = 1;
    public $dateins = null;
    public $idcat;
    public $cat;

    //ajouter une depense
    public function setDepense($client, $tel, $motif, $montant, $devise, $dateins, $idu)
    {
        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_depenses(beneficiaire,tel,motif,montant,devise_id,date,user_id) 
         VALUES (?,?,?,?,?,?,?)");
        $addline = $add->execute(array($client, $tel, $motif, $montant, $devise, $dateins, $idu)) or die(print_r($add->errorInfo()));
        return $addline;
    }
    //afficher les ventes de la quincaillerie
    public function getCaisse()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_other_entry.ID AS ID,tbl_other_entry.CLIENT AS CLIENT,tbl_other_entry.MONTANT AS MONTANT,
         tbl_other_entry.MONTANT AS MONTANT,tbl_other_entry.STATUT,tbl_other_entry.DATE AS DATE,tbl_users.NAME AS NAME,tbl_other_entry.MOTIF AS MOTIF,tbl_other_entry.TEL AS TEL
          from tbl_other_entry,tbl_users Where tbl_other_entry.IDU = tbl_users.ID and tbl_other_entry.STATUT ='0' 
          ORDER BY tbl_other_entry.DATE DESC");
        $statement->execute();
        // $total_rows = $statement->rowCount();
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    //depense
    public function getDepenseId($id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_depenses.ID AS ID,tbl_entrepot.ENTREPOT as DEPOT,tbl_depenses.BENEFICIAIRE AS BENEFICIAIRE,tbl_depenses.MONTANT AS MONTANT,
       tbl_depenses.STATUT,tbl_depenses.DATE AS DATE,tbl_users.NAME AS NAME,tbl_depenses.MOTIF AS MOTIF,tbl_devise.SHORT
        from tbl_depenses,tbl_users,tbl_entrepot,tbl_devise Where tbl_depenses.IDU = tbl_users.ID AND tbl_devise.ID= tbl_depenses.DEVISE ORDER BY ID DESC");
        $statement->execute(array($id));
        // $total_rows = $statement->rowCount();
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function getDepenses()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_depenses.depense_id AS depense_id,tbl_depenses.beneficiaire AS beneficiaire,tbl_depenses.montant AS montant,
       tbl_depenses.date AS date,tbl_users.username AS name,tbl_depenses.motif AS motif ,tbl_devise.short
        from tbl_depenses,tbl_users,tbl_devise Where tbl_depenses.user_id = tbl_users.id_user  AND tbl_devise.devise_id= tbl_depenses.devise_id  ORDER BY beneficiaire DESC");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function getDepense($fdate, $tdate)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT tbl_depenses.depense_id AS depense_id,tbl_depenses.beneficiaire AS beneficiaire,tbl_depenses.montant AS montant,
       tbl_depenses.date AS date,tbl_users.username AS name,tbl_depenses.motif AS motif ,tbl_devise.short
        from tbl_depenses,tbl_users,tbl_devise Where tbl_depenses.user_id = tbl_users.id_user  AND 
        tbl_devise.devise_id= tbl_depenses.devise_id and (tbl_depenses.date BETWEEN '$fdate' and '$tdate')  ORDER BY beneficiaire DESC");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetch(PDO::FETCH_OBJ)) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function getDepenseTotal1($fdate, $tdate)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(montant) as montant,tbl_devise.short
        from tbl_depenses,tbl_users,tbl_devise Where tbl_depenses.user_id = tbl_users.id_user  AND 
        tbl_devise.devise_id= tbl_depenses.devise_id and (tbl_depenses.date BETWEEN '$fdate' and '$tdate') and tbl_depenses.devise_id='1'");
        $statement->execute();
        $tbP = $statement->fetch(PDO::FETCH_OBJ);
        return $tbP;
    }

    public function getDepenseTotal2($fdate, $tdate)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(montant) as montant,tbl_devise.short
        from tbl_depenses,tbl_users,tbl_devise Where tbl_depenses.user_id = tbl_users.id_user  AND 
        tbl_devise.devise_id= tbl_depenses.devise_id and (tbl_depenses.date BETWEEN '$fdate' and '$tdate') and tbl_depenses.devise_id='2'");
        $statement->execute();
        $tbP = $statement->fetch(PDO::FETCH_OBJ);
        return $tbP;
    }

    public function SetPaiement($staff_id, $montant, $devise, $mois, $annee, $date)
    {
        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_paiement(staff_id,montant,devise_id,mois,annee,date) 
         VALUES (?,?,?,?,?,?)");
        $addline = $add->execute(array($staff_id, $montant, $devise, $mois, $annee, $date)) or die(print_r($add->errorInfo()));
        return $addline;
    }

    public function PaiementExist($id, $annee, $mois)
    {
        $db = getConnection();
        $stmt = $db->prepare("SELECT payment_id as id FROM tbl_paiement WHERE staff_id=? and annee=? and mois=? ");
        $stmt->execute(array($id, $annee, $mois));
        $tbP = $stmt->fetch(PDO::FETCH_OBJ);
        return $tbP;
    }
    public function getDette1()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(reste) as DETTE,SHORT
           FROM tbl_vente,tbl_vente_carburant,tbl_users,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
           WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
           and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
           and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id and tbl_vente.pompiste = tbl_staff.staff_id
           and tbl_vente.reste > 0 and tbl_vente.devise_id=1 ");
        $statement->execute();
        $tbP = $statement->fetchObject();
        return $tbP;
    }
    public function getDette2()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT sum(reste) as DETTE,SHORT
        FROM tbl_vente,tbl_vente_carburant,tbl_users,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
        WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
        and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
        and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id and tbl_vente.pompiste = tbl_staff.staff_id
        and tbl_vente.reste > 0 and tbl_vente.devise_id=2");
        $statement->execute();
        $tbP = $statement->fetchObject();
        return $tbP;
    }
}
