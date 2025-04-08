<?php
require_once('../../Models/Admin/carburant.class.php');
$carburant = new Carburant();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$prix = isset($_POST['prix']) ? $_POST['prix'] : '';

$N = count($prix);
// var_dump($prixa);die();
for ($i = 0; $i < $N; $i++) {

	$add = $carburant->newPrice($prix[$i], $id[$i]);
	if ($add) {
		echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
			<strong style='color:green'>Enregistré!!</strong> avec succes.<br/>";
	} else {
		echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
	}
}
