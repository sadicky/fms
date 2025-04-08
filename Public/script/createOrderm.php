<?php
session_start();
require_once '../../Models/Admin/connexion.php';
// require_once('../../Models/Admin/historic.class.php');
// $hist = new Historics();
$connect = getConnection();

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// echo($_POST['client']);die();
if ($_POST) {
	$orderDate 						= $_POST['datev'];
	$pompe 					        = $_POST['pompe'];
	$client 					        = $_POST['client'];
	$totalAmountValue                 = $_POST['totalAmountValue'];
	$paid                             = $_POST['paid'];
	$dueValue 						= $_POST['dueValue'];
	$devise				            = $_POST['devise'];
	$date								= date('Y-m-d');
	$bindex							= $_POST['bindex'];
	$aindex							= $bindex + $_POST['qte'][0];
	// $userid 				= $_POST['pompiste'];

	$sql = "INSERT INTO tbl_vente (datev, pompe_id,tiers_id, mtotal,bindex,aindex,paye, reste,date,devise_id) VALUES 
	('$orderDate', '$pompe', '$client','$totalAmountValue', '$bindex','$aindex','$paid', '$dueValue','$date','$devise')";

	$order_id;
	$orderStatus = false;
	$connect->query($sql);
	$order_id = $connect->lastInsertId();
	$valid['order_id'] = $order_id;

	$orderStatus = true;
	$orderItemStatus = false;

	for ($x = 0; $x < count($_POST['carburant']); $x++) {
		$updateProductQuantitySql = "SELECT qty FROM tbl_carburant WHERE id_carburant = " . $_POST['carburant'][$x] . "";
		$updateProductQuantityData = $connect->prepare($updateProductQuantitySql);
		$updateProductQuantityData->execute();
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['qte'][$x];
			// update product table
			$updateProductTable = "UPDATE tbl_carburant SET qty = '" . $updateQuantity[$x] . "' WHERE id_carburant = " . $_POST['carburant'][$x] . "";
			$connect->query($updateProductTable);

			$updateCpt = "UPDATE tbl_pompe SET cpt = '" . $aindex . "' WHERE pompe_id = " . $_POST['pompe'] . "";
			$connect->query($updateCpt);

			// add into order_item
			$orderItemSql = "INSERT INTO tbl_vente_carburant (vente_id, carburant_id, qty,prix, total) 
				VALUES ('$order_id', '" . $_POST['carburant'][$x] . "', '" . $_POST['qte'][$x] . "', '" . $_POST['rate'][$x] . "', '" . $_POST['totalValue'][$x] . "')";

			$connect->query($orderItemSql);

			// $date  = date('Y-m-d H:i:s');

			// $add4=$hist->setHistoricOrder($_POST['carburant'][$x],$_POST['qte'][$x],$date,$aindex,$bindex,$userid);

			if ($x == count($_POST['carburant'])) {
				$orderItemStatus = true;
			}
		} // while	
	} // /for quantity

	if ($devise == 1) {
		$sql = "SELECT montant FROM tbl_bank WHERE bank_id=1";
		$data = $connect->query($sql);
		$data->execute();
		$da = $data->fetchObject();
		$fromdb = $da->montant;

		$somme = $paid + $fromdb;

		$updateSomme = "UPDATE tbl_bank SET montant = '" . $somme . "' WHERE bank_id = 1";
		$connect->query($updateSomme);
	} else if ($devise == 2) {

		$sql = "SELECT montant FROM tbl_bank WHERE bank_id=2";
		$data = $connect->query($sql);
		$data->execute();
		$da = $data->fetchObject();
		$fromdb = $da->montant;

		$somme = $paid + $fromdb;

		$updateSomme = "UPDATE tbl_bank SET montant = '" . $somme . "' WHERE bank_id = 2";
		$connect->query($updateSomme);
	}

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";

	echo "<script>window.location.href='../../index.php?p=ventes'</script>";
	echo json_encode($valid);
} // /if $_POST
// echo json_encode($valid);