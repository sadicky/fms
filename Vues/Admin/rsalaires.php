<!-- content @s -->

<div class="nk-content-body">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="nk-block">
                <div class="d-flex justify-content-end">
                    <form action="<?= WEBROOT ?>rsalaires" class="form-inline pull-left" method="post">
                        <button type="submit" class="btn btn-danger" name="tous"><em class="icon ni ni-eye-alt-fill"></em></button>
                    </form>
                </div>

                <div class="row">
                    <form role="form" method="post" class="form-inline" action="<?= WEBROOT ?>rsalaires">

                        <div class="col-sm-4 px-2">
                            <div class="form-group">

                                <label class="form-label">Mois</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="mois" name="mois">
                                        <option value="Janvier">Janvier</option>
                                        <option value="Fevrier">Fevrier</option>
                                        <option value="Mars">Mars</option>
                                        <option value="Avril">Avril</option>
                                        <option value="Mai">Mai</option>
                                        <option value="Juin">Juin</option>
                                        <option value="Juillet">Juillet</option>
                                        <option value="Aout">Aout</option>
                                        <option value="Septembre">Septembre</option>
                                        <option value="Octobre">Octobre</option>
                                        <option value="Novembre">Novembre</option>
                                        <option value="Decembre">Decembre</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 px-2">
                            <div class="form-group">

                                <label class="form-label">Année</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="annee" name="annee">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                        <option value="2036">2036</option>
                                        <option value="2037">2037</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 px-2">
                            <div class="form-group">
                                <b><label>Personnel</label> <span class="text-danger"></span></b>
                                <select name="staff" id="staff" data-search="on" class='form-control js-select2' required>
                                    <option value="" disabled>Choisir </option>
                                    <option value='all'>Tous</option>
                                    <?php foreach ($staffs as $f) { ?>
                                        <option value='<?= $f->staff_id ?>'><?= $f->noms ?></option>
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
            $mois = $_POST['mois'];
            $annee = $_POST['annee'];
            $staff = $_POST['staff'];
            ?>

            <div class="panel panel-default">
                <h4  align="center" style="color:blue">Rapport de Paiement-Salaire <?php echo $mois ?> - <?php echo $annee ?></h5>

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
                                                <th>Noms</th>
                                                <th>Montant</th>
                                                <th>Mois</th>
                                                <th>Annee</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();
                                        if ($staff == 'all') {
                                            $ret = $db->query("SELECT s.noms as noms, p.montant as montant,p.mois as mois, p.annee as annee,d.short as short,s.role as role
                                              FROM tbl_staff as s, tbl_paiement as p, tbl_devise as d
                                                          WHERE s.staff_id = p.staff_id and d.devise_id = p.devise_id
                                                          and p.mois='$mois' and p.annee='$annee'");
                                        } else {
                                            $ret = $db->query("SELECT s.noms as noms, p.montant as montant,p.mois as mois, p.annee as annee,d.short as short,s.role as role
                                             FROM tbl_staff as s, tbl_paiement as p, tbl_devise as d
                                            WHERE s.staff_id = p.staff_id and d.devise_id = p.devise_id
                                            and p.mois='$mois' and p.annee='$annee' and p.staff_id='$staff'");
                                        }
                                        $cnt = 1;
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $order) {
                                        ?>
                                            <tr class="odd gradeX">
                                                <td align="center"><b><?= $cnt ?></b></td>
                                                <td><b><?= $order->noms ?></b> (<?= $order->role ?>)</td>
                                                <td><b><?= number_format($order->montant, 0, ',', ' ') ?> <?= $order->short ?></b></td>
                                                <td><?= $order->mois ?></td>
                                                <td><?= $order->annee ?></td>
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
        <h5 class="panel-heading" align="center" style="color:blue">Rapport de Paiement Salaire </h5>
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
                                                <th>Noms</th>
                                                <th>Montant</th>
                                                <th>Mois</th>
                                                <th>Annee</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $db = getConnection();
                                        $ret = $db->query("SELECT s.noms as noms, p.montant as montant,p.mois as mois, p.annee as annee,d.short as short, s.role as role
                                        FROM tbl_staff as s, tbl_paiement as p, tbl_devise as d
                                                    WHERE s.staff_id = p.staff_id and d.devise_id = p.devise_id order by p.annee desc");

                                        $cnt = 1;
                                        $orders = $ret->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($orders as $order) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td align="center"><b><?= $cnt ?></b></td>
                                                <td><b><?= $order->noms ?></b> (<?= $order->role ?>)</td>
                                            <td><b><?= number_format($order->montant, 0, ',', ' ') ?> <?= $order->short ?></b></td>
                                            <td><?= $order->mois ?></td>
                                            <td><?= $order->annee ?></td>
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