<?php if ($_SESSION['role'] != 'caissier'): ?>
    <div class="nk-content-body">
        <div class="nk-block-head-content">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-pompe"><em class="icon ni ni-plus"></em><span>Ajouter Pompe</span></a>
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
                        <th>Code</th>
                        <th>Description</th>
                        <th>Type de Carburant</th>
                        <th>Index Actuel</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1;
                    foreach ($pompes as $user) : ?>
                        <tr>
                            <td><?= $cnt ?></td>
                            <td class="fw-bold"><?= $user->code ?></td>
                            <td class="text-danger"><?= $user->pompe ?></td>
                            <td><?= $user->type ?></td>
                            <td><?= number_format($user->cpt, 0, ',', '.') ?></td>
                            <td><?= $user->statut ?></td>
                        </tr>
                    <?php $cnt++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->


<?php
include('Public/modals/addpompe.php');
// include 'Public/modals/edituser.php';
?>