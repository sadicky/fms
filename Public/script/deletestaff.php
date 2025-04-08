<?php
require_once('../../Models/Admin/user.class.php');
$devices = new User();
$id=isset($_POST['id'])?$_POST['id']:'';

if($id)
{
    $delete = $devices->deleteStaff($id);
	if ($delete) {
        echo "<span class='alert alert-success alert-lg col-sm-12'>Suppression effectuée avec success
        <button type='button' class='close' data-dismiss='alert'>x</button></span>";
    } else {
        echo "<span class='alert alert-danger alert-lg col-sm-12'>erreur de suppression <button type='button' class='close' data-dismiss='alert'>x</button></span>";
    }
}
	
?>