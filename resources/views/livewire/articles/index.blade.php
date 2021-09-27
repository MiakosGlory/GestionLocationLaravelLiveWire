<div>

    @include("livewire.articles.modal_tarif")

    @include("livewire.articles.edit_article")

    @include("livewire.articles.create_article")

    @include("livewire.articles.lister_article")

</div>

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

            if(event.detail.message.data.article_id)
            {
                @this.deleteArticle(event.detail.message.data.article_id);
            }
        }
    })
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


<!-- Modal Voir les Tarifs des articles -->
<script>
    window.addEventListener("showModalTarification", event => {
    $("#modalTarification").modal({
        "show" : true
    })
})
</script>


<!-- Modal ajout des articles -->
<script>
    window.addEventListener("showAddArticleModal", event => {
    $("#modalAddArticle").modal({
        "show" : true,
        "backdrop" : "static"
    })
})
</script>

<!-- Modal fermeture ajout des articles -->
<script>
   window.addEventListener("closeAddArticleModal", event => {
    $("#modalAddArticle").modal("hide")
})
</script>

<!-- Modal Editer des articles -->
<script>
    window.addEventListener("showEditArticleModal", event => {
    $("#modalEditArticle").modal({
        "show" : true,
        "backdrop" : "static"
    })
})
</script>

<!-- Modal fermeture editer des articles -->
<script>
   window.addEventListener("closeEditArticleModal", event => {
    $("#modalEditArticle").modal("hide")
})
</script>