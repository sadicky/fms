<?php
// require_once 'core.php';
session_start();
require_once '../../Models/Admin/connexion.php';
$connect = getConnection();

$valid['success'] = array('success' => false, 'messages' => array());
// print_r($_POST);
die();
if ($_POST) {
    $orderDate                         = $_POST['datev'];
    $pompe                             = $_POST['pompe'];
    $client                             = $_POST['client'];
    $totalAmountValue                 = $_POST['totalAmountValue'];
    $paid                             = $_POST['paid'];
    $dueValue                         = $_POST['dueValue'];
    $devise                            = $_POST['devise'];
    $date                                = date('Y-m-d');
    $userid                 = $_POST['pompiste'];
    $orderId = $_GET['id'];

    $sql = "UPDATE tbl_vente SET datev = '$orderDate', tiers_id = '$client', mtotal = '$totalAmountValue', paye = '$paid', reste = '$dueValue', devise_id='$devise', pompiste='$userid' WHERE vente_id = {$orderId}";
    $connect->query($sql);

    $readyToUpdateOrderItem = false;
    // add the quantity from the order item to product table
    for ($x = 0; $x < count($_POST['carburant']); $x++) {
        //  product table
        $updateProductQuantitySql = "SELECT qty FROM tbl_carburant WHERE  id_carburant = " . $_POST['carburant'][$x] . "";
        $updateProductQuantityData = $connect->prepare($updateProductQuantitySql);
        $updateProductQuantityData->execute();

        while ($updateProductQuantityResult = $updateProductQuantityData->fetch()) {
            // order item table add product quantity
            $orderItemTableSql = "SELECT qty FROM tbl_vente_carburant WHERE vente_id = {$orderId}";
            $orderItemResult = $connect->query($orderItemTableSql);
            $orderItemData = $orderItemResult->fetch();

            $editQuantity = $updateProductQuantityResult[0] + $orderItemData[0];

            $updateQuantitySql = "UPDATE tbl_carburant SET qty = $editQuantity WHERE id_carburant = " . $_POST['carburant'][$x] . "";
            $connect->query($updateQuantitySql);
        } // while	

        if (count($_POST['carburant']) == count($_POST['carburant'])) {
            $readyToUpdateOrderItem = true;
        }
    } // /for quantity

    // remove the order item data from order item table
    for ($x = 0; $x < count($_POST['carburant']); $x++) {
        $removeOrderSql = "DELETE FROM tbl_vente_carburant WHERE vente_id = {$orderId}";
        $connect->query($removeOrderSql);
    } // /for quantity

    if ($readyToUpdateOrderItem) {
        // insert the order item data 
        for ($x = 0; $x < count($_POST['carburant']); $x++) {
            $updateProductQuantitySql = "SELECT tbl_carburant.qty FROM tbl_carburant WHERE tbl_carburant.carburant_id = " . $_POST['carburant'][$x] . "";
            $updateProductQuantityData = $connect->query($updateProductQuantitySql);

            while ($updateProductQuantityResult = $updateProductQuantityData->fetch()) {
                $updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['qty'][$x];
                // update product table
                $updateProductTable = "UPDATE tbl_carburant SET qty = '" . $updateQuantity[$x] . "' WHERE carburant_id = " . $_POST['carburant'][$x] . "";
                $connect->query($updateProductTable);

                // add into order_item
                $orderItemSql = "INSERT INTO tbl_vente_carburant (vente_id, carburant_id, qty,prix, total) 
                    VALUES ('$order_id', '" . $_POST['carburant'][$x] . "', '" . $_POST['qte'][$x] . "', '" . $_POST['rate'][$x] . "', '" . $_POST['totalValue'][$x] . "')";

                $connect->query($orderItemSql);
            } // while	
        } // /for quantity
    }


    $valid['success'] = true;
    $valid['messages'] = "Successfully Added";

    echo "<script>window.location.href='../../index.php?p=ventes'</script>";
    echo json_encode($valid);
} // /if $_POST
// echo json_encode($valid);