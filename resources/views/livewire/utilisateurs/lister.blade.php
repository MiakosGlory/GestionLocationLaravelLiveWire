<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Gestion des utilisateurs</h3>
                <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="getButton()"> <i class="fas fa-plus"></i>Ajouter Utilisateur</a>
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
                    <th style="width:5%"></th>
                    <th style="width:25%">Utilisateur</th>
                    <th style="width:20%">Role</th>
                    <th class="text-center" style="width:20%">Ajouté</th>
                    <th class="text-center" style="width:30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $users as $user)
                    <tr>
                        <td>{{$user->sexe}}</td>
                        <td>{{$user->nom}} {{$user->prenom}}</td>
                        <td>{{$user->roles->implode("nom", " | ")}}</td>
                        <td class="text-center" ><span class="tag tag-success">{{$user->created_at
                            ->diffforHumans()}}</span></td>
                        <td class="text-center">
                            <button class="btn btn-link" wire:click.prevent="goToEditUser({{$user->id}})"><i class="far fa-edit"></i></button>
                            <button class="btn btn-link" wire:click.prevent="confirmDelete({{$user->id}})"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                    <tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>