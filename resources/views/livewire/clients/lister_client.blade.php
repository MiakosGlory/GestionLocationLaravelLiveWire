<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Gestion des Clients</h3>
                <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="getButton()"> <i class="fas fa-plus"></i>Ajouter Client</a>
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
                        <th style="width:5%">Sexe</th>
                        <th style="width:25%">Nom et Prénom</th>
                        <th style="width:20%">Date/lieu de naissance</th>
                        <th style="width:25%">Nationalité</th>
                        <th style="width:25%">Pays</th>
                        <th style="width:25%">Ville</th>
                        <th style="width:25%">Adresse</th>
                        <th style="width:25%">Téléphone</th>
                        <th style="width:25%">Pièce Identité</th>
                        <th style="width:25%">Numéro de Piece Id</th>
                        <th class="text-center" style="width:20%">Ajouté</th>
                        <th class="text-center" style="width:30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $clients as $client)
                    <tr>
                        <td> 
                            @if($client->sexe == 0)
                                F
                            @else
                                M
                            @endif
                        </td>
                        <td>{{$client->nom}} {{$client->prenom}}</td>
                        <td>{{$client->dateNaissance}} | {{$client->lieuNaissance}}</td>
                        <td>{{$client->nationalite}}</td>
                        <td>{{$client->pays}}</td>
                        <td>{{$client->ville}}</td>
                        <td>{{$client->adresse}}</td>
                        <td>{{$client->telephone}}</td>
                        <td>{{$client->pieceIdentite}}</td>
                        <td>{{$client->numeroPieceIdentite}}</td>
                        <td class="text-center" ><span class="tag tag-success">{{$client->created_at
                            ->diffforHumans()}}</span></td>
                        <td class="text-center">
                            <button class="btn btn-link" wire:click.prevent="goToEditClient({{$client->id}})"><i class="far fa-edit"></i></button>
                            <button class="btn btn-link" wire:click.prevent="confirmDelete({{$client->id}})"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                    <tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{$clients->links()}}
                </div>
            </div>
        </div>
    </div>
</div>