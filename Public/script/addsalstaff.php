<?php
require_once('../../Models/Admin/user.class.php');
$users = new User();

$staff = htmlspecialchars(trim($_POST['staff']));
$sal = htmlspecialchars(trim($_POST['sal']));
$devise = htmlspecialchars(trim($_POST['devise']));

$exist = $users->SalaireExist($staff); 
// var_dump($exist);die();
if(@$exist->staff!=$staff){
    $add = $users->setStaffSalaire($staff,$devise,$sal);
    if ($add) {
        echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                    <strong style='color:green'>Reussi</strong> Salaire enregistré avec succes.<br/>";
    } else {
        echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>Erreur d'insertion </span>";
    }
} else {
    echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>Verifie bien, le Salaire pour cette employé Existe déjà </span>";
}


//
