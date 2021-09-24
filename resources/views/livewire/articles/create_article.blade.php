<!-- Modal pour ajjout d'un article-->
<div class="modal fade" id="modalAddArticle" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'un article</h5>
            </div>
            <div class="modal-body">
                <form role="form" wire:submit.prevent="addArticle" enctype="multipart/form-data">
                    <div class="d-flex mb-4 bg-gray-light p-3">
                        <div class="d-flex flex-grow-1 mr-2">
                            <div class="d-flex flex-grow-1">
                                <div class="flex-grow-1 mr-2">
                                    <input type="text" placeholder="Nom" wire:model="newArticle.nom" class="form-control
                                        @error("newArticle.nom") is-invalid @enderror"
                                    >
                                    @error("newArticle.nom")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="flex-grow-1 mr-2">
                                    <input type="text" placeholder="Numéro de série" wire:model="newArticle.numeroDeSerie" class="form-control
                                        @error("newArticle.numeroDeSerie") is-invalid @enderror"
                                    >
                                    @error("newArticle.numeroDeSerie")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="flex-grow-1">
                                    <select wire:model="newArticle.estDisponible"  class="form-control
                                    @error("newArticle.estDisponible") is-invalid @enderror"
                                    >
                                        <option value="">Est-il disponible ?</option>
                                        <option value="0">Non</option>
                                        <option value="1">Oui</option>
                                    </select>
                                    @error("newArticle.estDisponible")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div class="flex-grow-1 mr-2">
                                    <input type="file" wire:model="newArticle.image" class="form-control
                                        @error("newArticle.image") is-invalid @enderror"
                                    >
                                    @error("newArticle.image")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="flex-grow-1">
                                    <select wire:model="newArticle.type_article_id"  class="form-control
                                    @error("newArticle.type_article_id") is-invalid @enderror"
                                    >
                                        <option value="">Type</option>
                                        @foreach ($typeArticle as $type )
                                            <option value="{{$type->id}}">{{$type->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error("newArticle.type_article_id")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeAddArticleModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin du modal Ajout d'article -->