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
                        <h4 class="page-header">Nouveau Client</h4>
                        <form method="post" id="formulaire_tiers">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Tier </label></b>
                                        <input type='text' name="tier" placeholder="Nouveau Client" class="form-control" id="tier" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Téléphone </label></b>
                                        <input type='text' name="tel" placeholder="Numero de téléphone" class="form-control" id="tel">
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                                <th>Client</th>
                                <th>Tel</th>
                                <?php if($_SESSION['role']=='admin'):?>
                                <th>Supprimer</th>
                                <th>Actions</th>
                                <?php endif?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1;
                            foreach ($tiers as $e) : ?>
                                <tr class="odd gradeX">
                                    <td><a href="<?=WEBROOT?>detailF?id=<?= $e->tier_id  ?>"><?= $e->tiers ?></a></td>
                                    <td><?= $e->tel ?></td>
                                    
                <?php if($_SESSION['role']=='admin'):?>
                                    <td><button type='button' id='<?= $e->tier_id ?>' name='delete' class='btn btn-xs btn-danger delete'></span> Supprimer?</button></td>

                                    <td class="center">
                                        <button class='btn btn-info btn-xs btn-block view_data' id="<?= $e->tier_id ?>" title='Modification'>
                                            <span class='icon ni ni-edit'></span>
                                        </button>

                                    </td>
                                    
                                <?php endif?>
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
<!-- app-root @e -->