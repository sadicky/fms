 <!-- Add Room-->
 <div class="modal fade" tabindex="-1" role="dialog" id="add-order">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
             <div class="modal-body modal-body-md">
                 <h5 class="modal-title">Ajouter une nouvelle Livraison</h5>
                    <form action="#" class="mt-2" method="post" id="formulaire-livraison">
                        <div class="row g-gs">
                            <!--col-->
                            <input type="hidden" name="id" id="id" value="<?=$_SESSION['id']?>">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Carburants</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2 carburant-change" data-search="on"  id="carburant" name="carburant" >
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
                                    <label class="form-label">Fournisseur</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-search="on" id="fournisseur" name="fournisseur" >
                                        <option value="">Selectionner</option>
                                           <?php foreach($fournisseurs as $c):?>
                                            <option value="<?=$c->fournisseur_id?>"><?=$c->fournisseur?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Livreur</label>
                                    <input type="text" class="form-control" id="livreur" name="livreur" placeholder="Livreur">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Matricule ou Plaque</label>
                                    <input type="text" class="form-control" id="mat" name="mat" placeholder="Matricule ou Plaque">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Total Litres(<span id="resultat"></span>)</label>
                                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Total Litres">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Prix d'Achat</label>
                                    <input type="text" class="form-control" id="pa" name="pa" placeholder="Prix d'Achat">
                                </div>
                            </div>
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