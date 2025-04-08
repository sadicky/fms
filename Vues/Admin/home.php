<?php
require_once('Models/Admin/connexion.php');
$db = getConnection();
$tdate = date('Y-m-d');
$sql = "select sum(mtotal)  as TOTAL,short from tbl_vente,tbl_devise WHERE datev='$tdate' 
and tbl_devise.devise_id=tbl_vente.devise_id and tbl_vente.devise_id='1'";
$req = $db->query($sql);
$req->execute();
$g = $req->fetch(PDO::FETCH_OBJ);
$sum_today = $g->TOTAL;
$short = $g->short;


$sql1 = "select sum(mtotal)  as TOTAL,short from tbl_vente,tbl_devise WHERE datev='$tdate' 
          and tbl_devise.devise_id=tbl_vente.devise_id and tbl_vente.devise_id='2'";
$req1 = $db->query($sql1);
$req1->execute();
$g1 = $req1->fetch(PDO::FETCH_OBJ);
$sum_today1 = $g1->TOTAL;
$short1 = $g1->short;
?>
    <div class="nk-block-head">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-prix"><em class="icon ni ni-edit"></em><span>Modifier les Prix</span></a>
    </div><!-- .nk-block-head -->
<div class='col-sm-12' id="message"></div>
<div class='col-sm-12 my-4' id="messages"></div>

<div class="row g-gs">
    <?php foreach ($carburants as $t) : ?>
        <div class="col-md-6 col-xxl-6">
            <div class="row g-gs">
                <div class="">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title text-center mb-2">
                                <span class="text-primary text-capitalize fw-bold"><?= date('D M jS Y') ?></span>
                                <div class="card-title">
                                    <span class="nk-menu-icon "><em class="icon ni ni-hot"></em></span>
                                    <h6 class="title mt-2">PRIX <?php echo strtoupper($t->type); ?></h6>
                                    <h4 class="text-primary fw-bold"><?= number_format($t->prix, 0, ',', ' ') . " Fc " ?>/ <?= $t->unity ?></h4>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    <?php endforeach ?>

    <div class="col-lg-3 col-xxl-12">
        <div class="row g-gs">
            <div class="">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group text-center mb-2">
                            <div class="card-title">
                                <h6 class="title ">Vente aujourdhui($)</h6>
                            </div>
                        </div>
                        <div class="flex-sm-wrap g-4 flex-md-nowrap">
                            <div class="nk-sale-data">
                                <h3 class="amount fw-bold text-info">
                                    <?php if ($sum_today == "") {
                                        echo "0" . $short;
                                    } else {
                                        echo "<h3 class='amount fw-bold text-info'>" . number_format($sum_today, 0, ',', ' ') . " " . $short . "</h3>";
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div>

    <div class="col-lg-3 col-xxl-12">
        <div class="row g-gs">
            <div class="">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group text-center mb-2">
                            <div class="card-title">
                                <h6 class="title">Vente aujourdhui</h6>
                            </div>
                        </div>
                        <div class="flex-sm-wrap g-4 flex-md-nowrap">
                            <div class="nk-sale-data">
                                <h3 class="amount fw-bold text-info">
                                    <?php if ($sum_today1 == "") {
                                        echo "0" . $short1;
                                    } else {
                                        echo "<h3 class='amount fw-bold text-info'>" . number_format($sum_today1, 0, ',', ' ') . " " . $short1 . "</h3>";
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div>

    <?php foreach ($carburants as $t) : ?>
        <div class="col-lg-3 col-xxl-12">
            <div class="row g-gs">
                <div class="">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title text-center mb-2">
                                <span class="text-danger text-capitalize fw-bold">Disponible</span>
                                <div class="card-title">
                                    <span class="nk-menu-icon "><em class="icon ni ni-hot"></em></span>
                                    <h6 class="title mt-2"><?php echo strtoupper($t->type); ?></h6>
                                    <h4 class="fw-bold text-danger"><?= number_format($t->qty, 0, ',', ' ') ?>/ <?= $t->unity ?></h4>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    <?php endforeach ?>
</div><!-- .row -->


<?php
include('Public/modals/prix.php');
// include 'Public/modals/edituser.php';
?>