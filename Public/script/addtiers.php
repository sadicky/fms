<?php
require_once ('../../Models/Admin/tiers.class.php');
$e = new Tiers();

$tiers = htmlspecialchars(trim($_POST['tier']));
$tel = htmlspecialchars(trim($_POST['tel']));

$add = $e->setTiers($tiers,$tel);
if ($add) {
    echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
    <strong style='color:green'>Enregistré!!</strong> avec succes.<br/>";
} else {
    echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
}
 