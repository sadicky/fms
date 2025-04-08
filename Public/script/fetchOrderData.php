<?php 	
require_once '../../Models/Admin/connexion.php';
$connect = getConnection();

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$statement = $connect->prepare("SELECT tbl_vente.vente_id, tbl_vente.datev, tbl_vente.tiers_id,  tbl_vente.mtotal,
  tbl_vente.paye, tbl_vente.reste, tbl_vente.aindex, tbl_vente.bindex FROM tbl_vente 	
	WHERE tbl_vente.vente_id = {$orderId}");

$statement->execute();
$data =  $statement->fetchAll();
$valid['order'] = $data;


// $connect->close();


echo json_encode($valid);