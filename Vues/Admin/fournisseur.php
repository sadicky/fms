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
                        <h4 class="page-header">Nouveau Fournisseur</h4>
                        <form method="post" id="formulaire_fournisseur">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Dénomination </label></b>
                                        <input type='text' name="fournisseur" placeholder="Nouveau Client" class="form-control" id="fournisseur" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Répresentant </label></b>
                                        <input type='text' name="rep" placeholder="Sadicky Dave" class="form-control" id="rep">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Téléphone </label></b>
                                        <input type='text' name="tel" placeholder="Numero de téléphone" class="form-control" id="tel">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>E-Mail </label></b>
                                        <input type='email' name="email" placeholder="company@abc.com" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Adresse de l'entreprise </label></b>
                                        <input type='text' name="adresse" placeholder="Adresse de l'entreprise" class="form-control" id="adresse">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b><label>Statut </label></b>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-search="on" id="statut" name="statut" >
                                            <option value="Active">Actif</option>
                                            <option value="Pending">En Attente</option>
                                            <option value="Terminated">Terminé</option>
                                        </select>
                                    </div>
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
                                <th>Fournisseur</th>
                                <th>Répresentant</th>
                                <th>E-Mail</th>
                                <th>Tel</th>
                <?php if($_SESSION['role']=='admin'):?>
                                <th>Statut</th>
                                <th>Actions</th>
                                <?php endif?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1;
                            foreach ($fournisseurs as $e) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $e->fournisseur ?></td>
                                    <td><?= $e->representant ?></td>
                                    <td><?= $e->email ?></td>
                                    <td><?= $e->tel ?></td>
                                    <?php if($_SESSION['role']=='admin'):?>
                                <?php
                                if ($e->statut =="Active") {
                                    echo "<td> <span class='text-primary'> Actif</span></td>";
                                } else if ($e->statut == "Pending")  {
                                    echo "<td> <span class='text-success'> En Attente</span></td>";
                                }else{
                                    echo "<td> <span class='text-danger'> Terminé</span></td>";
                                } ?>
                                    <td class="center">
                                        <button class='btn btn-info btn-xs btn-block view_data' id="<?= $e->fournisseur_id ?>" title='Modification'>
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