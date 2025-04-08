<?php
include('../../Public/includes/header.php');
require_once '../../Models/Admin/connexion.php';
$connect = getConnection();

// $orderId = 12;
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
FROM tbl_carburant,tbl_vente_carburant,tbl_devise,tbl_types,tbl_vente
WHERE tbl_vente_carburant.carburant_id = tbl_carburant.id_carburant AND tbl_carburant.id_type=tbl_types.id_type
and tbl_vente_carburant.vente_id = $orderId and tbl_vente.devise_id = tbl_devise.devise_id and tbl_vente_carburant.vente_id = tbl_vente.vente_id";
$orderItemResult = $connect->query($orderItemSql);
$data = $orderItemResult->fetchAll(PDO::FETCH_OBJ);
?>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="invoice">
                            <div class="invoice-wrap">
                                <div class="invoice-brand text-center">
                                    <img src="assets/images/favicon.png" srcset="assets/images/favicon.png" alt="logo">
                                </div>
                                <div class="invoice-head">
                                    <div class="row">
                                        <div class="col-4 mt-4">
                                            <div class="invoice-contact">
                                                <span class="overline-title">Facture à</span>
                                                <div class="invoice-contact-info">
                                                    <h4 class="title"><?= $clientName ?></h4>
                                                    <?php if (!empty($clientContact)) : ?>
                                                        <ul class="list-plain">
                                                            <li><em class="icon ni ni-call-fill"></em><span><?= $clientContact ?></span></li>
                                                        </ul>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4"></div>
                                        <div class="col-4">
                                            <div class="invoice-desc">
                                                <h3 class="title">Facture</h3>
                                                <ul class="list-plain">
                                                    <li class="invoice-id"><span>N°</span>:<span>000<?= $idf ?></span></li>
                                                    <li class="invoice-date"><span>Date</span>:<span><?= $orderDate ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .invoice-head -->
                                <div class="invoice-bills">
                                    <div class="table-responsive">
                                        <table class="table table-condensed table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="w-60">Carburant</th>
                                                    <th>Littre</th>
                                                    <th>Prix</th>
                                                    <th>Montant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data as $row) : ?>
                                                    <tr>
                                                        <td><?= $row->CARBURANT ?></td>
                                                        <td><?= $row->QTE ?>l</td>
                                                        <td><?= number_format($row->PRIX, 0, ',', '.') ?><?= $row->SHORT ?></td>
                                                        <td><?= number_format($row->TOTAL, 0, ',', '.') ?><?= $row->SHORT ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="1"></td>
                                                    <td colspan="1"></td>
                                                    <td colspan="1">Payé</td>
                                                    <td><?= number_format($paid, 0, ',', '.') ?><?= $devise ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1"></td>
                                                    <td colspan="1"></td>
                                                    <td colspan="1">Reste</td>
                                                    <td><?= number_format($due, 0, ',', '.') ?><?= $devise ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1"></td>
                                                    <td colspan="1"></td>
                                                    <td colspan="1">Montant Total</td>
                                                    <td><?= number_format($totalAmount, 0, ',', '.') ?><?= $devise ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="nk-notes ff-italic fs-12px text-soft"> Nb: Reçu de réception des biens sans taxes </div>
                                    </div>
                                </div><!-- .invoice-bills -->
                            </div><!-- .invoice-wrap -->
                        </div><!-- .invoice -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>