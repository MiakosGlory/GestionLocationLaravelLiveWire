<!-- Modal pour modifier un article -->
<div class="modal fade" id="modalEditArticle" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modification d'un article</h5>
            </div>
            <div class="modal-body">
                <form role="form" wire:submit.prevent="updateArticle" enctype="multipart/form-data">
                    <div class="d-flex mb-4 bg-gray-light p-3">
                        <div class="col-6">
                            <label>Nom</label>
                            <div class="flex-grow-1 mr-2 mb-3">
                                <input type="text" placeholder="Nom" wire:model="editArticle.nom" class="form-control
                                    @error("editArticle.nom") is-invalid @enderror"
                                >
                                @error("editArticle.nom")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <label>Numéro de série</label>
                            <div class="flex-grow-1 mr-2">
                                <input type="text" placeholder="Numéro de série" wire:model="editArticle.numeroDeSerie" class="form-control
                                    @error("editArticle.numeroDeSerie") is-invalid @enderror"
                                >
                                @error("editArticle.numeroDeSerie")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-6">
                            <label>Disponibilité</label>
                            <div class="flex-grow-1 mb-3">
                                <select wire:model="editArticle.estDisponible"  class="form-control
                                @error("editArticle.estDisponible") is-invalid @enderror"
                                >
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                                @error("editArticle.estDisponible")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <label>Type</label>
                            <div class="flex-grow-1">
                                <select wire:model="editArticle.type_article_id"  class="form-control
                                @error("editArticle.type_article_id") is-invalid @enderror"
                                >
                                    @foreach ($typeArticle as $type )
                                        <option value="{{$type->id}}">{{$type->nom}}</option>
                                    @endforeach
                                </select>
                                @error("editArticle.type_article_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-12 bg-gray-light mb-3 pb-4">
                        <label>Image</label>
                        <div class="flex-grow-1 mr-2">
                            <input type="file" wire:model="editArticle.image" class="form-control
                                @error("editArticle.image") is-invalid @enderror">
                        </div> 
                    </div>-->
                    <div>
                        <button class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeEditArticleModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin du modal Editer un article -->