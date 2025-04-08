
<?php 	
header('Content-type: application/json');
require_once '../../Models/Admin/carburant.class.php';
$carburants = new Carburant();

$productId = $_POST['productId'];
$add = $carburants->getCarburant($productId);

//  var_dump($row);
// if num_rows

// $connect->close();

echo json_encode($add);