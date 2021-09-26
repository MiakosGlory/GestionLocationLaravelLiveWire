<!-- Modal pour ajouter un article-->
<div class="modal fade" id="modalAddLocation" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'un article</h5>
            </div>
            <div class="modal-body">
                <form role="form" wire:submit.prevent="addLocation">
                    <div class="d-flex mb-4 bg-gray-light p-3">
                        <div class="col-6">
                            <div class="flex-grow-1 mr-2 mb-3">
                                <label>Date de début de location</label>
                                <input type="date" wire:model="newLocation.dateDebut" class="form-control
                                    @error("newLocation.dateDebut") is-invalid @enderror"
                                >
                                @error("newLocation.dateDebut")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="flex-grow-1 mr-2">
                                <label>Date de fin de location</label>
                                <input type="date" wire:model="newLocation.dateFin" class="form-control
                                    @error("newLocation.dateFin") is-invalid @enderror"
                                >
                                @error("newLocation.dateFin")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="flex-grow-1 mb-3">
                                <label>Effectué par (Agent)</label>
                                <select wire:model="newLocation.user_id"  class="form-control
                                @error("newLocation.user_id") is-invalid @enderror"
                                >
                                    <option value=""></option>
                                    @foreach ($users as $user )
                                        <option value="{{$user->id}}">{{$user->nom}} {{$user->prenom}}</option>
                                    @endforeach
                                </select>
                                @error("nnewLocation.user_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="flex-grow-1">
                                <label>Le Client</label>
                                <select wire:model="newLocation.client_id"  class="form-control
                                @error("newLocation.client_id") is-invalid @enderror"
                                >
                                    <option value=""></option>
                                    @foreach ($clients as $client )
                                        <option value="{{$client->id}}">{{$client->nom}} {{$client->prenom}}</option>
                                    @endforeach
                                </select>
                                @error("newLocation.client_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeAddLocationModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin du modal Ajout d'une location -->