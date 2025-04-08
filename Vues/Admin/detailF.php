<div class='col-sm-12' id="message"></div>
<!-- /.col-lg-12 -->
<div class="panel-heading">
  Info du Client <strong style="color:red">(<?php echo  $data->tiers; ?>)</strong>
</div>
<!-- /.panel-heading -->
<div class="row-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card card-bordered card-preview">
        <div class="card-inner">
          <table class="datatable-init-export nowrap table" data-export-title="Export">
            <thead>
              <th>#</th>
              <th>Total</th>
              <th>Payé</th>
              <th>Reste</th>
              <th>Qty</th>
              <th>Date</th>
            </thead>
            <tbody>
              <?php
              foreach ($getVente as $vente) :
              ?>
                <tr class="odd gradeX">
                  <td align="center"><b><?= $vente->vente_id ?></b></td>
                  <td><?= number_format($vente->mtotal, 0, ',', ' ') ?> <?= $vente->short ?></td>
                  <td><b><?= number_format($vente->paye, 0, ',', ' ') ?> <?= $vente->short ?></b></td>
                  <td><b>
                    <?php if($vente->reste==0) echo number_format($vente->reste, 0, ',', ' ').$vente->short;
                  else echo "<span class='badge bg-danger'>".number_format($vente->reste, 0, ',', ' ').$vente->short."</span>";
                    ?> </b></td>
                  <td><b><?= number_format($vente->qty, 0, ',', ' ') ?> littres</b></td>
                  <td><?= $vente->datev ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-bordered card-preview">
        <div class="card-inner">
          <h4 class="page-header" style="margin-top:0px;">FACTURE: <b style="color:blue;"><?= count($getVente) ?></b></h4>
          <h5 class="page-header">DETTE:</h5>
            <ul class="list list-checked" style="color:red">
              <li><strong class="fw-bold"><?= number_format($getDette->DETTE, 0, ',', ' ') ?>&nbsp;<?= $getDette->SHORT ?></strong></li>
              <li><strong class="fw-bold"><?= number_format($getDette2->DETTE, 0, ',', ' ') ?>&nbsp;<?= $getDette2->SHORT ?></strong></li>
            </ul>
            <h5 class="page-header">TOTAL:</h5>
              <ul class="list list-checked">
                <li><strong class="fw-bold"><?= number_format($getTot->TOTAL, 0, ',', ' ') ?>&nbsp;<?= $getTot->SHORT ?></strong></li>
                <li><strong class="fw-bold"><?= number_format($getTot2->TOTAL, 0, ',', ' ') ?>&nbsp;<?= $getTot2->SHORT ?></strong></li>
              </ul>
              <?php if($getLittre->QTY!=0): ?>
            <h5 class="page-header">LITTRE DETTE:</h5>
              <ul class="list list-checked">
                <li><strong class="fw-bold"> Voir pour le <?= number_format($getLittre->QTY, 0, ',', ' ') ?>Littres Du <?=$getLittre->date?> </strong></li>
              </ul>
              <?php endif?>
        </div>

      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->