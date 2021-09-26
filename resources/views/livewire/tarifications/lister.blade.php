<!-- Gestion de type d'article TABLEAU -->
<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i>Gestion des Tarifications</h3>
                <div class="card-tools d-flex align-items-center">
                    <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="showTarificationForm"> <i class="fas fa-plus"></i>Ajouter Tarification</a>
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" 
                            placeholder="Rechercher par Nom" wire:model.debounce.250ms="seach">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                <thead>
                    @if ($isAddTarification)
                    <form role="form" wire:submit.prevent="addTarification">
                        <div class="d-flex mb-4 bg-gray-light p-3 pt-4">
                            <div class="col-3">
                                <div class="flex-grow-1 mr-2 mb-3">
                                    <select class="form-control @error("newTarification.article_id") 
                                        is-invalid @enderror" wire:model="newTarification.article_id">
                                        <option value="">Article</option>
                                        @foreach ($articles as $article )
                                            <option value="{{$article->id}}">{{$article->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error("newTarification.article_id")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="flex-grow-1 mr-2 mb-3">
                                    <select class="form-control @error("newTarification.duree_location_id") 
                                        is-invalid @enderror" wire:model="newTarification.duree_location_id">
                                        <option value="">Durée location</option>
                                        @foreach ($dureeLocat as $duree )
                                            <option value="{{$duree->id}}">{{$duree->libelle}}</option>
                                        @endforeach
                                    </select>
                                    @error("newTarification.duree_location_id")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="flex-grow-1 mr-2 mb-3">
                                    <input type="text" wire:model="newTarification.prix" class="form-control
                                    @error("newTarification.prix") is-invalid 
                                    @enderror" placeholder="Le Prix">
                                    @error("newTarification.prix")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-3 flex-grow-1">
                                <button class="btn btn-primary">Enregistrer</button>
                                <button class="btn btn-danger" wire:click.prevent="showTarificationForm">Annuler</button>
                            </div>
                        </div>
                    </form>
                    @endif
                    <tr class="mt-5">
                        <th style="width:50%">Article</th>
                        <th style="width:50%">Durée de location</th>
                        <th style="width:50%">Prix</th>
                        <th class="text-center" style="width:20%">Ajouté</th>
                        <th class="text-center" style="width:30%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($tarifications as $tarif)
                        <tr>
                            <td>{{optional($tarif->article_id)->nom}}</td>
                            <td>{{optional($tarif->duree_location)->libelle}}</td>
                            <td>{{optional($tarif->prix)}}</td>
                            <td class="text-center" ><span class="tag tag-success">{{optional($tarif->created_at)->diffforHumans()}}</span></td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click.prevent="editTarification({{$tarif->id}})"><i class="far fa-edit"></i></button>
                               <!-- <button class="btn btn-link" wire:click.prevent="confirmDelete()"><i class="far fa-trash-alt"></i></button>-->
                            </td>
                            </tr>
                        <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    {{$tarifications->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de la gestion des type d'article -->