<?php
require_once('../../Models/Admin/bank.class.php');
$bank = new Bank();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$view = $bank->getBank($id);
?>


<form action="#" method="post" class="mt-2" id="formeditbank">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <b><label>Banque </label></b>
                <input type='text' name="bank" value="<?= $view->bank ?>" class="form-control" id="bank">
                <input type='hidden' name="id" value="<?= $view->bank_id ?>" id="id">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <b><label>Numero de compte </label></b>
                <input type='text' name="numero" value="<?= $view->numero_compte ?>" class="form-control" id="numero">
            </div>
        </div>
        <div class="col-sm-4">
            <b><label># </label></b>
            <button class="btn btn-primary edit-bank btn-block btn-sm" type="submit"><i class="fa fa-plus fa-fw"></i> Enregistrer </button>
        </div>

    </div>
</form>