<div>

    @include("livewire.tarifications.lister")

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

                if(event.detail.message.data.tarification_id)
                {
                    @this.deleteTypeArticle(event.detail.message.data.tarification_id);
                }
            }
        })
    })
</script>