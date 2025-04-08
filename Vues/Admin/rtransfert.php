<!-- content @s -->

<div class="nk-content-body">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="nk-block">
                <div class="d-flex justify-content-end">
                    <form action="<?= WEBROOT ?>rtransfert" class="form-inline pull-left" method="post">
                        <button type="submit" class="btn btn-danger" name="tous"><em class="icon ni ni-eye-alt-fill"></em></button>
                    </form>
                </div>

                <div class="row">
                    <form role="form" method="post" class="form-inline" action="<?= WEBROOT ?>rtransfert">

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
                                                <th>#1</th>
                                                <th>Bank T</th>
                                                <th>Bank R</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                <th>Par</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();

                                        $ret = $db->query("SELECT * FROM tbl_bank,tbl_bank_transaction,tbl_devise,tbl_users
                                        WHERE tbl_bank.devise_id = tbl_devise.devise_id
                                        and tbl_bank.bank_id = tbl_bank_transaction.bankr and tbl_bank_transaction.user_id=tbl_users.id_user
                                        and (datet BETWEEN '$fdate' and '$tdate')");

                                        $cnt = 1;
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $order) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td align="center"><?= $cnt ?></td>
                                                <td><?= $order->bankt ?></td>
                                                <td><?= $order->bank ?></td>
                                                <td><b><?= number_format($order->montant, 0, ',', ' ') ?><?= $order->short ?></b></td>
                                                <td><?= $order->datet ?></td>
                                                <td><?= $order->username ?></td>
                                            </tr>
                                        <?php $cnt++;
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
                                                <th>Bank T</th>
                                                <th>Bank R</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                <th>Par</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();
                                        $ret = $db->query("SELECT * FROM tbl_bank,tbl_bank_transaction,tbl_devise,tbl_users
                                        WHERE tbl_bank.devise_id = tbl_devise.devise_id
                                        and tbl_bank.bank_id = tbl_bank_transaction.bankr and tbl_bank_transaction.user_id=tbl_users.id_user order by datet desc");

                                        $cnt = 1;
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $order) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td align="center"><?= $cnt ?></td>
                                                <td><?= $order->bankt ?></td>
                                                <td><?= $order->bank ?></td>
                                                <td><b><?= number_format($order->montant, 0, ',', ' ') ?><?= $order->short ?></b></td>
                                                <td><?= $order->datet ?></td>
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