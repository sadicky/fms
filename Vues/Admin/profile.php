<!-- main @s -->
    <div class='col-sm-12' id="message"></div>
<div class="nk-main ">
    <div class="nk-wrap ">
        <!-- content @s -->
        <div class="nk-content ">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-block">
                            <div class="card">
                                <div class="card-aside-wrap">
                                    <div class="card-inner card-inner-lg">
                                        <div class="nk-block">
                                        <form method="post" id="formulaire_profile">
                                            <div class="nk-data data-list">
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="full-name">Nom d'utilisateur</label>
                                                            <input type="text" value="<?= $_SESSION['username'] ?>" class="form-control form-control-lg" id="username" name="username">
                                                            <input type="hidden" value="<?= $_SESSION['id'] ?>" id="id" name="id">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="display-name">Fonction</label>
                                                            <input type="text" readonly value="<?= $_SESSION['role'] ?>" class="form-control form-control-lg" id="display-name" value="Ishtiyak" placeholder="Enter display name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="phone-no">Nouveau Mot de passe</label>
                                                            <input type="password" id="pwd" name="pwd" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="birth-day">Valider le Mot de passe</label>
                                                            <input type="text" id="cpwd" name="cpwd" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                            <li>
                                                                <button type="submit" class="btn btn-lg btn-primary">Modifier</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- data-list -->
                                        </form>
                                        </div><!-- .nk-block -->
                                    </div>
                                </div><!-- .card-aside-wrap -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
        <!-- content @e -->
    </div>
    <!-- wrap @e -->
</div>
<!-- main @e -->