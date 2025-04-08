 <!-- Add Room-->
 <div class="modal fade" tabindex="-1" role="dialog" id="add-salaire">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Ajouter la Paie ou le Salaire du Personnel</h5>
                    <form action="#" class="mt-2" method="post" id="formulaire-salaire-add">
                        <div class="row g-gs">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Staff</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-search="on"  id="staff" name="staff" >
                                            <?php foreach($users as $s):?>
                                            <option value="<?=$s->staff_id?>" selected><?=$s->noms?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Devise</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-search="on"  id="devise" name="devise" >
                                            <?php foreach($devises as $s):?>
                                            <option value="<?=$s->devise_id?>" selected><?=$s->short?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">Salaire Basique</label>
                                    <input type="text" class="form-control" id="sal" name="sal" placeholder="150$">
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