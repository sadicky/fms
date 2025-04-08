<!-- /.col-lg-12 -->
<div class="row">
    <!-- /.panel-heading -->
    <div class="col-lg-4 my-2">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <form method="post" id="formulaire_devise">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <b><label>Dévise </label></b>
                                <input type='text' name="devise" placeholder="Dévise" class="form-control" id="devise">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <b><label>Short </label></b>
                                <input type='text' name="short" placeholder="Short" class="form-control" id="short">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <b><label>Taux </label></b>
                                <input type='text' name="taux" placeholder="Taux du Jours" class="form-control" id="short">
                            </div>
                        </div>

                        <div class="col-sm-12 my-2">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block btn-sm" type="submit"><i class="fa fa-plus fa-fw"></i> Créer</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 my-2">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                        <tr>
                            <th>Short</th>
                            <th>Taux</th>
                            <th>Primary</th>
                            <th>Supprimer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $e) : ?>
                            <tr class="odd gradeX">
                                <td><?= $e->short ?></td>
                                <td><?= $e->taux ?></td>
                                <td><?php
                                    if ($e->statut == '1') echo "<span class='label label-primary'>Dévise de Base</span>";
                                    else echo "<span class='label label-default'>Dévise de Contrepartie</span>";   ?>
                                </td><?php
                                        if ($e->statut == '0') : ?>
                                    <td><button type='button' id='<?= $e->devise_id ?>' name='delete' class='btn btn-xs btn-danger delete-devise'></span> Supprimer?</button></td>

                                    <td class="center">
                                        <button class='btn btn-info btn-xs btn-block view_devise' id="<?= $e->devise_id ?>" title='Modification'>
                                            <span class='icon ni ni-edit'></span>
                                        </button>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.panel-body -->
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
<?php
include 'Public/modals/editdevise.php';
?>