<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Gestion des articles</h3>
                <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="addArticleModal"> <i class="fas fa-plus"></i>Ajouter Article</a>
                <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control float-right" 
                        placeholder="Rechercher par Nom" wire:model.debounce.500ms="seach">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                    <th style="width:25%">Libellé</th>
                    <th style="width:20%">Numéro de Serie</th>
                    <th style="width:25%">Disponibilité</th>
                    <th style="width:20%">Type</th>
                    <th style="width:25%">Ajouté</th>
                    <th style="width:20%">Image</th>
                    <th class="text-center" style="width:30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $articles as $article)
                    <tr>
                        <td>{{$article->nom}}</td>
                        <td>{{$article->numeroDeSerie}}</td>
                        <td>
                            @if ($article->estDisponible == 1)
                                <span class="right badge badge-success pr-3 pl-3">OUI </span>
                            @else
                                <span class="right badge badge-danger pr-3 pl-3">NON</span>
                            @endif
                        </td>
                        <td>{{$article->typeArticle->nom}}</td>
                        <td class="text-center" ><span class="tag tag-success">{{$article->created_at
                            ->diffforHumans()}}</span>
                        </td>
                        <td><img src="{{$article->image}}" height="50px;" width="50px;"></td>
                        <td class="text-center">
                            <button class="btn btn-link" wire:click.prevent="editArticleModal({{$article->id}})"><i class="far fa-edit"></i></button>
                            <button class="btn btn-link" wire:click.prevent="showDeleteArticle({{$article->id}})"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                    <tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$articles->links()}}
            </div>
        </div>
    </div>
</div>