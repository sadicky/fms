 <!-- Add Room-->
 <div class="modal fade" tabindex="-1" role="dialog" id="add-staff">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Ajouter un nouveau Personnel</h5>
                    <form action="#" class="mt-2" method="post" id="formulaire-staff">
                        <div class="row g-gs">
                            <!--col-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Noms</label>
                                    <input type="text" class="form-control" name="noms" id="noms" placeholder="Username">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Fonction</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2"  id="role" name="role" >
                                            <option value="gerant" selected>Gérant</option>
                                            <option value="comptable">Comptable</option>
                                            <option value="station">des Stations</option>
                                            <option value="pompiste">Pompiste</option>
                                            <option value="chauffeur">Chauffeur</option>
                                            <option value="sentinelle">Sentinelle</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Téléphone</label>
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Téléphone">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block"  type="submit">Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->