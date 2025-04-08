<?php
require_once('../../Models/Admin/carburant.class.php');
$carburants = new Carburant();

$carburant = htmlspecialchars(trim($_POST['carburant']));
$pompe = htmlspecialchars(trim($_POST['desc']));
$index = htmlspecialchars(trim($_POST['cpt']));
$code = htmlspecialchars(trim($_POST['code']));
$statut = htmlspecialchars(trim($_POST['statut']));

$add = $carburants->setPompe($pompe,$code,$statut,$index,$carburant);

if ($add) {
    echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>Pompe</strong> est enregistré avec succes.<br/>";
                
} else {
    echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
}


//
