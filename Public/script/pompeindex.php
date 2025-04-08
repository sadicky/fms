<?php
require_once('../../Models/Admin/carburant.class.php');
$carburants = new Carburant();
$pompe=$_POST['pompe'];
$dispo = $carburants->getPompeIndex($pompe);

echo "<input value='$dispo->cpt' type='hidden' name='bindex' id='bindex'>";

echo "<span style='color:red'> (index:".number_format($dispo->cpt, 0, ',', ' ').")</span>";
