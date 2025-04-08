<?php

require_once('../../Models/Admin/bank.class.php');
$banks = new Bank();
$id = $_POST['bank'];
$dispo = $banks->getMontant($id);

echo "<input value='$dispo->montant' type='hidden' name='montantct' id='montantct'>";

echo $dispo->bank . " à <span style='color:red'>(" . number_format($dispo->montant, 0, ',', ' ') . "" . $dispo->short . ")</span>";
