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
                                    <option value="CNI">CNI</option>
                                    <option value="PASSEPORT">PASSEPORT</option>
                                    <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
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
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Modifier un utilisateur</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>