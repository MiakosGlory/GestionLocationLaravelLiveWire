<div>

    @include("livewire.locations.edit_location")

    @include("livewire.locations.create_location")

    @include("livewire.locations.lister_location")

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

<!-- Modal ajout des locations -->
<script>
    window.addEventListener("showAddLocationModal", event => {
    $("#modalAddLocation").modal({
        "show" : true,
        "backdrop" : "static"
    })
})
</script>

<!-- Modal fermeture ajout des locations -->
<script>
   window.addEventListener("closeAddLocationModal", event => {
    $("#modalAddLocation").modal("hide")
})
</script>

<!-- Modal Editer des location -->
<script>
    window.addEventListener("showEditLocationModal", event => {
    $("#modalEditLocation").modal({
        "show" : true,
        "backdrop" : "static"
    })
})
</script>

<!-- Modal fermeture editer des locations -->
<script>
   window.addEventListener("closeEditLocationModal", event => {
    $("#modalEditLocation").modal("hide")
})
</script>