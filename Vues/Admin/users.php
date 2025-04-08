<!-- main header @e -->
<!-- content @s -->
<div class="nk-content-body">
    <?php if ($_SESSION['role'] = 'admin'): ?>
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">

                <div class="nk-block-head-content">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user"><em class="icon ni ni-plus"></em><span>Nouvel Utilisateur</span></a>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
    <?php endif ?>
    <div class='col-sm-12' id="message"></div>
    <div class='col-sm-12 my-4' id="messages"></div>

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                        <tr class="tb-tnx-head">
                            <th>#</th>
                            <th>username</th>
                            <th>Statut</th>
                            <th>Act/Des</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cnt = 1;
                        foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $cnt ?></td>
                                <td><?= $user->username ?></td>
                                <?php
                                if ($user->statut == 0) {
                                    echo "<td> <span class='text-danger'> Desactiver</span></td>";
                                } else {
                                    echo "<td> <span class='text-success'> Activer</span></td>";
                                }
                                if ($user->statut == 0) {
                                    echo "<td><button type='button'  id='" . $user->id_user . "' name='activer' class='btn btn-xs btn-round btn-dark activers'><span class='glyphicon glyphicon-ok' ></span> Activer?</button></td>";
                                } else {
                                    echo "<td>	<button type='button'  id='" . $user->id_user . "' name='desactiver' class='btn btn-round btn-xs btn-danger desactivers'><span class='glyphicon glyphicon-remove' ></span> Desactiver?</button>
                                                            </td>";
                                } ?>
                                <td>

                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" id="<?= $user->id_user ?>" class="view_data"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                        <li><a href="#" class="delete" id="<?= $user->id_user ?>"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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


</div>
<!-- content @e -->
<!-- app-root @e -->
<!-- JavaScript -->

<?php
include('Public/modals/adduser.php');
// include 'Public/modals/edituser.php';
?>