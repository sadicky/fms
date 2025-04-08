<?php
require_once('../../Models/Admin/carburant.class.php');
$carburants = new Carburant();
$carburant=$_POST['carburant'];
$dispo = $carburants->getCarburantDispo($carburant);

echo "<input value='$dispo->qty' type='hidden' name='sqty' id='sqty'>";

echo "<span style='color:red'>$dispo->qty</span> L";
