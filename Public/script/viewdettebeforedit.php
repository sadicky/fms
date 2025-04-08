<?php
require_once('../../Models/Admin/vente.class.php');
$bank = new Vente();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$view = $bank->getVenteId($id);
?>


<form action="#" method="post" id="formeditdette">
    <div class="row g-gs">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="bed-no-add">Total </label>
                <input type='number' readonly  value="<?=$view->total?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="bed-no-add">Déjà Payé </label>
                <input type='number' readonly name="paid" value="<?=$view->paye?>" class="form-control" id="paid">
                <input type='hidden' readonly name="due" value="<?=$view->reste?>" class="form-control" id="due">
                <input type='hidden' readonly name="id" value="<?=$id?>" class="form-control" id="id">
                <input type='hidden' readonly name="total" value="<?=$view->total?>" class="form-control" id="total">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="bed-no-add">Dette (<b><?= $view->reste?></b>)  </label>
                <input type='number' name="montant" class="form-control" placeholder="Payer la dette" id="montant">
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-info btn-block btn-md submit" type="submit"><i class="fa fa-plus fa-fw"></i> Valider </button>
        </div>

    </div>
</form>