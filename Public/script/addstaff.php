<?php
require_once('../../Models/Admin/user.class.php');
$users = new User();

$noms = htmlspecialchars(trim($_POST['noms']));
$role = htmlspecialchars(trim($_POST['role']));
$tel = htmlspecialchars(trim($_POST['tel']));
$adresse = htmlspecialchars(trim($_POST['adresse']));
$statut = 1;

// var_dump($_POST);die();
$add = $users->setStaff($noms,$tel,$adresse,$role,$statut);
if ($add) {
    echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>Le membre</strong> est enregistré avec succes.<br/>";
                
} else {
    echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
}


//
