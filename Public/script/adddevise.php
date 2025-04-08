<?php
require_once ('../../Models/Admin/tiers.class.php');
$e = new Tiers();
// var_dump($_POST);die();
$devise = htmlspecialchars(trim($_POST['devise']));
$short = htmlspecialchars(trim($_POST['short']));
$taux = htmlspecialchars(trim($_POST['taux']));

$add = $e->setDevise($devise,$short,$taux);
if ($add) {
    echo "<span class='alert alert-success alert-lg col-sm-12'>Ajouté avec success
	<button type='button' class='close' data-dismiss='alert'>x</button></span>";
} else {
    echo "<span class='alert alert-danger alert-lg col-sm-12'>erreur d'insertion <button type='button' class='close' data-dismiss='alert'>x</button></span>";
}
 