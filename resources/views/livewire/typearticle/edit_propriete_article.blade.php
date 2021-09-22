 <!-- Modal pour Edit les propriétés d'un type d'article-->
 <div class="modal fade" id="modalEditProp" style="z-index: 1900" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition des propriétés de "{{optional($selectedTypeArticle)->nom}}"</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex mb-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom" wire:model="editPropTypeArticle.nom" class="form-control
                                @error("editPropTypeArticle.nom") is-invalid @enderror"
                            >
                            @error("editPropTypeArticle.nom")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="flex-grow-1">
                            <select wire:model="editPropTypeArticle.estObligatoire"  class="form-control
                            @error("editPropTypeArticle.estObligatoire") is-invalid @enderror"
                            >
                                <option value="">Est-il obligatoire ?</option>
                                <option value="0">Non</option>
                                <option value="1">Oui</option>
                            </select>
                            @error("editPropTypeArticle.estObligatoire")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" wire:click="updatePropTypeArticle">Valider</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeEditPropModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin du modal Edit du type d'article -->