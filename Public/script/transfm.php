<?php

session_start();
require_once('../../Models/Admin/bank.class.php');
$banks  = new Bank();

$id   = isset($_POST['id']) ? $_POST['id'] : 0;
$libelle   = isset($_POST['libelle']) ? $_POST['libelle'] : 0;
$bank   = isset($_POST['bank']) ? $_POST['bank'] : 0;
$montantc  = isset($_POST['montantc']) ? $_POST['montantc'] : 0;
$montant  = isset($_POST['montant']) ? $_POST['montant'] : 0;
$montantct  = isset($_POST['montantct']) ? $_POST['montantct'] : 0;
$idu   = $_SESSION['id'];

// Calculs	
$balance = intval($montantc) - intval($montant);
$transferer = intval($montant) + intval($montantct);

$date = date('Y-m-d H:i:s');

$add = null;
if ($montantc <= 0) {
  echo "<span class='alert alert-pro alert-dismissible alert-danger col-sm-12'>Cette Banque à O</span>
       ";
} else if ($montant > $montantc) {
  echo "<span class='alert alert-pro alert-dismissible alert-danger col-sm-12'>Montant entré est supérieur à celui de la Banque principal</span>
  ";
} else if ($montantc > 0) {
  $banks->setHistoricTransfert($libelle, $montant, $date, $bank, $idu);
  $banks->Actualiser($balance, $id);
  $banks->Transfert($transferer, $bank);

  echo "<span class='alert alert-pro alert-dismissible alert-success col-sm-12'>Transfert avec succes</span>
           ";
  // echo "<script>window.location.href='index.php?page=user'</script>";
} else {
  echo "<span class='alert alert-pro alert-dismissible alert-danger col-sm-12'>erreur de Transfert </span>";
}
