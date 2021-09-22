<div>

    @include("livewire.typearticle.edit_propriete_article")

    @include("livewire.typearticle.add_propriete_article")

    @include("livewire.typearticle.lister_type_article")

</div>


<script>
    window.addEventListener("showEditTypeArticleForm", function(e){
        Swal.fire({
        title: "Edition du type d'article",
        input: 'text',
        inputValue: e.detail.typearticle.nom,
        showCancelButton: true,
        confirmButtonText: 'Modifier',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#e3342f',
        inputValidator: (value) => {
            if (!value) {
            return 'Champ obligatoire'
            }
            @this.updateTypeArticle(e.detail.typearticle.id, value)
        } }
        )
    })
</script>

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

<script>
        window.addEventListener("showConfirmMessage", event => {
        Swal.fire({
            title: event.detail.message.title,
            icon: event.detail.message.type,
            text: event.detail.message.text,
            showCancelButton: true,
            confirmButtonText: 'Continuer',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed) {

                if(event.detail.message.data.typearticle_id)
                {
                    @this.deleteTypeArticle(event.detail.message.data.typearticle_id);
                }

                if(event.detail.message.data.propriete_id)
                {
                    @this.deleteProprieteTypeArticle(event.detail.message.data.propriete_id);
                }
            }
        })
    })
</script>

<!-- Modal ajout des propriétés des articles -->
<script>
    window.addEventListener("showModal", event => {
    $("#modalProp").modal({
        "show" : true,
        "backdrop" : "static"
    })
})
</script>

<!-- Modal fermeture Gestion des propriétés des articles -->
<script>
   window.addEventListener("closeModal", event => {
    $("#modalProp").modal("hide")
})
</script>

<!-- Editer la propriété d'un type d'article dans le Modal -->
<script>
    window.addEventListener("showEditModal", function(e){
        Swal.fire({
        title: "Edition de propriété type d'article",
        input: 'text',
        inputValue: e.detail.propriete_type_article.nom,
        showCancelButton: true,
        confirmButtonText: 'Modifier',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#e3342f',
        inputValidator: (value) => {
            if (!value) {
            return 'Champ obligatoire'
            }
            @this.updateProprieteTypeArticle(e.detail.propriete_type_article.id, value)
        } }
        )
    })
</script>

<!-- Modal Editer des propriétés des articles -->
<script>
    window.addEventListener("showEditModal", event => {
    $("#modalEditProp").modal({
        "show" : true,
        "backdrop" : "static"
    })
})
</script>

<!-- Modal fermeture Edition des propriétés des articles -->
<script>
   window.addEventListener("closeEditPropModal", event => {
    $("#modalEditProp").modal("hide")
})
</script>
