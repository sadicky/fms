<div class='col-sm-12 my-4' id="message"></div>
<div class='col-sm-12 my-4' id="messages"></div>

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form class="form-horizontal" method="POST" action="Public/script/createOrderm.php">
                <div class="row">
                    <!--/form-group-->
                    <div class="col-md-4">
                        <div class="form-group" style="margin-left:0px;">
                            <label for="orderDate" class="col-sm-3 control-label">Date</label>
                            <input type="date" class="form-control" id="datev" name="datev" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="orderDate" class="col-sm-3 control-label">Client</label>
                            <select name="client" data-search="on" id="client" class='form-select js-select2' required>
                                <option selected value="" disabled>Choisir Client</option>
                                <?php foreach ($tiers as $f) : ?> ?>
                                    <option value='<?= $f->tier_id ?>'><?= $f->tiers ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="orderDate" class="control-label">Dévise</label>
                            <select name="devise" id="devise" data-search="on" class='form-select js-select2' required>
                                <option selected value="" disabled>Choisir Devise</option>
                                <?php foreach ($devises as $f) : ?> ?>
                                    <option value='<?= $f->devise_id ?>'><?= $f->short ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!--/form-group-->

                <table class="table table-condensed table-stripped my-3" id="productTable">
                    <thead>
                        <tr class="align-justify">
                            <th style="width:35%;">Carburant</th>
                            <th style="width:20%;">Prix</th>
                            <th style="width:10%;">Stock</th>
                            <th style="width:15%;">Quantité</th>
                            <th style="width:35%;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require_once('Models/Admin/connexion.php');
                        $connect = getConnection();
                        $productSql = "SELECT tbl_carburant.id_carburant,tbl_types.type FROM tbl_carburant,tbl_types WHERE tbl_carburant.id_type = tbl_types.id_type AND tbl_carburant.qty > '0'";
                        $productData = $connect->prepare($productSql);
                        $productData->execute();
                        $data = $productData->fetchAll(PDO::FETCH_OBJ);
                        // var_dump($data);die();	
                        $arrayNumber = 0;
                        for ($x = 1; $x < 2; $x++) { ?>
                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                <td>
                                    <div class="form-group">
                                        <select class="form-select js-select2 carburant" required name="carburant[]" id="carburant<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">
                                            <option value="">Choisir un carburant</option>
                                            <?php foreach ($data as $row) {
                                                echo "<option value='" . $row->id_carburant . "' id='changeProduct" . $row->id_carburant  . "'>" . $row->type . "</option>";
                                            } // /while 

                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td style="padding-left:30px;">
                                    <div class="form-group">
                                        <input type="text" name="rate[]" id="rate<?= $x ?>" autocomplete="off" class="form-control" onkeyup="getTotal(<?php echo $x ?>)" />
                                        <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                    </div>
                                </td>
                                <td style="padding-left:20px;">
                                    <p class="text-danger text-bold" id="stockD<?= $x; ?>"></p>
                                </td>
                                <td style="padding-left:20px;">
                                    <div class="form-group">
                                        <input type="varchar" name="qte[]" id="qte<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                                    </div>
                                </td>
                                <td style="padding-left:30px;">
                                    <div class="form-group">
                                        <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                                        <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $arrayNumber++;
                        } // /for
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="orderDate" class="control-label">Pompe<span id="resultat"></span></label>
                            <select name="pompe" id="pompe" class='form-select js-select2 join pompe-change' required>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="paid" class=" control-label"> Payé</label>
                            <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!--/form-group-->
                        <div class="form-group">
                            <label for="due" class="control-label"> Dû</label>
                            <input type="text" class="form-control" id="due" name="due" disabled="true" />
                            <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!--/form-group-->
                        <div class="form-group">
                            <label for="totalAmount" class=" control-label"> Total</label>
                            <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" />
                            <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                        </div>
                    </div>
                </div>
                <!--/col-md-6-->
                <hr>

                <div class="text-center">
                    <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>

                </div>
            </form>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->


<?php
// include 'Public/modals/edituser.php';
?>