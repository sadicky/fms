<!-- content @s -->

<div class="nk-content-body">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="nk-block">
                <div class="d-flex justify-content-end">
                    <form action="<?= WEBROOT ?>rlivraison" class="form-inline pull-left" method="post">
                        <button type="submit" class="btn btn-danger" name="tous"><em class="icon ni ni-eye-alt-fill"></em></button>
                    </form>
                </div>

                <div class="row">
                    <form role="form" method="post" class="form-inline" action="<?= WEBROOT ?>rlivraison">

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
                                <select name="carburant" id="carburant" data-search="on" class='form-control js-select2' required>
                                    <option value="" disabled>Choisir </option>
                                    <?php foreach ($carburants as $f) { ?>
                                        <option value='<?= $f->id_carburant ?>'><?= $f->type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 px-2">
                            <div class="form-group">
                                <b><label>Fournisseur</label> <span class="text-danger"></span></b>
                                <select name="fourn" id="fourn" data-search="on" class='form-control js-select2' required>
                                    <option value="" disabled>Choisir un Fournisseur</option>
                                    <option value='all'>Tous</option>
                                    <?php foreach ($getF as $f) { ?>
                                        <option value='<?= $f->fournisseur_id ?>'><?= $f->fournisseur ?></option>
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
            $fourn = $_POST['fourn'];
            $carburant = $_POST['carburant'];
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
                                                <th>#</th>
                                                <th>Carburant</th>
                                                <th>Qty</th>
                                                <th>Fournisseur</th>
                                                <th>Livreur</th>
                                                <th>Date Entree</th>
                                                <th>Par</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();
                                        if ($fourn == 'all') {
                                            $ret = $db->query("SELECT * FROM tbl_users as u, tbl_order as o,tbl_carburant as c,tbl_fournisseur as f,tbl_types as t
                                                          WHERE o.carburant_id = c.id_carburant and o.fournisseur_id = f.fournisseur_id and o.user_id = u.id_user 
                                                          and t.id_type  = c.id_type and c.id_carburant='$carburant' and (o.datel BETWEEN '$fdate' and '$tdate')");
                                        } else {
                                            $ret = $db->query("SELECT * FROM tbl_users as u, tbl_order as o,tbl_carburant as c,tbl_fournisseur as f,tbl_types as t
                                            WHERE o.carburant_id = c.id_carburant and o.fournisseur_id = f.fournisseur_id and o.user_id = u.id_user 
                                            and t.id_type = c.id_type and c.id_carburant='$carburant' and (o.datel BETWEEN '$fdate' and '$tdate') and f.fournisseur_id='$fourn'");
                                        }
                                        $cnt = 1;
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $order) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td align="center"><b><?= $cnt ?></b></td>
                                                <td><b><?= $order->type ?></b></td>
                                                <td><b><?= number_format($order->littre, 0, ',', ' ') ?> L</b></td>
                                                <td><b><?= $order->fournisseur ?></b></td>
                                                <td><?= $order->livreur ?></td>
                                                <td><?= $order->datel ?></td>
                                                <td><?= $order->username ?></td>
                                            </tr>
                                        <?php $cnt++;
                                        } ?>

                                        <?php
                                        //Yearly Expense

                                        if ($fourn == 'all') {
                                            $query = "SELECT sum(littre) as littre,t.type as carb FROM tbl_users as u, tbl_order as o,tbl_carburant as c,tbl_fournisseur as f,tbl_types as t
                                                          WHERE o.carburant_id = c.id_carburant and o.fournisseur_id = f.fournisseur_id and o.user_id = u.id_user 
                                                          and t.id_type  = c.id_type and c.id_carburant='$carburant'  and (o.datel BETWEEN '$fdate' and '$tdate')";
                                            $req = $db->query($query);
                                            $req->execute();
                                            $g = $req->fetch(PDO::FETCH_OBJ);
                                            $sum_total = $g->littre;
                                            $c = $g->carb;
                                            if ($sum_total) echo "<h3>Total: <span style='color:blue'>" . number_format($sum_total, 0, ',', ' ') . " Littres (" . $c . ")</span></h3>";
                                            else echo "<b class='d-flex justify-content-center badge bg-danger my-2 text-uppercase fw-bold'>Aucune valeur trouvée pour ces dates, ce fournisseur et ce carburant</b>";
                                        } else {
                                            $query = "SELECT sum(littre) as littre,f.fournisseur as names,t.type as carb FROM tbl_users as u, tbl_order as o,tbl_carburant as c,tbl_fournisseur as f,tbl_types as t
                                            WHERE o.carburant_id = c.id_carburant and o.fournisseur_id = f.fournisseur_id and o.user_id = u.id_user 
                                            and t.id_type  = c.id_type and c.id_carburant='$carburant'  and (o.datel BETWEEN '$fdate' and '$tdate')and f.fournisseur_id='$fourn' ";

                                            $req = $db->query($query);
                                            $req->execute();
                                            $g = $req->fetch(PDO::FETCH_OBJ);
                                            $sum_total = $g->littre;
                                            $c = $g->carb;
                                            if ($sum_total) echo "<h3>Total de livraison de " . $g->names . ": <span style='color:blue'>" . number_format($sum_total, 0, ',', ' ') . " L(" . $c . ")</span></h3>";
                                            else echo "<b class='badge bg-danger d-flex justify-content-center my-2 text-uppercase fw-bold'>Aucune valeur trouvée pour ces dates et ce fournisseur</b>";
                                        }
                                        ?>

                                    </table>
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
                                                <th>#</th>
                                                <th>Carburant</th>
                                                <th>Qty</th>
                                                <th>Fournisseur</th>
                                                <th>Livreur</th>
                                                <th>Date Entree</th>
                                                <th>Par</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();
                                        $ret = $db->query("SELECT * FROM tbl_users as u, tbl_order as o,tbl_carburant as c,tbl_fournisseur as f,tbl_types as t
                                        WHERE o.carburant_id = c.id_carburant and o.fournisseur_id = f.fournisseur_id and o.user_id = u.id_user 
                                        and t.id_type  = c.id_type order by o.order_id desc");

                                        $cnt = 1;
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $order) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td align="center"><b><?= $cnt ?></b></td>
                                                <td><b><?= $order->type ?></b></td>
                                                <td><b><?= number_format($order->littre, 0, ',', ' ') ?>L</b></td>
                                                <td><b><?= $order->fournisseur ?></b></td>
                                                <td><?= $order->livreur ?></td>
                                                <td><?= $order->datel ?></td>
                                                <td><?= $order->username ?></td>
                                            </tr>
                                        <?php
                                            $cnt = $cnt + 1;
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