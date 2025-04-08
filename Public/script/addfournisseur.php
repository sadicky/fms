<?php
require_once('../../Models/Admin/user.class.php');
$users = new User();

$fournisseur = htmlspecialchars(trim($_POST['fournisseur']));
$email = htmlspecialchars(trim($_POST['email']));
$tel = htmlspecialchars(trim($_POST['tel']));
$adresse = htmlspecialchars(trim($_POST['adresse']));
$ceo = htmlspecialchars(trim($_POST['rep']));
$statut = htmlspecialchars(trim($_POST['statut']));

// var_dump($_POST);die();
$add = $users->setFournisseur($fournisseur,$tel,$adresse,$email,$ceo,$statut);
if ($add) {
    echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>Le fournisseur</strong> est enregistré avec succes.<br/>";
                
} else {
    echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
}


//
