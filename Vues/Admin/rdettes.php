<div class="nk-content-body">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="nk-block">
                <div class="row">
                    <form role="form" method="post" class="form-inline" action="<?= WEBROOT ?>rdettes">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <b><label>Clients</label> <span class="text-danger"></span></b>
                                <select name="client" id="client" data-search="on" class='form-control js-select2' required>
                                    <option value="" disabled>Choisir un clientisseur</option>
                                    <option value='all'>Tous</option>
                                    <?php foreach ($tiers as $f) { ?>
                                        <option value='<?= $f->tier_id ?>'><?= $f->tiers ?></option>
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
            $client = $_POST['client'];
            ?>

            <div class="panel panel-default">
                <h4 class="panel-heading" align="center" style="color:blue">Rapport de Dettes</h4>

                <div class="panel-body">

                    <div class="col-md-12">

                        <hr>
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init-export nowrap table" data-export-title="Export" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Carburant</th>
                                                <th>Littre</th>
                                                <th>PU</th>
                                                <th>Montant</th>
                                                <th>Payé</th>
                                                <th>Dette</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();
                                        if ($client == 'all') {
                                            $ret = $db->query("SELECT tbl_vente.vente_id AS vente_id,tbl_vente.tiers_id AS tiers,tbl_vente.mtotal AS mtotal,
                                            tbl_vente.paye AS paye,tbl_vente.reste AS reste,tbl_devise.short,tbl_vente.bindex AS bindex,tbl_vente.aindex AS aindex,
                                            tbl_vente.datev AS datev,tbl_users.username,tbl_tiers.tiers,tbl_types.type as type,tbl_pompe.cpt as cpt,tbl_staff.noms as pompiste,
                                            tbl_vente_carburant.prix as prix,tbl_vente_carburant.qty as qty,tbl_pompe.code as pompe,tbl_tiers.tier_id
                                            FROM tbl_vente,tbl_vente_carburant,tbl_users,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
                                            WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
                                            and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
                                            and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id and tbl_vente.pompiste = tbl_staff.staff_id
                                            and tbl_vente.reste > 0 ORDER BY DATEV DESC");
                                        } else {
                                            $ret = $db->query("SELECT tbl_vente.vente_id AS vente_id,tbl_vente.tiers_id AS tiers,tbl_vente.mtotal AS mtotal,
                                            tbl_vente.paye AS paye,tbl_vente.reste AS reste,tbl_devise.short,tbl_vente.bindex AS bindex,tbl_vente.aindex AS aindex,
                                            tbl_vente.datev AS datev,tbl_users.username,tbl_tiers.tiers,tbl_types.type as type,tbl_pompe.cpt as cpt,tbl_staff.noms as pompiste,
                                            tbl_vente_carburant.prix as prix,tbl_vente_carburant.qty as qty,tbl_pompe.code as pompe,tbl_tiers.tier_id
                                            FROM tbl_vente,tbl_vente_carburant,tbl_users,tbl_tiers,tbl_devise,tbl_types,tbl_carburant,tbl_pompe,tbl_staff
                                            WHERE tbl_devise.devise_id= tbl_vente.devise_id and tbl_types.id_type = tbl_carburant.id_type 
                                            and tbl_vente_carburant.vente_id =tbl_vente.vente_id and tbl_vente_carburant.carburant_id =tbl_carburant.id_carburant
                                            and tbl_vente.tiers_id = tbl_tiers.tier_id and tbl_vente.pompe_id =tbl_pompe.pompe_id and tbl_vente.pompiste = tbl_staff.staff_id
                                            and tbl_vente.reste > 0 and tbl_vente.tiers_id='$client' ORDER BY DATEV DESC");
                                        }
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $user) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><a href="<?= WEBROOT ?>detailF?id=<?= $user->tier_id  ?>"><?= $user->tiers ?></a></td>
                                                <td><?= $user->type ?></td>
                                                <td><?= number_format($user->qty, 0, ',', ' ') ?>L</td>
                                                <td><?= number_format($user->prix, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->mtotal, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><?= number_format($user->paye, 0, ',', ' ') ?><?= $user->short ?></td>
                                                <td><b><?= number_format($user->reste, 0, ',', ' ') ?><?= $user->short ?></b></td>
                                                <td><?= $user->datev ?></td>
                                            </tr>
                                        <?php
                                        } ?>
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

