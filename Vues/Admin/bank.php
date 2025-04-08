<!-- main header @e -->
<!-- content @s -->
<div class="nk-content-body">

    <div class='col-sm-12' id="message"></div>
    <div class='col-sm-12 my-4' id="messages"></div>

    <!-- /.col-lg-12 -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel-heading -->
            <div class="col-lg-12">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <h4 class="page-header">Nouvelle Banque</h4>
                        <form method="post" id="formulaire_bank">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b><label>Banque </label></b>
                                        <input type='text' name="bank" placeholder="Nouvelle banque" class="form-control" id="bank" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b><label>Montant </label></b>
                                        <input type='text' name="montant" placeholder="Montant initial" class="form-control" id="montant">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b><label>Numero de compte </label></b>
                                        <input type='text' name="numero" placeholder="Numero de compte" class="form-control" id="numero">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b><label>Dévise </label></b>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" id="devise" name="devise">
                                                <option value="">Select Role</option>
                                                <?php foreach ($getDevise as $e) : ?>
                                                    <option value="<?= $e->devise_id ?>"><?= $e->short ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <b><label># </label></b>
                                    <button class="btn btn-primary btn-block btn-sm" type="submit"><i class="fa fa-plus fa-fw"></i> Enregistrer </button>
                                </div>

                            </div>
                    </div>
                </div>
                </form>
            </div>
            <p></p>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init-export nowrap table" data-export-title="Export">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th>Bank</th>
                                <th>Numéro</th>
                                <th>Montant</th>
                                <th>Dévise</th>
                                <?php if($_SESSION['role']=='admin' ):?>
                                <th>Modifier</th>
                                <?php endif?>
                                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                                <th>Transferer</th>
                                <?php endif?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1;
                            foreach ($data as $e) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $e->bank ?></td>
                                    <td><?= $e->numero_compte ?></td>
                                    <td>
                                        <?php if ($e->devise_id == 1) : ?>
                                            <span class="badge badge-dot bg-primary"> <?= number_format($e->montant, 0, ',', ' ') ?> <?= $e->short ?></span>
                                    </td>
                                <?php elseif ($e->devise_id == 2) : ?>
                                    <span class="badge badge-dot bg-danger"> <?= number_format($e->montant, 0, ',', ' ') ?> <?= $e->short ?></span></td>
                                <?php endif ?>
                                <td><?= $e->devise ?></td>
                                <?php if($_SESSION['role']=='admin'):?>
                                <td>
                                    <button class='btn btn-info btn-xs btn-block view_bank' id="<?= $e->bank_id ?>" title='Modification'>
                                        <span class='icon ni ni-edit'></span>
                                    </button>
                                </td>
                                <?php endif ?>
                                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                                <td class="center">
                                    <a href="<?= WEBROOT ?>transfert?bank_id=<?= $e->bank_id ?>" class='btn btn-danger btn-xs btn-block' title='Transfert'>
                                        <span class='icon ni ni-arrow-right-circle'></span>
                                    </a>
                                </td>
                                <?php endif ?>
                                </tr>
                            <?php $cnt++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- .card-preview -->
        </div>
    </div><!-- .card-preview -->
    <!-- /.panel-body -->
</div>
<!-- content @e -->
<?php
include 'Public/modals/editbank.php';
?>