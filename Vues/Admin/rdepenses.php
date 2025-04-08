<!-- content @s -->

<div class="nk-content-body">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="nk-block">
                <div class="d-flex justify-content-end">
                    <form action="<?= WEBROOT ?>rdepenses" class="form-inline pull-left" method="post">
                        <button type="submit" class="btn btn-danger" name="tous"><em class="icon ni ni-eye-alt-fill"></em></button>
                    </form>
                </div>

                <div class="row">
                    <form role="form" method="post" class="form-inline" action="<?= WEBROOT ?>rdepenses">

                        <div class="col-sm-4 px-2">
                            <div class="form-group">
                                <b><label>Du</label></b>
                                <input class="form-control" type="date" id="fromdate" name="fromdate" required="true">
                            </div>
                        </div>
                        <div class="col-sm-4 px-2">
                            <div class="form-group">
                                <b><label>Au</label></b>
                                <input class="form-control" type="date" id="todate" name="todate" required="true">
                            </div>
                        </div>
                        <div class="col-sm-4 px-2">
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
                                                <th>#</th>
                                                <th>Bénéficiaire</th>
                                                <th>Total</th>
                                                <th>Motif de dépense</th>
                                                <th>Date Entree</th>
                                                <th>Crée par</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        require_once('Models/Admin/caisse.class.php');
                                        $caisse = new Caisse();

                                        $depensedate = $caisse->getDepense($fdate, $tdate);
                                        foreach ($depensedate as $vente) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td align="center"><b><?= $vente->depense_id ?></b></td>
                                                <td><b><?= $vente->beneficiaire ?></b></td>
                                                <td><?= number_format($vente->montant, 0, ',', ' ') ?> <?= $vente->short ?></td>
                                                <td><?= $vente->motif ?></td>
                                                <td><?= $vente->date ?></td>
                                                <td><?= $vente->name ?></td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                    <?php
                                    //Yearly Expense

                                    $total1 = $caisse->getDepenseTotal1($fdate, $tdate);
                                    $total2 = $caisse->getDepenseTotal2($fdate, $tdate);
                                    $sum_total1 = $total1->montant;
                                    $sum_total2 = $total2->montant;
                                    $short1 = $total1->short;
                                    $short2 = $total2->short;

                                    if ($sum_total1) : ?> <h3 class="mt-2"> Total: <strong><?= number_format($sum_total1, 0, ',', ' ') ?><?= $short1 ?> et (<?= number_format($sum_total2, 0, ',', ' ') ?><?= $short2 ?> )</strong></h3>
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
                                                <th>#</th>
                                                <th>Bénéficiaire</th>
                                                <th>Total</th>
                                                <th>Motif de dépense</th>
                                                <th>Date Entree</th>
                                                <th>Crée par</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        require_once('Models/Admin/caisse.class.php');
                                        $caisse = new Caisse();
                                        $depenses = $caisse->getDepenses();

                                        foreach ($depenses as $vente) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td align="center"><b><?= $vente->depense_id ?></b></td>
                                            <td><b><?= $vente->beneficiaire ?></b></td>
                                            <td><?= number_format($vente->montant, 0, ',', ' ') ?> <?= $vente->short ?></td>
                                            <td><?= $vente->motif ?></td>
                                            <td><?= $vente->date ?></td>
                                            <td><?= $vente->name ?></td>
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