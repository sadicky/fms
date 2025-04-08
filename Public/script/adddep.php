<?php
session_start();
require_once('../../Models/Admin/caisse.class.php');
require_once('../../Models/Admin/bank.class.php');
$banks  = new Bank();
$caisse = new Caisse();

$tel = isset($_POST['tel']) ? $_POST['tel'] : "";
$date = isset($_POST['date']) ? $_POST['date'] : "";
$client = isset($_POST['client']) ? $_POST['client'] : "";
$montant = isset($_POST['montant']) ? $_POST['montant'] : "";
$montantc = isset($_POST['montantc']) ? $_POST['montantc'] : "";
$motif = isset($_POST['motif']) ? $_POST['motif'] : "";
$devise = isset($_POST['devise']) ? $_POST['devise'] : "";
$idu = $_SESSION['id'];
// var_dump($_POST);
// die();
// Calculs	
$balance = intval($montantc) - intval($montant);

if ($montantc <= 0) {
  echo "<span class='alert alert-pro alert-dismissible alert-danger col-sm-12'>Cette Banque à O</span>
       ";
} else if ($montant > $montantc) {
  echo "<span class='alert alert-pro alert-dismissible alert-danger col-sm-12'>Montant entré est supérieur à celui de la Banque principal</span>
  ";
} else if ($montantc > 0) {
  if ($devise == 1) {
    $caisse->setDepense($client, $tel, $motif, $montant, $devise, $date, $idu);
    $banks->Actualiser($balance, 1);
  } else if ($devise == 2) {
    $caisse->setDepense($client, $tel, $motif, $montant, $devise, $date, $idu);
    $banks->Actualiser($balance, 2);
  }
  echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>Dépense</strong> enregistrée avec succes.<br/>";
} else {
  echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
}
