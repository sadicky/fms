<?php 	

require_once '../../Models/Admin/connexion.php';
$connect = getConnection();


$valid['success'] = array('success' => false, 'messages' => array());

// $orderId = 2;
$orderId = $_POST['orderId'];

if($orderId) { 
 $sql = $connect->query("DELETE FROM tbl_vente WHERE vente_id = $orderId");

 $orderItem =$connect->query("DELETE FROM tbl_vente_carburant WHERE vente_id = $orderId");
	
 if($sql == TRUE && $orderItem == TRUE) {
	$valid['success'] = true;
   $valid['messages'] = "Annulation avec succes";		
} else {
	$valid['success'] = false;
	$valid['messages'] = "Erreur";
}	
  
//  $connect->close();

 echo json_encode($valid);
 
} // /if $_POST