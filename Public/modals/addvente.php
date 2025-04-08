 <!-- Add Room-->
 <div class="modal fade" tabindex="-1" role="dialog" id="add-pompe">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
             <div class="modal-body modal-body-md">
                 <h5 class="modal-title">Ajouter une nouvelle pompe</h5>

                 <form class="form-horizontal" method="POST" action="Public/script/createOrderm.php" id="formulaire-pompe">
                     <div class="row">
                         <!--/form-group-->
                         <div class="col-lg-3">
                             <div class="form-group" style="margin-left:0px;">
                                 <input type="date" class="form-control" id="datev" name="datev" required>
                             </div>
                         </div>
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <input type="hidden" readonly value="<?= date('Y-m-d') ?>" id="datev" name="datev" />
                                 <label for="orderDate" class="col-sm-3 control-label">Client</label>
                                 <select name="client" id="client" class='form-select js-select2' required>
                                     <option selected value="" disabled>Choisir Client</option>
                                     <?php foreach ($tiers as $f):?> ?>
                                         <option value='<?= $f->tiers_id ?>'><?= $f->tiers ?></option>
                                     <?php endforeach ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="orderDate" class="col-sm-3 control-label">Dévise</label>
                                 <select name="devise" id="devise" class='form-select js-select2' required>
                                     <option selected value="" disabled>Choisir Devise</option>
                                     <?php foreach ($devises as $f) :?> ?>
                                         <option value='<?= $f->devise_id ?>'><?= $f->short ?></option>
                                     <?php endforeach ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-3">
                             <div class="form-group" style="margin-right:0px;">
                                 <label for="orderDate" class="col-sm-3 control-label">Vente</label>
                                 <select name="typev" id="typev" class='select2' required>
                                     <option selected value="" disabled>Vente en</option>
                                     <option value='G'>Gros</option>
                                     <option value='D'>Détail</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <!--/form-group-->

                     <table class="table table-condensed table-stripped" id="productTable">
                         <thead>
                             <tr>
                                 <th style="width:35%;">Produit</th>
                                 <th style="width:20%;">Prix</th>
                                 <th style="width:10%;">Stock</th>
                                 <th style="width:15%;">Quantité</th>
                                 <th style="width:25%;">Total</th>
                                 <th style="width:10%;"></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                             
                                require_once('Models/Admin/connexion.php');
                                $connect = getConnection();
                                $productSql = "SELECT tbl_carburant.id_carburant,tbl_types.type FROM tbl_carburant,tbl_types WHERE tbl_carburant.id_type = tbl_types.id_type AND tbl_carburant.qty > '0'";
                                $productData = $connect->prepare($productSql);
                                $productData->execute();
                                $data = $productData->fetchAll(PDO::FETCH_ASSOC);
                                // var_dump($row);	
                                $arrayNumber = 0;
                                for ($x = 1; $x < 2; $x++) { ?>
                                 <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                     <td>
                                         <div class="form-group">
                                             <select class="select2" required name="article[]" id="article<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">
                                                 <option value="">Choisir un article</option>
                                                 <?php
                                                    foreach ($data as $row) {
                                                        echo "<option value='" . $row['ID'] . "' id='changeProduct" . $row['ID'] . "'>" . $row['CATEGORIE'] . " " . $row['MARQUE'] . " " . $row['ARTICLE'] . "</option>";
                                                    } // /while 

                                                    ?>
                                             </select>
                                         </div>
                                     </td>
                                     <td style="padding-left:30px;">
                                         <div class="form-group">
                                             <input type="hidden" name="depot" id="depot" value="<?= $_GET['id'] ?>" class="depot" />
                                             <input type="text" name="rate[]" id="rate<?= $x ?>" autocomplete="off" class="form-control" onkeyup="getTotal(<?php echo $x ?>)" />
                                             <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                         </div>
                                     </td>
                                     <td style="padding-left:20px;">
                                         <p class="text-danger text-bold" id="stockD<?= $x; ?>"></p>
                                     </td>
                                     <td style="padding-left:20px;">
                                         <div class="form-group">
                                             <input type="number" name="qte[]" id="qte<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                                         </div>
                                     </td>
                                     <td style="padding-left:30px;">
                                         <div class="form-group">
                                             <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                                             <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                         </div>
                                     </td>
                                     <td style="padding-left:30px;">
                                         <div class="form-group">
                                             <button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                         </div>
                                     </td>
                                 </tr>
                             <?php
                                    $arrayNumber++;
                                } // /for
                                ?>
                         </tbody>
                     </table>

                     <div class="col-md-4">
                         <div class="form-group">
                             <label for="paid" class="col-sm-3 control-label"> Payé</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" required />
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <!--/form-group-->
                         <div class="form-group">
                             <label for="due" class="col-sm-3 control-label"> Dû</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control" id="due" name="due" disabled="true" />
                                 <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <!--/form-group-->
                         <div class="form-group">
                             <label for="totalAmount" class="col-sm-3 control-label"> Total</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" />
                                 <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                             </div>
                         </div>
                     </div>
                     <button type="button" class="btn btn-default btn-sm pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> </button>


                     <!--/col-md-6-->
                     <hr>

                     <div class="text-center">
                         <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Sauvegarder</button>

                     </div>
                 </form>
             </div><!-- .modal-content -->
         </div><!-- .modal-dialog -->
     </div><!-- .modal -->
 </div>