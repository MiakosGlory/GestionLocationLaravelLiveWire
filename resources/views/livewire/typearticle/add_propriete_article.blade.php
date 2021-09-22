<!-- Modal pour les propriétés d'un type d'article-->
<div class="modal fade" id="modalProp" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestion des propriétés de "{{optional($selectedTypeArticle)->nom}}"</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex mb-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom" wire:model="listeProprieteTypeArticle.nom" class="form-control
                                @error("listeProprieteTypeArticle.nom") is-invalid @enderror"
                            >
                            @error("listeProprieteTypeArticle.nom")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="flex-grow-1">
                            <select wire:model="listeProprieteTypeArticle.estObligatoire"  class="form-control
                            @error("listeProprieteTypeArticle.estObligatoire") is-invalid @enderror"
                            >
                                <option value="">Est-il obligatoire ?</option>
                                <option value="0">Non</option>
                                <option value="1">Oui</option>
                            </select>
                            @error("listeProprieteTypeArticle.estObligatoire")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" wire:click="addPropTypeArticle">Ajouter</button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <th>Nom</th>
                        <th>Est obligatoire</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($proprieteTypeArticle as $prop)
                            <tr>
                                <td>{{$prop->nom}}</td>
                                <td>{{$prop->estObligatoire == 0 ? "NON" : "OUI"}}</td>
                                <td>
                                    <button class="btn btn-link" wire:click="editPropTypeArticle({{$prop->id}})"><i class="far fa-edit"></i></button>
                                    @if (count($prop->articles) == 0)
                                        <button class="btn btn-link" wire:click="showDeletePropArticle({{$prop->id}})"><i class="far fa-trash-alt"></i></button>
                                    @endif
                                    
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <span class="text-info">
                                    Pas de propriétés pour ce type d'article
                                </span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin du modal du type d'article -->