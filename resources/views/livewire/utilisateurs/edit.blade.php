<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Modifier un utilisateur</h3>
                </div>
                <form role="form" wire:submit.prevent="editUser()">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Nom</label>
                                <input type="text" class="form-control @error("editUser.nom") is-invalid 
                                @enderror" wire:model="editUser.nom">
                                @error("editUser.nom")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Prenom</label>
                                <input type="text" class="form-control @error("editUser.prenom") is-invalid @enderror" wire:model="editUser.prenom">
                                @error("editUser.prenom")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Sexe</label>
                                <select class="form-control @error("editUser.sexe") is-invalid @enderror" wire:model="editUser.sexe">
                                    <option value=""></option>
                                    <option value="1">M</option>
                                    <option value="0">F</option>
                                </select>
                                @error("editUser.sexe")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Email</label>
                                <input type="text" class="form-control @error("editUser.email") is-invalid @enderror" wire:model="editUser.email">
                                @error("editUser.email")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Télephone</label>
                                <input type="text" class="form-control @error("editUser.telephone") is-invalid @enderror" wire:model="editUser.telephone">
                                @error("editUser.telephone")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Piece d'indentité</label>
                                <select class="form-control @error("editUser.pieceIdentite") is-invalid @enderror" wire:model="editUser.pieceIdentite">
                                    <option value=""></option>
                                    <option value="0">CNI</option>
                                    <option value="1">PASSEPORT</option>
                                    <option value="2">PERMIS DE CONDUIRE</option>
                                </select>
                                @error("editUser.pieceIdentite")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Numéro de piece d'identite</label>
                                <input type="text" class="form-control @error("editUser.numeroPieceIdentite") is-invalid @enderror" wire:model="editUser.numeroPieceIdentite">
                                @error("editUser.numeroPieceIdentite")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button type="submit" wire:click.prevent="goToListeUser()" class="btn btn-danger">Retourner à la liste</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-key fa-1x"></i>Rénitialiser password</h3>
                        </div>
                        <div class="card-body">
                            <a href="" class="btn btn-link" wire:click.prevent="confirmPwdReset()">
                                Rénitialisation du password
                            </a>
                            <span>(Par defaut : password)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex align-content-center">
                            <h3 class="card-title flex-grow-1"><i class="fas fa-user fa-2x"></i>Role & Permission</h3>
                            <button class="btn bg-gradient-warning" wire:click="updateRolePermission"><i class="fas fa-check"></i>Appliquer les modifications</button>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                @foreach ($listeRolePermission["roles"] as $role)
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title flex-grow-1">
                                            <a data-parent="#accordion" aria-expanded="true">{{$role["role_nom"]}}</a>
                                        </h4>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" 
                                            wire:model.lazy="listeRolePermission.roles.{{$loop->index}}.active" 
                                            @if ($role["active"]) checked @endif id="customSwitch{{$role["role_id"]}}">
                                            <label class="custom-control-label" for="customSwitch{{$role["role_id"]}}">{{$role["active"]? "Activé" : "Désactivé"}}</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-4">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Permission</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($listeRolePermission["permissions"] as $perm)
                                    <tr>
                                        <td>{{$perm["permission_nom"]}}</td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input"  
                                                wire:model.lazy="listeRolePermission.permissions.{{$loop->index}}.active"
                                                @if ($perm["active"]) checked @endif id="customSwitchPermission
                                                {{$perm["permission_id"]}}">
                                                <label class="custom-control-label" for="customSwitchPermission
                                                {{$perm["permission_id"]}}">{{$perm["active"]? "Activé" : "Désactivé"}}</label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>