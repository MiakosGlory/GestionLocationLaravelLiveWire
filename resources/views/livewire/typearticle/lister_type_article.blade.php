<!-- Gestion de type d'article TABLEAU -->
<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i>Gestion des type articless</h3>
                <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="showTypeArticleForm"> <i class="fas fa-plus"></i>Ajouter Type</a>
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
                    <tr>
                        <th style="width:50%">Type d'article</th>
                        <th class="text-center" style="width:20%">Ajouté</th>
                        <th class="text-center" style="width:30%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        @if ($isAddTypeArticle)
                            <tr>
                                <td colspan="2">
                                    <input type="text" wire:keydown.enter="addTypeArticle" class="form-control 
                                    @error("newTypeArticle") is-invalid 
                                    @enderror" wire:model="newTypeArticle">
                                    @error("newTypeArticle")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary" wire:click.prevent="addTypeArticle"><i class="fa fa-check"></i>Valider</button>
                                    <button class="btn btn-danger" wire:click.prevent="showTypeArticleForm"><i class="far fa-trash-alt"></i>Annuler</button>
                                </td>
                            </tr>
                        @endif
                        @foreach($type_article as $type)
                        <tr>
                            <td>{{$type->nom}}</td>
                            <td class="text-center" ><span class="tag tag-success">{{optional($type->created_at)->diffforHumans()}}</span></td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click.prevent="editTypeArticle({{$type->id}})"><i class="far fa-edit"></i></button>
                                <button class="btn btn-link" wire:click.prevent="showModalProp({{$type->id}})"><i class="fa fa-list"></i>Propriétés</button>
                                @if (count($type->articles) == 0)
                                <button class="btn btn-link" wire:click.prevent="confirmDelete({{$type->id}})"><i class="far fa-trash-alt"></i></button>
                                @endif
                            </td>
                            </tr>
                        <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    {{$type_article->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de la gestion des type d'article -->