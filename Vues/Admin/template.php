<?php
$title =  ucwords(str_replace('_', ' ', $title));
include('Public/includes/header.php');
?>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="<?= WEBROOT ?>dashboard" class="logo-link nk-sidebar-logo">
                            <!-- <img class="logo-light logo-img" width="200px" src="assets/images/logo2.png" srcset="assets/images/logo2.png" alt="logo">
                            <img class="logo-dark logo-img" src="assets/images/logo2.png" srcset="assets/images/logo2.png" alt="logo-dark"> -->
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->

                <?php include('Public/includes/menu.php'); ?>

            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php include('Public/includes/toph.php'); ?>

                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"><?= $title ?></h3>
                                        </div>
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">

                                    <?php echo $contents; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- app-root @e -->
                <!-- JavaScript -->
                <?php include('Public/includes/footer.php'); ?>