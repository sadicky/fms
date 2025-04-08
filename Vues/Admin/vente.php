<div class="nk-content-body">
    <?php if ($_SESSION['role'] != 'station'): ?>
        <div class="nk-block-head-content">
            <a href="<?= WEBROOT ?>order" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Nouvelle Vente</span></a>
        </div><!-- .nk-block-head-content -->
    <?php endif ?>
</div><!-- .nk-block-head -->

<div class='col-sm-12 my-4' id="message"></div>
<div class='col-sm-12 my-4' id="messages"></div>

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="table-responsive">
                <table class="datatable-init-export table table-condensed" data-export-title="Export">
                    <thead>
                        <tr class="tb-tnx-head">
                            <th>Carburant</th>
                            <th>Index</th>
                            <th>Littres</th>
                            <th>PU</th>
                            <th>Montant</th>
                            <th>Dette</th>
                            <th>Client</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ventes as $user) : ?>
                            <tr>
                                <td><?= $user->type ?></td>
                                <td class="text-danger"><?= $user->bindex ?> - <?= $user->aindex ?></td>
                                <td><?= $user->qty ?></td>
                                <td><?= $user->prix ?><?= $user->short ?></td>
                                <td><?= number_format($user->mtotal, 0, ',', '.') ?><?= $user->short ?></td>
                                <td><?= number_format($user->reste, 0, ',', '.') ?><?= $user->short ?></td>
                                <td><?= $user->tiers ?></td>
                                <td>
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <?php if ($user->reste != 0) : ?>
                                                            <li><a href="#" type="button" id="<?= $user->vente_id ?>" class="view_dette"><em class="icon ni ni-sign-usd-alt"></em><span>Payer</span></a></li>
                                                        <?php endif ?>
                                                        <?php if ($_SESSION['role'] == 'admin'): ?>
                                                        <li><a href="<?= WEBROOT ?>editVente?id=<?= $user->vente_id ?>"> <em class="icon ni ni-edit"></em> Edit</a></li>
                                                        <?php endif ?>
                                                        <li><a href="#" type="button" onclick="printOrder(<?= $user->vente_id ?>)"><em class="icon ni ni-printer"></em><span>Imprimer</span></a></li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->


<?php
include('Public/modals/addvente.php');
include 'Public/modals/editpaiement.php';
?>