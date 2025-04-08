<?php
require_once('../../Models/Admin/user.class.php');
$users = new User();

$username = htmlspecialchars(trim($_POST['username']));
$role = htmlspecialchars(trim($_POST['role']));
$pwd = htmlspecialchars(trim($_POST['pwd']));
$cpwd = htmlspecialchars(trim($_POST['cpwd']));

@$getEmail = $users->getUsername($username);
// var_dump($getEmail);die();
    if(@$getEmail->username!=$username){
        if($pwd!=$cpwd){
            echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>
            <strong  style='color:red'>Erreur:</strong> Les mots de passe doivent être identique.<br/>";
        }else{
            $add = $users->setUser($username,$pwd,$role);  
            if($add){
                echo "<span class='alert alert-pro alert-success alert-dismissible fw-bold col-sm-12'>
                <strong style='color:green'>L'tilisateur</strong> est enregistré avec succes.<br/>";
                
                // echo "<script>window.location.href='index.php?p=users'</script>";  
            }
            else{
                echo "<span class='alert alert-pro alert-dismissible alert-danger fw-bold col-sm-12'>erreur d'insertion </span>";
                }
            
        }

    }
    else{
    echo "<span class='alert alert-danger alert-pro alert-dismissible fw-bold col-12'>ce username existe déjà </span>";
    }

	//
?>
   