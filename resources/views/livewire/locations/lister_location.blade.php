<div class="row pt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Gestion des locations</h3>
                <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="addLocationModal"> <i class="fas fa-plus"></i>Ajouter Location</a>
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
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Client</th>
                        <th>Effectué Par</th>
                        <th>Statut</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $locations as $location)
                    <tr>
                        <td>{{optional($location->dateDebut)}}</td>
                        <td>{{optional($location->dateFin)}}</td>
                        <td>{{optional($location->client_id->nom)}} {{optional($location->client_id->prenom)}}</td>
                        <td>{{optional($location->user_id->nom)}} {{optional($location->user_id->prenom)}}</td>
                        <td>
                            @if (optional($location->statut_location_id)->nom == "En cours")
                                <span class="right badge badge-warning pr-3 pl-3">EN COURS </span>
                            @elseif (optional($location->statut_location_id)->nom == "Terminée")
                                <span class="right badge badge-success pr-3 pl-3">TERMINEE</span>
                            @else
                                <span class="right badge badge-danger pr-3 pl-3">EN ATTENTE</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-link" wire:click.prevent="editLocationModal({{$location->id}})"><i class="far fa-edit"></i></button>
                            <button class="btn btn-link" wire:click.prevent="showDeleteLocation({{$location->id}})"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                    <tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$locations->links()}}
            </div>
        </div>
    </div>
</div>