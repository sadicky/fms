<?php
require_once("connexion.php");

class Tiers
{
    //ajouter un article
    public function setTiers($tiers, $tel)
    {
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_tiers (tiers,tel) VALUES (?,?)");
        $addline1 = $add1->execute(array($tiers, $tel)) or die(print_r($add1->errorInfo()));

        return $addline1;
    }

    public function setSupplier($tiers, $tel)
    {
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_tiers (tiers,tel) VALUES (?,?)");
        $addline1 = $add1->execute(array($tiers, $tel)) or die(print_r($add1->errorInfo()));

        return $addline1;
    }

    public function setDevise($devise, $short, $taux)
    {
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_devise (DEVISE,SHORT,TAUX) VALUES (?,?,?)");
        $addline1 = $add1->execute(array($devise, $short, $taux)) or die(print_r($add1->errorInfo()));

        return $addline1;
    }


    //afficher les catégories
    public function getTiers()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_tiers order by tiers ASC");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetchObject()) {
            $tbP[] = $data;
        }
        return $tbP;
    }


    public function getDevises()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_devise order by devise ASC");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetchObject()) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function getDevises2()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_devise where statut='1' order by devise ASC");
        $statement->execute();
        $tbP = $statement->fetchObject();
        return $tbP;
    }
    public function getDevises3()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_devise where statut='0' order by DEVISE ASC");
        $statement->execute();
        $tbP = $statement->fetchObject();
        return $tbP;
    }
    //afficher les catégories
    public function getTierId($id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_tiers WHERE tier_id=?");
        $statement->execute([$id]);
        $data =  $statement->fetchObject();
        return $data;
    }
    public function getDeviseId($id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_devise  WHERE devise_id=?");
        $statement->execute([$id]);
        $data =  $statement->fetchObject();
        return $data;
    }


    public function deleteTiers($id)
    {
        $db = getConnection();
        $delete =  $db->prepare("DELETE FROM tbl_tiers WHERE tier_id =?");

        $ok = $delete->execute(array($id));
        return $ok;
    }

    public function deleteDevise($id)
    {
        $db = getConnection();
        $delete =  $db->prepare("DELETE FROM tbl_devise WHERE devise_id =?");

        $ok = $delete->execute(array($id));
        return $ok;
    }
}
