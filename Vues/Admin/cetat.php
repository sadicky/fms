<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="page-header">Total<?php echo $title . ' ' . $getDevise2->short; ?> </h5>
        </div>

        <!-- /.col-lg-12 -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <?php
                        //Today Expense
                        require_once('Models/Admin/connexion.php');
                        $db = getConnection();
                        $tdate = date('Y-m-d');

                        //getDepense
                        $sql1 = "select sum(paye) as TOTAL from tbl_vente WHERE date='$tdate' and devise_id='1'";
                        $req1 = $db->query($sql1);
                        $req1->execute();
                        $g1 = $req1->fetch(PDO::FETCH_OBJ);
                        $sum_todayd1 = $g1->TOTAL;

                        //salaire
                        $sqlo = "select sum(montant) as TOTAL from tbl_paiement WHERE date='$tdate' 
                                 and devise_id='1'";
                        $reqo = $db->query($sqlo);
                        $reqo->execute();
                        $go = $reqo->fetch(PDO::FETCH_OBJ);
                        $sum_todayod1 = $go->TOTAL;

                        //getDepense
                        $sql1 = "select sum(montant) as TOTAL from tbl_depenses WHERE date='$tdate' and devise_id='1'";
                        $req1 = $db->query($sql1);
                        $req1->execute();
                        $g1 = $req1->fetch(PDO::FETCH_OBJ);
                        $sum_todaydd1 = $g1->TOTAL;

                        $sum_todayd1 = $sum_todayd1 - $sum_todayod1 - $sum_todaydd1;
                        ?>

                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start ">
                                    <div class="card-title">
                                        <h6 class="title">Aujourd'hui</h6>
                                    </div>
                                </div>
                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                    <div class="nk-sale-data">
                                        <h3 class="amount" style="color: blue">

                                            <?php if ($sum_todayd1 == "") {
                                                echo "0 $";
                                            } else {
                                                echo number_format($sum_todayd1, 0, ',', ' ') . " " . $getDevise2->short;
                                            }
                                            ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                    $ydate = date('Y-m-d', strtotime("-1 days"));

                    //depense
                    $sql1a = "select sum(paye)  as TOTAL from tbl_vente WHERE date='$ydate' and devise_id='1'";
                    $req1a = $db->query($sql1a);
                    $req1a->execute();
                    $g1a = $req1a->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdayd1 = $g1a->TOTAL;



                    //getDepense
                    $sql1a = "select sum(montant) as TOTAL from tbl_depenses WHERE date='$ydate' and devise_id='1'";
                    $req1a = $db->query($sql1a);
                    $req1a->execute();
                    $g1a = $req1a->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdaydd1 = $g1a->TOTAL;

                    //salaire
                    $sqloa = "select sum(montant)  as TOTAL from tbl_paiement WHERE date='$ydate' 
                                 and devise_id='1'";
                    $reqoa = $db->query($sqloa);
                    $reqoa->execute();
                    $goa = $reqoa->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdayod1 = $goa->TOTAL;

                    $sum_yesterdayd1 = $sum_yesterdayd1 - $sum_yesterdayod1 - $sum_yesterdaydd1;
                    ?>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start">
                                <div class="card-title">
                                    <h6 class="title">Hier</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount" style="color: orange">
                                        <?php if ($sum_yesterdayd1 == "") {
                                            echo "0 $";
                                        } else {
                                            echo number_format($sum_yesterdayd1, 0, ',', ' ') . " " . $getDevise2->short;;
                                        }
                                        ?></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                    //Weekly
                    $pastdate =  date("Y-m-d", strtotime("-1 week"));
                    $crrntdte = date("Y-m-d");

                    //getDepense
                    $query1x = "select sum(paye)  as TOTAL from tbl_vente  WHERE date between '$pastdate' and '$crrntdte' and devise_id='1'";
                    $req1x = $db->query($query1x);
                    $req1x->execute();
                    $g1x = $req1x->fetch(PDO::FETCH_OBJ);
                    $sum_weeklyd1 = $g1x->TOTAL;


                    //getDepense
                    $sql1v = "select sum(montant) as TOTAL from tbl_depenses WHERE date between '$pastdate' and '$crrntdte' and devise_id='1'";
                    $req1v = $db->query($sql1v);
                    $req1v->execute();
                    $g1v = $req1v->fetch(PDO::FETCH_OBJ);
                    $sum_weeklydd1 = $g1v->TOTAL;

                    //salaire
                    $sqlox = "select sum(montant)  as TOTAL from tbl_paiement WHERE date between '$pastdate' and '$crrntdte'
                                 and devise_id='1'";
                    $reqox = $db->query($sqlox);
                    $reqox->execute();
                    $gox = $reqox->fetch(PDO::FETCH_OBJ);
                    $sum_weeklyod1 = $gox->TOTAL;

                    $sum_weeklyd1 = $sum_weeklyd1 - $sum_weeklyod1 - $sum_weeklydd1;
                    ?>

                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Après 7 Jours</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount" style="color: aqua">
                                        <?php if ($sum_weeklyd1 == "") {
                                            echo "0 $";
                                        } else {
                                            echo number_format($sum_weeklyd1, 0, ',', ' ') . " " . $getDevise2->short;
                                        }
                                        ?></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                    //Monthly 
                    $monthdate =  date("Y-m-d", strtotime("-1 month"));
                    $crrntdte = date("Y-m-d");

                    //depense
                    $sql1n = "select sum(paye) as TOTAL from tbl_vente  WHERE date between '$monthdate' and '$crrntdte' and devise_id='1'";
                    $req1n = $db->query($sql1n);
                    $req1n->execute();
                    $g1n = $req1n->fetch(PDO::FETCH_OBJ);
                    $sum_monthlyd1 = $g1n->TOTAL;


                    //getDepense
                    $sql1m = "select sum(montant) as TOTAL from tbl_depenses WHERE date between '$monthdate' and '$crrntdte' and devise_id='1'";
                    $req1m = $db->query($sql1m);
                    $req1m->execute();
                    $g1m = $req1m->fetch(PDO::FETCH_OBJ);
                    $sum_monthlydd1 = $g1m->TOTAL;

                    //salaire
                    $sqlon = "select sum(montant)  as TOTAL from tbl_paiement WHERE date between '$monthdate' and '$crrntdte'
                             and devise_id='1'";
                    $reqon = $db->query($sqlon);
                    $reqon->execute();
                    $gon = $reqon->fetch(PDO::FETCH_OBJ);
                    $sum_monthlyod1 = $gon->TOTAL;

                    $sum_monthlyd1 = $sum_monthlyd1 - $sum_monthlyod1 - $sum_monthlydd1;
                    ?>

                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Mensuel</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount text-danger">
                                        <?php if ($sum_monthlyd1 == "") {
                                            echo "0 $";
                                        } else {
                                            echo number_format($sum_monthlyd1, 0, ',', ' ') . " " . $getDevise2->short;
                                        }
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>

        </div>

        <div class="row my-2 mb-3">
            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <?php
                    //Yearly 
                    $cyear = date("Y");

                    //depenses					
                    $query1w = "select sum(paye) as TOTAL from tbl_vente  WHERE (year(datev)='$cyear') and devise_id='1'";
                    $req1w = $db->query($query1w);
                    $req1w->execute();
                    $g1w = $req1w->fetch(PDO::FETCH_OBJ);
                    $sum_yearlyd1 = $g1w->TOTAL;


                    //getDepense
                    $sql1t = "select sum(montant) as TOTAL from tbl_depenses WHERE (year(date)='$cyear') and devise_id='1'";
                    $req1t = $db->query($sql1t);
                    $req1t->execute();
                    $g1t = $req1t->fetch(PDO::FETCH_OBJ);
                    $sum_yearlydd1 = $g1t->TOTAL;

                    //salaire
                    $sqlob = "select sum(montant)  as TOTAL from tbl_paiement WHERE (year(date)='$cyear')
                    and devise_id='1'";
                    $reqob = $db->query($sqlob);
                    $reqob->execute();
                    $gob = $reqob->fetch(PDO::FETCH_OBJ);
                    $sum_yearlyod1 = $gob->TOTAL;

                    $sum_yearlyd1 = $sum_yearlyd1 - $sum_yearlyod1 - $sum_yearlydd1;
                    ?>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Annuel</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount">
                                        <?php
                                        if ($sum_yearlyd1 == "") {
                                            echo "<h1>0</h1>";
                                        } else {
                                            echo "<h2>" . number_format($sum_yearlyd1, 0, ',', ' ') . " " . $getDevise2->short . "</h2>";
                                        }

                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <?php

                    //depenses
                    $query1 = "select sum(paye)  as TOTAL from tbl_vente where devise_id='1'";
                    $req1 = $db->query($query1);
                    $req1->execute();
                    $g1 = $req1->fetch(PDO::FETCH_OBJ);
                    $sum_totald1 = $g1->TOTAL;

                    //getDepense
                    $sql1 = "select sum(montant) as TOTAL from tbl_depenses WHERE (year(date)='$cyear') and devise_id='1'";
                    $req1 = $db->query($sql1);
                    $req1->execute();
                    $g1 = $req1->fetch(PDO::FETCH_OBJ);
                    $sum_totaldd1 = $g1->TOTAL;


                    //salaire
                    $sqlo = "select sum(montant)  as TOTAL from tbl_paiement WHERE devise_id='1'";
                    $reqo = $db->query($sqlo);
                    $reqo->execute();
                    $go = $reqo->fetch(PDO::FETCH_OBJ);
                    $sum_totalod1 = $go->TOTAL;

                    $sum_totald1 = $sum_totald1 - $sum_totalod1 - $sum_totaldd1;
                    ?>

                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Total</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount">
                                        <?php if ($sum_totald1 == "") {
                                            echo "<h1>0$</h1>";
                                        } else {
                                            echo "<h2>" . number_format($sum_totald1, 0, ',', ' ') . " " . $getDevise2->short . "</h2>";
                                        }
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->


                </div>

            </div>

        </div>
        <hr>
        <h5 class="page-header">Total<?php echo $title . ' ' . $getDevise3->short; ?></h5>

        <!-- /.col-lg-12 -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <?php
                        //Today Expense
                        require_once('Models/Admin/connexion.php');
                        $db = getConnection();
                        $tdate = date('Y-m-d');

                        //getDepense
                        $sql2 = "select sum(paye) as TOTAL from tbl_vente WHERE date='$tdate' and devise_id='2'";
                        $req2 = $db->query($sql2);
                        $req2->execute();
                        $go2 = $req2->fetch(PDO::FETCH_OBJ);
                        $sum_todayd2 = $go2->TOTAL;


                        //getDepense
                        $sqld2 = "select sum(montant) as TOTAL from tbl_depenses WHERE date='$tdate' and devise_id='2'";
                        $reqd2 = $db->query($sqld2);
                        $reqd2->execute();
                        $gd2 = $reqd2->fetch(PDO::FETCH_OBJ);
                        $sum_todaydd2 = $gd2->TOTAL;


                        //salaire
                        $sqlo1 = "select sum(montant)  as TOTAL from tbl_paiement WHERE date='$tdate' 
                         and devise_id='2'";
                        $reqo1 = $db->query($sqlo1);
                        $reqo1->execute();
                        $go1 = $reqo1->fetch(PDO::FETCH_OBJ);
                        $sum_todayod2 = $go1->TOTAL;

                        $sum_todayd2 = $sum_todayd2 - $sum_todayod2 - $sum_todaydd2;
                        // var_dump($sum_todaydd1);
                        ?>

                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start ">
                                    <div class="card-title">
                                        <h6 class="title">Aujourd'hui</h6>
                                    </div>
                                </div>
                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                    <div class="nk-sale-data">
                                        <h3 class="amount text-primary">
                                            <?php if ($sum_todayd2 == "") {
                                                echo "0";
                                            } else {
                                                echo number_format($sum_todayd2, 0, ',', ' ') . " " . $getDevise3->short;
                                            }
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                    $ydate = date('Y-m-d', strtotime("-1 days"));

                    //depense
                    $sql1v = "select sum(paye)  as TOTAL from tbl_vente WHERE date='$ydate' and devise_id='2'";
                    $req1v = $db->query($sql1v);
                    $req1v->execute();
                    $g1v = $req1v->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdayd2 = $g1v->TOTAL;

                    //salaire
                    $sqlor = "select sum(montant)  as TOTAL from tbl_paiement WHERE date='$ydate' 
                    and devise_id='2'";
                    $reqor = $db->query($sqlor);
                    $reqor->execute();
                    $gor = $reqor->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdayod2 = $gor->TOTAL;

                    //getDepense
                    $sql1s = "select sum(montant) as TOTAL from tbl_depenses WHERE date='$ydate' and devise_id='2'";
                    $req1s = $db->query($sql1s);
                    $req1s->execute();
                    $g1s = $req1s->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdaydd2 = $g1s->TOTAL;

                    //salaire
                    $sqlor = "select sum(montant)  as TOTAL from tbl_paiement WHERE date='$ydate' 
                    and devise_id='2'";
                    $reqor = $db->query($sqlor);
                    $reqor->execute();
                    $gor = $reqor->fetch(PDO::FETCH_OBJ);
                    $sum_yesterdayod2 = $gor->TOTAL;

                    $sum_yesterdayd2 = $sum_yesterdayd2 - $sum_yesterdayod2 - $sum_yesterdaydd2;

                    ?>


                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start">
                                <div class="card-title">
                                    <h6 class="title">Hier</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount" style="color: orange">
                                        <?php if ($sum_yesterdayd2 == "") {
                                            echo "0";
                                        } else {
                                            echo number_format($sum_yesterdayd2, 0, ',', ' ') . " " . $getDevise3->short;;
                                        }
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                    //Weekly
                    $pastdate =  date("Y-m-d", strtotime("-1 week"));
                    $crrntdte = date("Y-m-d");

                    //getDepense
                    $query1g = "select sum(paye)  as TOTAL from tbl_vente  WHERE date between '$pastdate' and '$crrntdte' and devise_id='2'";
                    $req1g = $db->query($query1g);
                    $req1g->execute();
                    $g1g = $req1g->fetch(PDO::FETCH_OBJ);
                    $sum_weeklyd2 = $g1g->TOTAL;


                    //salaire
                    $sqlot = "select sum(montant)  as TOTAL from tbl_paiement WHERE date between '$pastdate' and '$crrntdte'
                    and devise_id='2'";
                    $reqot = $db->query($sqlot);
                    $reqot->execute();
                    $got = $reqot->fetch(PDO::FETCH_OBJ);
                    $sum_weeklyod2 = $got->TOTAL;

                    //getDepense
                    $sql1x = "select sum(montant) as TOTAL from tbl_depenses WHERE date between '$pastdate' and '$crrntdte' and devise_id='2'";
                    $req1x = $db->query($sql1x);
                    $req1x->execute();
                    $g1x = $req1x->fetch(PDO::FETCH_OBJ);
                    $sum_weeklydd2 = $g1x->TOTAL;

                    //salaire
                    $sqlot = "select sum(montant)  as TOTAL from tbl_paiement WHERE date between '$pastdate' and '$crrntdte'
                    and devise_id='2'";
                    $reqot = $db->query($sqlot);
                    $reqot->execute();
                    $got = $reqot->fetch(PDO::FETCH_OBJ);
                    $sum_weeklyod2 = $got->TOTAL;

                    $sum_weeklyd2 = $sum_weeklyd2 - $sum_weeklyod2 - $sum_weeklydd2;
                    ?>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Après 7 Jours</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount" style="color: aqua">
                                        <?php if ($sum_weeklyd2 == "") {
                                            echo "0";
                                        } else {
                                            echo number_format($sum_weeklyd2, 0, ',', ' ') . " " . $getDevise3->short;
                                        }
                                        ?></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <?php
                    //Monthly 
                    $monthdate =  date("Y-m-d", strtotime("-1 month"));
                    $crrntdte = date("Y-m-d");

                    //depense
                    $sql1b = "select sum(paye) as TOTAL from tbl_vente  WHERE date between '$monthdate' and '$crrntdte' and devise_id='2'";
                    $req1b = $db->query($sql1b);
                    $req1b->execute();
                    $g1b = $req1b->fetch(PDO::FETCH_OBJ);
                    $sum_monthlyd2 = $g1b->TOTAL;


                    //salaire
                    $sqlob = "select sum(montant)  as TOTAL from tbl_paiement WHERE date between '$monthdate' and '$crrntdte'
                    and devise_id='2'";
                    $reqob = $db->query($sqlob);
                    $reqob->execute();
                    $gob = $reqob->fetch(PDO::FETCH_OBJ);
                    $sum_monthlyod2 = $gob->TOTAL;

                    //getDepense
                    $sql1t = "select sum(montant) as TOTAL from tbl_depenses WHERE date between '$monthdate' and '$crrntdte' and devise_id='2'";
                    $req1t = $db->query($sql1t);
                    $req1t->execute();
                    $g1t = $req1t->fetch(PDO::FETCH_OBJ);
                    $sum_monthlydd2 = $g1t->TOTAL;


                    //salaire
                    $sqlob = "select sum(montant)  as TOTAL from tbl_paiement WHERE date between '$monthdate' and '$crrntdte'
                    and devise_id='2'";
                    $reqob = $db->query($sqlob);
                    $reqob->execute();
                    $gob = $reqob->fetch(PDO::FETCH_OBJ);
                    $sum_monthlyod2 = $gob->TOTAL;

                    $sum_monthlyd2 = $sum_monthlyd2 - $sum_monthlyod2 - $sum_monthlydd2;

                    // print_r($g1);die();

                    ?>

                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Mensuel</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount text-danger">
                                        <?php if ($sum_monthlyd2 == "") {
                                            echo "0";
                                        } else {
                                            echo number_format($sum_monthlyd2, 0, ',', ' ') . " " . $getDevise3->short;
                                        }
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <?php
                    //Yearly 
                    $cyear = date("Y");

                    //depenses					
                    $query1k = "select sum(paye)  as TOTAL from tbl_vente  WHERE (year(date)='$cyear') and devise_id='2'";
                    $req1k = $db->query($query1k);
                    $req1k->execute();
                    $g1k = $req1k->fetch(PDO::FETCH_OBJ);
                    $sum_yearlyd2 = $g1k->TOTAL;
                    //salaire
                    $sqlok = "select sum(montant)  as TOTAL from tbl_paiement WHERE (year(date)='$cyear')
                    and devise_id='2'";
                    $reqok = $db->query($sqlok);
                    $reqok->execute();
                    $gok = $reqok->fetch(PDO::FETCH_OBJ);
                    $sum_yearlyod2 = $gok->TOTAL;

                    //getDepense
                    $sql1q = "select sum(montant) as TOTAL from tbl_depenses WHERE date between (year(date)='$cyear') and devise_id='2'";
                    $req1q = $db->query($sql1q);
                    $req1q->execute();
                    $g1q = $req1q->fetch(PDO::FETCH_OBJ);
                    $sum_yearlydd2 = $g1q->TOTAL;


                    //salaire
                    $sqlok = "select sum(montant)  as TOTAL from tbl_paiement WHERE (year(date)='$cyear')
                    and devise_id='2'";
                    $reqok = $db->query($sqlok);
                    $reqok->execute();
                    $gok = $reqok->fetch(PDO::FETCH_OBJ);
                    $sum_yearlyod2 = $gok->TOTAL;

                    $sum_yearlyd2 = $sum_yearlyd2 - $sum_yearlyod2 - $sum_yearlydd2;
                    ?>
                    <div class="card card-bordered mt-2">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Annuel</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount">
                                        <?php if ($sum_yearlyd2 == "") {
                                            echo "<h1>0 </h1>";
                                        } else {
                                            echo "<h2>" . number_format($sum_yearlyd2, 0, ',', ' ') . " " . $getDevise3->short . "</h2>";
                                        }

                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>

            </div>

            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <?php

                    //depenses
                    $query1c = "select sum(paye) as TOTAL from tbl_vente where devise_id='2'";
                    $req1c = $db->query($query1c);
                    $req1c->execute();
                    $g1c = $req1c->fetch(PDO::FETCH_OBJ);
                    $sum_totald2 = $g1c->TOTAL;

                    //salaire
                    $sqlo = "select sum(montant)  as TOTAL from tbl_paiement WHERE devise_id='2'";
                    $reqo = $db->query($sqlo);
                    $reqo->execute();
                    $go = $reqo->fetch(PDO::FETCH_OBJ);
                    $sum_totalod2 = $go->TOTAL;

                    //getDepense
                    $sql1h = "select sum(montant) as TOTAL from tbl_depenses WHERE devise_id='2'";
                    $req1h = $db->query($sql1h);
                    $req1h->execute();
                    $g1h = $req1h->fetch(PDO::FETCH_OBJ);
                    $sum_totaldd2 = $g1h->TOTAL;

                    //salaire
                    $sqlo = "select sum(montant)  as TOTAL from tbl_paiement WHERE devise_id='2'";
                    $reqo = $db->query($sqlo);
                    $reqo->execute();
                    $go = $reqo->fetch(PDO::FETCH_OBJ);
                    $sum_totalod2 = $go->TOTAL;

                    $sum_totald2 = $sum_totald2 - $sum_totalod2 - $sum_totaldd2;

                    ?>

                    <div class="card card-bordered mt-2">
                        <div class="card-inner">
                            <div class="card-title-group align-start ">
                                <div class="card-title">
                                    <h6 class="title">Total</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <h3 class="amount">
                                        <?php if ($sum_totald2 == "") {
                                            echo "<h1>0</h1>";
                                        } else {
                                            echo "<h2>" . number_format($sum_totald2, 0, ',', ' ') . " " . $getDevise3->short . "</h2>";
                                        }

                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<?php
include('Public/modals/transferer.php');
// include 'Public/modals/edituser.php';
?>