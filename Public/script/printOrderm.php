<!-- Bootstrap Core CSS -->
<link href="plugins/css/bootstrap.min.css" rel="stylesheet">
<?php

require_once '../../Models/Admin/connexion.php';
$connect = getConnection();

// $orderId = 32;
$orderId = $_POST['orderId'];
$orderDate = NULL;
$clientName = NULL;
$clientContact = NULL;

$sql = "SELECT v.vente_id as ID, tiers as TIERS, datev as DATEV,mtotal as MTOTAL,paye as PAYE,
reste as RESTE,short as SHORT,date as DATE,tel as TEL
 FROM tbl_vente as v,tbl_devise as d,tbl_tiers as t 
 WHERE v.vente_id = '$orderId' and v.devise_id=d.devise_id AND t.tier_id=v.tiers_id";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch();

// print_r($orderData);die();

$idf = $orderData['ID'];
$orderDate = $orderData['DATEV'];
$clientName = $orderData['TIERS'];
$clientContact = $orderData['TEL'];
$totalAmount = $orderData['MTOTAL'];
$grandTotal = $orderData['MTOTAL'];
$paid = $orderData['PAYE'];
$due = $orderData['RESTE'];
$devise = $orderData['SHORT'];

$orderItemSql = "SELECT tbl_vente_carburant.vente_id,  tbl_vente_carburant.qty as QTE,tbl_devise.short as SHORT,
tbl_vente_carburant.total as TOTAL,tbl_types.type as CARBURANT,tbl_vente_carburant.prix as PRIX
 FROM tbl_carburant,tbl_vente_carburant,tbl_devise,tbl_types
 WHERE tbl_vente_carburant.carburant_id = tbl_carburant.id_carburant AND tbl_carburant.id_type=tbl_types.id_type and tbl_vente_carburant.vente_id = $orderId ";
$orderItemResult = $connect->query($orderItemSql);


$table = '
 <div class="row">
    <div class="col-md-12">
       <div class="panel panel-default card-view"> 
          <div class="panel-wrapper collapse in">
             <div class="panel-body">
                <div class="row">
                <div class="col-xs-6">
                   <h3 class="txt-dark head-font inline-block capitalize-font mb-5">STATION MAKASI</h3>
                   <h4>Client: <b>' . $clientName . '</b></h4>          
                   <h4>Téléphone: <b>' . $clientContact . '</b></h4>
                </div>
                <div class="col-xs-6 text-right">
                   <span class="txt-dark head-font inline-block capitalize-font mb-5"><b>Bujumbura,le ' . $orderDate . '</b></span>
                   <h3 class="txt-dark head-font inline-block capitalize-font mb-5">Facture N°000' . $idf . '</h3>
               </div>
             </div>
               <i>Nb: Reçu de réception des biens sans taxes</i>
               <hr>               
                <div class="invoice-bill-table">
                   <div class="table-responsive">
                      <table class="table table-hover table-bordered">
                         <thead>
                            <tr>
                               <th>Carburant</th>
                               <th>Qte</th>
                               <th>P.U</th>
                               <th>P. Total</th>
                            </tr>
                         </thead>
                         <tbody> '; ?>

                              <?php while ($row = $orderItemResult->fetchObject()) {
                                 $table .= '<tr>
                                           <td>' . $row->CARBURANT . '</td>
                                          <td>' . $row->QTE . '</td>
                                          <td>' . round($row->PRIX, 3) . ' ' . $row->SHORT . '</td>
                                          <td>' . round($row->TOTAL, 2) . ' ' . $row->SHORT . '</td>
                                       </tr>
                                    ';
                                    }

                                    $table .= '               
                                 <tr  align="center"  class="txt-dark">
                               <td colspan="2">Payé</td>
                               <td colspan="2"><b>' . round($paid, 3) . ' ' . $devise . '</b></td>
                            </tr><tr  align="center"  class="txt-dark">
                            <td colspan="2">Reste</td>
                            <td colspan="2"><b>' . round($due, 3) . ' ' . $devise . '</b></td>
                         </tr>
                            <tr  align="center"  class="txt-dark">
                            <td colspan="2">Montant Total</td>
                            <td colspan="2"><b>' . round($totalAmount, 3) . ' ' . $devise . '</b></td>
                         </tr>
                         </tbody>
                      </table>
                   </div>
                   <div align="center" class="button-list">
                    </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- /Row -->

 ';
// $connect->close();

echo $table;
