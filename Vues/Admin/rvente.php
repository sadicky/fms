<!-- content @s -->

<div class="nk-content-body">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="nk-block">
                <div class="d-flex justify-content-end">
                    <form action="<?= WEBROOT ?>rvente" class="form-inline pull-left" method="post">
                        <button type="submit" class="btn btn-danger" name="tous"><em class="icon ni ni-eye-alt-fill"></em></button>
                    </form>
                </div>

                <div class="row">
                    <form role="form" method="post" class="form-inline" action="<?= WEBROOT ?>rvente">

                        <div class="col-sm-3 px-2">
                            <div class="form-group">
                                <b><label>Du</label></b>
                                <input class="form-control" type="date" id="fromdate" name="fromdate" required="true">
                            </div>
                        </div>
                        <div class="col-sm-3 px-2">
                            <div class="form-group">
                                <b><label>Au</label></b>
                                <input class="form-control" type="date" id="todate" name="todate" required="true">
                            </div>
                        </div>

                        <div class="col-sm-3 px-2">
                            <div class="form-group">
                                <b><label>Carburant</label> <span class="text-danger"></span></b>
                                <select name="carburant" id="carburant" data-search="on" class='form-control carburant js-select2' required>
                                    <option value="" >Choisir </option>
                                    <?php foreach ($carburants as $f) { ?>
                                        <option value='<?= $f->id_carburant ?>'><?= $f->type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 px-2">
                            <div class="form-group">
                                <b><label>Devise</label> <span class="text-danger"></span></b>
                                <select name="devise" id="devise" data-search="on" class='form-control js-select2' required>
                                    <option value="">Choisir une devise</option>
                                    <?php foreach ($getDevises as $f) { ?>
                                        <option value='<?= $f->devise_id ?>'><?= $f->short ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 px-2">
                            <div class="form-group">
                                <b><label></label></b><br>
                                <button type="submit" class="btn btn-primary" name="submit"><em class="icon ni ni-filter"></em> Filtrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_POST['submit'])) : ?>
        <div class="col-lg-12" style="padding-top:10px;">
            <?php
            $fdate = $_POST['fromdate'];
            $tdate = $_POST['todate'];
            $carburant = $_POST['carburant'];
            $devise = $_POST['devise'];

            // var_dump($carburant);die();
            ?>

            <div class="panel panel-default">
                <div class="panel-heading" align="center" style="color:blue">Rapport de Livraison du <?php echo $fdate ?> Au <?php echo $tdate ?>
                </div>

                <div class="panel-body">

                    <div class="col-md-12">

                        <hr>
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init-export nowrap table" data-export-title="Export" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Carburant</th>
                                                <th>Pompe</th>
                                                <th>Index Avant - Après</th>
                                                <th>Littre</th>
                                                <th>PU</th>
                                                <th>Montant</th>
                                                <th>Payé</th>
                                                <th>Reste</th>
                                                <th>Client</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();

                                        $ret = $db->query("SELECT tbl_vente.vente_id AS vente_id,tbl_vente.tiers_id,tbl_vente.mtotal AS mtotal,
                                                tbl_vente.paye AS paye,tbl_vente.reste AS reste,tbl_devise.short,tbl_vente.bindex AS bindex,tbl_vente.aindex AS aindex,
                                                tbl_vente.datev AS datev,tbl_tiers.tiers,tbl_types.type as type,tbl_pompe.cpt as cpt,tbl_staff.noms as pompiste,
                                                tbl_vente_carburant.prix as prix,tbl_vente_carburant.qty as qty,tbl_pompe.code as pompe
                                                FROM tbl_vente,tbl_vente_carburant,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
                                                WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
                                                and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
                                                and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id
                                                 and (datev BETWEEN '$fdate' and '$tdate')  and tbl_carburant.id_carburant like '%$carburant%' AND tbl_vente.devise_id like '%$devise%'");

                                        $ventes = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($ventes as $user) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?= $user->type ?></td>
                                                <td><?= $user->pompe ?></td>
                                                <td class="text-danger fw-bold"><?= number_format($user->bindex, 0, ',', '.') ?> - <?= number_format($user->aindex, 0, ',', '.') ?></td>
                                                <td><?= number_format($user->qty, 0, ',', ' ') ?>L</td>
                                                <td><?= number_format($user->prix, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->mtotal, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->paye, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->reste, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= $user->tiers ?></td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                    <?php
                                    //Yearly Expense	
                                    
                                    $db = getConnection();

                                    $ret1 = $db->query("SELECT sum(paye) AS montant, tbl_devise.short AS short
                                            FROM tbl_vente,tbl_vente_carburant,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
                                            WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
                                            and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
                                            and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id
                                             and (datev BETWEEN '$fdate' and '$tdate') AND tbl_vente.devise_id like '%$devise%' and tbl_carburant.id_carburant like '%$carburant%' and tbl_vente.devise_id");

                                    $total1 = $ret1->fetch(PDO::FETCH_OBJ);
                                    $sum_total1 = $total1->montant;
                                    $short1 = $total1->short;


                                    if ($sum_total1) : ?> <h3 class="mt-2"> Total Paiement: <strong><?= number_format($sum_total1, 0, ',', ' ') ?><?= $short1 ?> </strong></h3>
                                    <?php else : echo "<b class='badge bg-danger d-flex justify-content-center my-2 text-uppercase fw-bold'>Aucune valeur trouvée pour ces dates et ce fournisseur</b>";
                                    endif ?>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div><!-- /.panel-->
        </div>

    <?php endif ?>



    <?php if (isset($_POST['tous'])) : ?>
        <div class="col-lg-12" style="padding-top:10px;">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <hr />
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table id="dataTables-example" class="datatable-init-export nowrap table" data-export-title="Export" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Carburant</th>
                                                <th>Pompe</th>
                                                <th>Index Avant - Après</th>
                                                <th>Littre</th>
                                                <th>PU</th>
                                                <th>Montant</th>
                                                <th>Payé</th>
                                                <th>Reste</th>
                                                <th>Client</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        require_once('Models/Admin/vente.class.php');
                                        $caisse = new Vente();
                                        $depenses = $caisse->getVentes();

                                        foreach ($depenses as $user) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?= $user->type ?></td>
                                                <td><?= $user->pompe ?></td>
                                                <td class="text-danger fw-bold"><?= number_format($user->bindex, 0, ',', '.') ?> - <?= number_format($user->aindex, 0, ',', '.') ?></td>
                                                <td><?= number_format($user->qty, 0, ',', ' ') ?>L</td>
                                                <td><?= number_format($user->prix, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->mtotal, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->paye, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->reste, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= $user->tiers ?></td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- /.panel-->
        </div>

    <?php endif ?>
    <!-- .row -->
</div>