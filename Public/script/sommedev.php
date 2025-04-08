<?php

require_once('../../Models/Admin/bank.class.php');
$banks = new Bank();
$id = $_POST['devise'];
$dispo = $banks->getMontant($id);

echo "<input value='$dispo->montant' type='hidden' name='montantc' id='montantc'>";

echo "<span style='color:red'>" . number_format($dispo->montant, 0, ',', ' ') . "" . $dispo->short . "</span>";
