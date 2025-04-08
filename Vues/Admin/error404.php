<?php 
$title = 'Page Not Found';
include('Public/includes/header.php');
?>
<body class="nk-body bg-white npc-general pg-error">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-xs mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <h1 class="nk-error-head">404</h1>
                            <h3 class="nk-error-title">Page Not Found</h3>
                            <p class="nk-error-text">We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.</p>
                            <a href="<?=WEBROOT?>" class="btn btn-lg btn-primary mt-2">Aller à l'Accueil</a>
                        </div>
                    </div><!-- .nk-block -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
                <!-- content @e -->
    <!-- app-root @e -->
    <!-- JavaScript -->
    <?php 
include('Public/includes/footer.php');
?>