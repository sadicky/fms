<?php

require_once('../../Models/Admin/tiers.class.php');
$bank = new Tiers();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$view = $bank->getDeviseId($id);
?>


<form action="#" class="mt-2" id="formeditdevise">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <b><label>Dévise </label></b>
                <input type='text' name="devise" value="<?= $view->devise ?>" class="form-control" id="devise">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <b><label>Short </label></b>
                <input type='text' name="short" value="<?= $view->short ?>" class="form-control" id="short">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <b><label>Taux </label></b>
                <input type='text' name="taux" value="<?= $view->taux ?>" class="form-control" id="short">
            </div>
        </div>

        <div class="col-sm-12 my-2">
            <div class="form-group">
                <button class="btn btn-primary btn-block btn-sm" type="submit"><i class="fa fa-plus fa-fw"></i> Créer</button>
            </div>
        </div>

    </div>
</form>