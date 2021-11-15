<!-- Modal pour ajouter un article-->
<div class="modal fade" id="modalAddArticle" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'un article</h5>
            </div>
            <div class="modal-body">
                <form role="form" wire:submit.prevent="addArticle" enctype="multipart/form-data">
                    @if ($errors->any()) 
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error )
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                    @endif
                    <div class="p-3 mb-4 d-flex bg-gray-light">
                        <div class="col-6">
                            <div class="mb-3 mr-2 flex-grow-1">
                                <input type="text" placeholder="Nom" wire:model="newArticle.nom" class="form-control
                                    @error("newArticle.nom") is-invalid @enderror"
                                >
                            </div> 
                            <div class="mr-2 flex-grow-1">
                                <input type="text" placeholder="Numéro de série" wire:model="newArticle.numeroDeSerie" class="form-control
                                    @error("newArticle.numeroDeSerie") is-invalid @enderror"
                                >
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="mb-3 flex-grow-1">
                                <select wire:model="newArticle.estDisponible"  class="form-control
                                @error("newArticle.estDisponible") is-invalid @enderror"
                                >
                                    <option value="">Est-il disponible ?</option>
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
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
                            </div>
                        </div>
                    </div>
                    @if($proprieteArticle != null)
                        <div class="mb-4">
                            <div class="col-6">
                                <div class="flex-grow-1">
                                    @foreach ($proprieteArticle as $propriete )
                                        <label>{{$propriete->nom}} @if(!$propriete->estObligatoire) (optionnel) @endif</label>
                                        @php
                                            $field = "newArticle.prop.".$propriete->nom;
                                        @endphp
                                        <input type="text" placeholder="Propriété..." wire:model="{{$field}}" class="mb-3 form-control">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="p-3 mb-4 d-flex bg-gray-light">
                        <div class="col-6">
                            @if($addImage)
                                <img cllass="justify-content-center" src="{{$addImage->temporaryUrl()}}" height="150px;" width="150px;">
                            @endif
                        </div>
                        <div class="col-6">
                            <input type="file" wire:model="addImage" class="form-control" id="image{{$inputFile}}">
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeAddArticleModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin du modal Ajout d'un article -->