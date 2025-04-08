
<div class="nk-content-body">
    <div class="nk-block-head-content">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-salaire"><em class="icon ni ni-plus"></em><span>Ajouter</span></a>
        <a href="<?=WEBROOT?>rsalaires" class="btn btn-warning" ><em class="icon ni ni-sign-usdc"></em><span>Historiques</span></a>
        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#payer"><em class="icon ni ni-sign-usd"></em><span>Payer</span></a>
    </div><!-- .nk-block-head-content -->
</div><!-- .nk-block-head -->

<div class='col-sm-12 my-4' id="message"></div>
<div class='col-sm-12 my-4' id="messages"></div>

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr class="tb-tnx-head">
                        <th>#</th>
                        <th>Noms</th>
                        <th>Position</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Salaire</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1;
                    foreach ($data as $user) : ?>
                        <tr>
                            <td><?= $cnt ?></td>
                            <td><?= $user->noms ?></td>
                            <td><?= $user->role ?></td>
                            <td><?= $user->tel ?></td>
                            <td><?= $user->adress ?></td>
                            <td><?= $user->salaire ?> <?= $user->short ?></td>
                            <td>

                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" id="<?= $user->staff_id ?>" class="view_data"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                    <li><a href="#" class="delete-staff" id="<?= $user->staff_id ?>"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    <?php $cnt++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->


<?php
include('Public/modals/addsalaire.php');
include('Public/modals/payer.php');
// include 'Public/modals/edituser.php';
?>