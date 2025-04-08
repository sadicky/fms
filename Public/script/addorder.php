<?php
require_once('../../Models/Admin/carburant.class.php');
$carburants = new Carburant();

$fournisseur = htmlspecialchars(trim($_POST['fournisseur']));
$carburant = htmlspecialchars(trim($_POST['carburant']));
$livreur = htmlspecialchars(trim($_POST['livreur']));
$sqty = htmlspecialchars(trim($_POST['sqty']));
$qty = htmlspecialchars(trim($_POST['qty']));
$id = htmlspecialchars(trim($_POST['id']));
$prix = htmlspecialchars(trim($_POST['pa']));
$mat = htmlspecialchars(trim($_POST['mat']));
$date = date('Y-m-d');

$balance = intval($sqty) + intval($qty);

$carburants->Approvisionner($balance, $carburant);
$add = $carburants->setOrder($fournisseur, $carburant, $livreur, $mat, $prix, $qty, $date, $id);

if ($add) {
    echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>Le fournisseur</strong> est enregistré avec succes.<br/>";
} else {
    echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
}


//
