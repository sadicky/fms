<?php
require_once('../../Models/Admin/user.class.php');
$users = new User();

$username = htmlspecialchars(trim($_POST['username']));
$pwd = htmlspecialchars(trim($_POST['pwd']));
$cpwd = htmlspecialchars(trim($_POST['cpwd']));
$id = htmlspecialchars(trim($_POST['id']));

@$getEmail = $users->getUsername($username);
// var_dump($getEmail);die();
        if($pwd!=$cpwd){
            echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>
            <strong  style='color:red'>Erreur:</strong> Les mots de passe doivent être identique.<br/>";
        }else{
            $add = $users->updateUser($username,$pwd,$id);   
            if($add){
                echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>Les données</strong> ont été modifié avec succes.<br/>";
                
            }
            else{
                echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
                }
            
        }


	//
?>
   