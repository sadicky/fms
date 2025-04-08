<?php
require_once('../../Models/Admin/tech.class.php');
$tech = new Technician();
$id=isset($_POST['id'])?$_POST['id']:'';

if($id)
{
    $active = $tech->desactivTech($id);
	if($active) echo "avec succes";
	else echo "non ajoute";
}
	
?>