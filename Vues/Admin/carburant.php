<?php if ($_SESSION['role'] != 'caissier'): ?>
    <div class="nk-content-body">
        <div class="nk-block-head-content">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-order"><em class="icon ni ni-plus"></em><span>Nouvelle Livraison</span></a>
            <a href="<?= WEBROOT ?>rlivraison" class="btn btn-info"><em class="icon ni ni-sign-usdc"></em><span>Historiques de Livraisons</span></a>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-head -->
<?php endif ?>
<div class='col-sm-12 my-4' id="message"></div>
<div class='col-sm-12 my-4' id="messages"></div>

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr class="tb-tnx-head">
                        <th>#</th>
                        <th>Carburant</th>
                        <th>Litres Dispo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1;
                    foreach ($carburants as $user) : ?>
                        <tr>
                            <td><?= $cnt ?></td>
                            <td class="fw-bold text-danger"><?= $user->type ?></td>
                            <td class="fw-bold"><?= number_format($user->qty, 0, ',', ' ') ?> Littres</td>
                        </tr>
                    <?php $cnt++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->


<?php
include('Public/modals/addorder.php');
// include 'Public/modals/edituser.php';
?>