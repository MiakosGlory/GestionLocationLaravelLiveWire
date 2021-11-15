<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-archive fa-2x"></i>Gestion des articles</h3>
                <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="addArticleModal"> <i class="fas fa-plus"></i>Ajouter Article</a>
                <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" class="form-control float-right" 
                        placeholder="Rechercher par Nom" wire:model.debounce.500ms="seach">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped">
                <div class="d-flex justify-content-end p-4 bg-gray">
                    <div class="form-group mr-3">
                        <label>Filtrer par Type</label>
                        <select wire:model="filtreType" class="form-control">
                            <option></option>
                            @foreach ( $typeArticle as $type)
                                <option value="{{$type->id}}">{{$type->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Filtrer par Statut</label>
                        <select wire:model="filtreStatut" class="form-control">
                            <option></option>
                            <option value="1">Disponible</option>
                            <option value="0">Indisponible</option>
                        </select>
                    </div>
                </div>
                <div style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Article</th>
                                <th>Statut</th>
                                <th>Type</th>
                                <th class="text-center">Ajouté</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $articles as $article)
                            <tr>
                                <td><img src="{{asset('storage/'.$article->image)}}" height="50px;" width="50px;"></td>
                                <td>{{$article->nom}} - {{$article->numeroDeSerie}}</td>
                                <td>
                                    @if ($article->estDisponible)
                                        <span class="right badge badge-success pr-3 pl-3">Disponible </span>
                                    @else
                                        <span class="right badge badge-danger pr-3 pl-3">Indisponible</span>
                                    @endif
                                </td>
                                <td>{{$article->typeArticle->nom}}</td>
                                <td class="text-center" ><span class="tag tag-success">{{$article->created_at
                                    ->diffforHumans()}}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click.prevent="editArticleModal({{$article->id}})"><i class="far fa-edit"></i></button>
                                    <button class="btn btn-link" wire:click.prevent="showDeleteArticle({{$article->id}})"><i class="far fa-trash-alt"></i></button>
                                </td>
                            <tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-dismissible alert-info">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-info"></i> Information</h5>
                                        Aucune donnée trouvée !
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{$articles->links()}}
                </div>
            </div>
        </div>
    </div>
</div>