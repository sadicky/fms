<?php
require_once ('../../Models/Admin/bank.class.php');
$e = new Bank();
// var_dump($_POST);die();
$bank = htmlspecialchars(trim($_POST['bank']));
$montant = htmlspecialchars(trim($_POST['montant']));
$numero = htmlspecialchars(trim($_POST['numero']));
$devise = htmlspecialchars(trim($_POST['devise']));

$add = $e->setBank($bank,$montant,$numero,$devise);
if ($add) {
    echo "<span class='alert alert-success alert-lg col-sm-12'>Ajouté avec success
	<button type='button' class='close' data-dismiss='alert'>x</button></span>";
} else {
    echo "<span class='alert alert-danger alert-lg col-sm-12'>erreur d'insertion <button type='button' class='close' data-dismiss='alert'>x</button></span>";
}
 