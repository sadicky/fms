<?php
require_once('../../Models/Admin/market.class.php');
$tech = new Marketter();
$id=isset($_POST['id'])?$_POST['id']:'';

if($id)
{
    $active = $tech->desactivMarket($id);
	if($active) echo "avec succes";
	else echo "non ajoute";
}
	
?>