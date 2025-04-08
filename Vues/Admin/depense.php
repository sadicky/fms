<div class="nk-content-body">
    <div class="nk-block-head-content">
        
    <?php if ($_SESSION['role'] != 'station'): ?>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-dep"><em class="icon ni ni-plus"></em><span>Nouvelle</span></a>
        <a href="<?= WEBROOT ?>rdepenses" class="btn btn-warning"><em class="icon ni ni-sign-usdc"></em><span>Historiques</span></a>
   <?php endif?>
    </div><!-- .nk-block-head-content -->
</div><!-- .nk-block-head -->

<div class='col-sm-12 my-4' id="message"></div>
<div class='col-sm-12 my-4' id="messages"></div>
<!-- /.panel-heading -->
<div class="card card-bordered card-preview">
    <div class="card-inner">
        <table class="datatable-init-export nowrap table" data-export-title="Export">
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
            <tbody>
                <?php $cnt = 1;
                foreach ($depenses as $vente) : ?>
                    <tr class="odd gradeX">
                        <td align="center"><b><?= $vente->depense_id ?></b></td>
                        <td><b><?= $vente->beneficiaire ?></b></td>
                        <td><?= number_format($vente->montant, 0, ',', ' ') ?> <?= $vente->short ?></td>
                        <td><?= $vente->motif ?></td>
                        <td><?= $vente->date ?></td>
                        <td><?= $vente->name ?></td>

                    </tr>
                <?php $cnt++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'Public/modals/adddep.php';?>