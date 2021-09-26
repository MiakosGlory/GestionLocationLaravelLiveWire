<div wire:ignore.self>

    @if($currentPage == PAGE_EDIT)
        @include("livewire.clients.edit_client")
    @endif
    @if($currentPage == PAGE_AJOUT)
        @include("livewire.clients.create_client")
    @endif
    @if($currentPage == PAGE_LIST)
        @include("livewire.clients.lister_client")
    @endif

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

            if(event.detail.message.data.client_id)
            {
                @this.deleteClient(event.detail.message.data.client_id);
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