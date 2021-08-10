<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Ajout d'un utilisateur</h3>
                </div>
                <form role="form" wire:submit.prevent="addUser()">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Nom</label>
                                <input type="text" class="form-control @error("newUser.nom") is-invalid 
                                @enderror" wire:model="newUser.nom">
                                @error("newUser.nom")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Prenom</label>
                                <input type="text" class="form-control @error("newUser.prenom") is-invalid @enderror" wire:model="newUser.prenom">
                                @error("newUser.prenom")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Sexe</label>
                                <select class="form-control @error("newUser.sexe") is-invalid @enderror" wire:model="newUser.sexe">
                                    <option value=""></option>
                                    <option value="1">M</option>
                                    <option value="0">F</option>
                                </select>
                                @error("newUser.sexe")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Email</label>
                                <input type="text" class="form-control @error("newUser.email") is-invalid @enderror" wire:model="newUser.email">
                                @error("newUser.email")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Télephone</label>
                                <input type="text" class="form-control @error("newUser.telephone") is-invalid @enderror" wire:model="newUser.telephone">
                                @error("newUser.telephone")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Piece d'indentité</label>
                                <select class="form-control @error("newUser.pieceIdentite") is-invalid @enderror" wire:model="newUser.pieceIdentite">
                                    <option value=""></option>
                                    <option value="CNI">CNI</option>
                                    <option value="PASSEPORT">PASSEPORT</option>
                                    <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                                </select>
                                @error("newUser.pieceIdentite")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <label>Numéro de piece d'identite</label>
                                <input type="text" class="form-control @error("newUser.numeroPieceIdentite") is-invalid @enderror" wire:model="newUser.numeroPieceIdentite">
                                @error("newUser.numeroPieceIdentite")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label>Mot de passe</label>
                                <input type="paswword" disabled placeholder="Mot de passe" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="submit" wire:click.prevent="goToListeUser()" class="btn btn-danger">Retourner à la liste</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("showSuccessMessage", event => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: event.detail.message || "Opération réussie",
            showConfirmButton: false,
            timer: 5000
        })
    })
</script>