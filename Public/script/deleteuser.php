<?php
require_once('../../Models/Admin/user.class.php');
$devices = new User();
$id=isset($_POST['id'])?$_POST['id']:'';

if($id)
{
    $delete = $devices->deleteUser($id);
	if($delete)
	echo "<script>window.location.href='index.php?page=users'</script>";
	else echo "non ajoute";
}
	
?>