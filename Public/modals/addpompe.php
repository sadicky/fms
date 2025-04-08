 <!-- Add Room-->
 <div class="modal fade" tabindex="-1" role="dialog" id="add-pompe">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
             <div class="modal-body modal-body-md">
                 <h5 class="modal-title">Ajouter une nouvelle pompe</h5>
                    <form action="#" class="mt-2" method="post" id="formulaire-pompe">
                        <div class="row g-gs">
                            <!--col-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Description</label>
                                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" required>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Carburants</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-search="on"  id="carburant" name="carburant" required>
                                            <option value="">Selectionner</option>
                                           <?php foreach($carburants as $c):?>
                                            <option value="<?=$c->id_carburant?>"><?=$c->type?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Compteur</label>
                                    <input type="text" class="form-control" id="cpt" name="cpt" placeholder="Index" required>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Code</label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Statut</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-search="on" id="statut" name="statut" required>
                                        <option value="">Selectionner</option>
                                            <option value="Active">Actif</option>
                                            <option value="defectuex">Défectuex</option>
                                            <option value="endommage">Endommagé</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                            <!--col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block"  type="submit">Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </form>
             </div><!-- .modal-content -->
         </div><!-- .modal-dialog -->
     </div><!-- .modal -->
 </div>