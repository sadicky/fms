<?php
require_once("connexion.php");

class Bank
{
    public $bank;

    //                

    //ajouter un article
    public function setBank($bank, $montant, $numero, $devise)
    {
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_bank (bank,montant,numero_compte,devise_id) VALUES (?,?,?,?)");
        $addline1 = $add1->execute(array($bank, $montant, $numero, $devise)) or die(print_r($add1->errorInfo()));

        return $addline1;
    }

    public function getBanks()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_bank,tbl_devise WHERE tbl_bank.devise_id = tbl_devise.devise_id");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetchObject()) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function getBank($id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_bank where bank_id = ?");
        $statement->execute([$id]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }

    public function getMontant($id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT montant,short,bank FROM tbl_bank,tbl_devise WHERE tbl_bank.devise_id = tbl_devise.devise_id and bank_id = ?");
        $statement->execute([$id]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }


    public function getMontantDevise($id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT montant,short,bank FROM tbl_bank,tbl_devise WHERE tbl_bank.devise_id = tbl_devise.devise_id and bank_id = ?");
        $statement->execute([$id]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }

    public function getBankId($id, $devise_id)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_bank WHERE bank_id!=? and devise_id=?");
        $statement->execute([$id, $devise_id]);
        $tbP = array();
        while ($data =  $statement->fetchObject()) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    //TRANSFERER LE STOCK
    public function Transfert($montant, $id)
    {
        $db = getConnection();
        $update = $db->prepare("UPDATE tbl_bank SET montant=? WHERE bank_id=?");
        $ok = $update->execute(array($montant, $id)) or die(print_r($update->errorInfo()));
        return $ok;
    }

    public function Actualiser($montant, $id)
    {
        $db = getConnection();
        $update = $db->prepare("UPDATE tbl_bank SET montant=? WHERE bank_id=?");
        $ok = $update->execute(array($montant, $id)) or die(print_r($update->errorInfo()));
        return $ok;
    }

    public function setHistoricTransfert($id, $montant, $date, $bank, $idu)
    {
        $db = getConnection();
        $add1 = $db->prepare("INSERT INTO tbl_bank_transaction (bankt,montant,datet,bankr,user_id) VALUES (?,?,?,?,?)");
        $addline1 = $add1->execute(array($id, $montant, $date, $bank, $idu)) or die(print_r($add1->errorInfo()));

        return $addline1;
    }


    public function getHistoricTransfert()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_bank,tbl_bank_transaction,tbl_devise 
        WHERE tbl_bank.devise_id = tbl_devise.devise_id
        and tbl_bank.bank_id = tbl_bank_transaction.bankr");
        $statement->execute();
        $tbP = array();
        while ($data =  $statement->fetchObject()) {
            $tbP[] = $data;
        }
        return $tbP;
    }

    public function deleteBank($id)
    {
        $db = getConnection();
        $sql = $db->prepare("DELETE FROM tbl_bank WHERE bank_id=?");
        $ok = $sql->execute(array($id));
        return $ok;
    }

    public function updateBank($bank, $devise_id, $id)
    {
        $db = getConnection();
        $update = $db->prepare("UPDATE tbl_bank SET bank=?,devise_id=? WHERE bank_id =?");
        $ok = $update->execute(array($bank, $devise_id, $id)) or die(print_r($update->errorInfo()));
        return $ok;
    }
}
