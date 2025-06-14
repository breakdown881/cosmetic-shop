$(document).ready(function () {
    $(document).on('click', '.btn-remove', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Warning',
            text: window.translations.confirmDelete,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: window.translations.deleteButton,
            cancelButtonText: window.translations.cancelButton
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + id).submit();
            }
        });
    });
});
