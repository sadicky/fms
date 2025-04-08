<div class="nk-sidebar-element nk-sidebar-body">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar> 
            <ul class="nk-menu">
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">General</h6>
                </li>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier' || $_SESSION['role']=='station'):?>
                <li class="nk-menu-item">
                    <a href="<?= WEBROOT ?>dashboard" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                        <span class="nk-menu-text">Dashboard</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='station'):?>
               
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>pompes" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-network"></em></span>
                        <span class="nk-menu-text">Pompes</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='station'):?>
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>carburants" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-hot"></em></span>
                        <span class="nk-menu-text">Carburant</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>ventes" class="nk-menu-link ">
                        <span class="nk-menu-icon"><em class="icon ni ni-sign-usdt"></em></span>
                        <span class="nk-menu-text">Calcul de Vente</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>depenses" class="nk-menu-link ">
                        <span class="nk-menu-icon"><em class="icon ni ni-sign-usdc-alt"></em></span>
                        <span class="nk-menu-text">Dépenses</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-cc-new"></em></span>
                        <span class="nk-menu-text">Caisse</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>cetat" class="nk-menu-link"><span class="nk-menu-text">Etat Caisse</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>cdepenses" class="nk-menu-link"><span class="nk-menu-text">Etat Dépenses</span></a>
                        </li>
                    </ul><!-- .nk-menu-sub -->
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin'  || $_SESSION['role']=='station'  || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                        <span class="nk-menu-text">Rapports</span>
                    </a>
                    <ul class="nk-menu-sub">
                    <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>rvente" class="nk-menu-link"><span class="nk-menu-text">Vente</span></a>
                        </li>
                        <?php endif?>
                        <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='station'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>rlivraison" class="nk-menu-link"><span class="nk-menu-text">Livraison</span></a>
                        </li>
                        <?php endif?>
                        <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>rdepenses" class="nk-menu-link"><span class="nk-menu-text">Dépenses</span></a>
                        </li>
                        <?php endif?>
                        <?php if($_SESSION['role']=='admin'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>rsalaires" class="nk-menu-link"><span class="nk-menu-text">Salaires</span></a>
                        </li>
                        <?php endif?>
                        <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>rdettes" class="nk-menu-link"><span class="nk-menu-text">Dettes</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>rtransfert" class="nk-menu-link"><span class="nk-menu-text">Transfert</span></a>
                        </li>
                        <?php endif?>
                    </ul><!-- .nk-menu-sub -->
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">administration</h6>
                </li><!-- .nk-menu-heading -->
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>tiers" class="nk-menu-link ">
                        <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                        <span class="nk-menu-text">Client</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>supplier" class="nk-menu-link ">
                        <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                        <span class="nk-menu-text">Fournisseurs</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <?php endif?>
                <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                <li class="nk-menu-item has-sub">
                    <a href="<?= WEBROOT ?>staff" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-user-circle"></em></span>
                        <span class="nk-menu-text">Personnels</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                        <span class="nk-menu-text">Parametre</span>
                    </a>
                    <ul class="nk-menu-sub">
                    <?php if($_SESSION['role']=='admin'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>devise" class="nk-menu-link"><span class="nk-menu-text">Dévise</span></a>
                        </li>
                        <?php endif?>
                        <?php if($_SESSION['role']=='admin' || $_SESSION['role']=='caissier'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>bank" class="nk-menu-link"><span class="nk-menu-text">Banques</span></a>
                        </li>
                <?php endif?>
                <?php if($_SESSION['role']=='admin'):?>
                        <li class="nk-menu-item">
                            <a href="<?= WEBROOT ?>users" class="nk-menu-link"><span class="nk-menu-text">Utilisateurs</span></a>
                        </li>
                        <?php endif?>
                    </ul><!-- .nk-menu-sub -->
                </li><!-- .nk-menu-item -->
                
                <?php endif?>
                <?php endif?>
            </ul><!-- .nk-menu -->
        </div><!-- .nk-sidebar-menu -->
    </div><!-- .nk-sidebar-content -->
</div><!-- .nk-sidebar-element -->