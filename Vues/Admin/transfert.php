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
                        <h4 class="page-header"></h4>
                        <form method="post" id="formulaire_transfert">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b><label><span id="resultat"></span></label></b>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 bank-change" data-search="on" id="bank" name="bank" required>
                                                <option value="">Select Bank</option>
                                                <?php foreach ($getBank as $e) : ?>
                                                    <option value="<?= $e->bank_id ?>"><?= $e->bank ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b><label>Banque </label></b>
                                        <input type='text' class="form-control" value="<?= $data->bank ?>" readonly>
                                        <input type='hidden' name="libelle" class="form-control" value="<?= $data->bank ?>" id="libelle">
                                        <input type='hidden' name="id" class="form-control" value="<?= $data->bank_id ?>" id="id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Montant Dispo dans (<?= $data->bank ?>)</label>
                                        <input readonly type="number" name="montantc" id="montantc" value="<?= $data->montant ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Montant à Transferer</label>
                                        <div id="resultat"></div>
                                        <input type="number" min="0" name="montant" id="montant" class="form-control" placeholder="Montant" required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <b><label># </label></b>
                                    <button class="btn btn-primary btn-block btn-sm" type="submit"><i class="fa fa-plus fa-fw"></i> Tranferer </button>
                                </div>

                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div><!-- .card-preview -->
    <!-- /.panel-body -->
</div>
<!-- content @e -->