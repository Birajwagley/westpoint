<script>
    $(document).ready(function() {
        const table = $('#pageTable').DataTable({
            bSortCellsTop: true,
            scrollX: true,
            autoWidth: false,
            responsive: false,
            fixedHeader: true,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1,
            },
            ajax: {
                url: "{{ route('page.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'menu',
                    render: function(data, type, row) {
                        return row.menu ? row.menu.name : '-';
                    },
                },
                {
                    data: 'title'
                },
                {
                    data: 'banner_image',
                    render: function(data) {
                        if (!data) return '';

                        return `<a href="${data}" target="_blank"><img src="${data}" alt="Banner Image" style="height: 50px; width: auto; border-radius: 4px;" /></a>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const editUrl = "{{ route('page.edit', ':id') }}".replace(':id',
                            data
                            .id);
                        const deleteUrl = "{{ route('page.destroy', ':id') }}".replace(
                            ':id',
                            data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    ${data.id == 1 ? '' :  `<x-buttons.delete-button url="${deleteUrl}" class="publication-category-delete"/>`}
                                </div>
                            `;
                    }
                }
            ],
        });

        // DELETE Handler
        $(document).on("click", ".page-delete", function(e) {
            e.preventDefault();
            const route = $(this).attr('href');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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
                                successToast('Page deleted successfully.');

                                table.ajax.reload();
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
        $(document).on("change", ".is-published-toggle", function() {
            const isChecked = $(this).prop('checked');
            const id = $(this).data('id');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            let updateUrl = "{{ route('update-is-published', [':id', ':model']) }}";
            updateUrl = updateUrl.replace(':id', id).replace(':model', 'Page');

            $.ajax({
                type: "PUT",
                url: updateUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    'is_active': isChecked
                },
                success: function(response) {
                    if (response == 1) {
                        successToast('Active status updated.');
                    }
                },
                error: function() {
                    errorToast('Sorry, there was some issue. Please try again!!');
                }
            });
        });
    });
</script>
