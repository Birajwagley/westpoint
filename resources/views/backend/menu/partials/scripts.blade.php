<script src="{{ asset('plugins/treegrid/jquery.treegrid.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#menuTable').treegrid();
        $('#menuTable').DataTable({
            scrollX: true,
            autoWidth: false,
            responsive: false,
            fixedHeader: true,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1,
            },
            lengthMenu: [
                [-1, 10, 25, 50, 100],
                ['All', 10, 25, 50, 100]
            ],
            pageLength: -1,
        });

        // Delete Role
        $(document).on("click", ".menu-delete", function(e) {
            e.preventDefault();
            const route = $(this).attr('href');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: 'Are you sure?',
                text: "The menu and all of its associated sub-menus will be permanently deleted!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#b1b1b0',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        type: "DELETE",
                        url: route,
                        success: function(response) {
                            if (response === true) {
                                successToast('Menu deleted successfully.');

                                location.reload();
                            } else {
                                errorToast(
                                    'Sorry, there was some issue. Please try again!!'
                                );
                            }
                        },
                        error: function() {
                            errorToast(
                                'Sorry, there was some issue. Please try again!!'
                            );
                        }
                    });
                }
            });
        });

        // ACTIVE Toggle
        $(document).on("change", ".menu-is-published-toggle", function() {
            const isChecked = $(this).prop('checked');
            const id = $(this).data('id');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            let updateUrl = "{{ route('update-is-published', [':id', ':model']) }}";
            updateUrl = updateUrl.replace(':id', id).replace(':model', 'Menu');

            $.ajax({
                type: "PUT",
                url: updateUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    'is_published': isChecked
                },
                success: function(response) {
                    if (response == 1) {
                        successToast('Active status updated.');
                    }
                },
                error: function() {
                    errorToast(
                        'Sorry, there was some issue. Please try again!!');
                }
            });
        });
    });
</script>
