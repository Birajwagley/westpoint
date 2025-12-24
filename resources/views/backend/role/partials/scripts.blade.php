<script>
    $(document).ready(function() {
        const table = $('#roleTable').DataTable({
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
                url: "{{ route('role.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'name'
                },
                {
                    data: 'permissions',
                    render: function(data) {
                        return data.map(p =>
                            `<span class="inline-block bg-gray-100 text-xs text-gray-700 px-2 py-0.5 rounded mr-1 mb-1">${p}</span>`
                        ).join('');
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const editUrl = "{{ route('role.edit', ':id') }}".replace(':id', data
                            .id);
                        const deleteUrl = "{{ route('role.destroy', ':id') }}".replace(':id',
                            data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    <x-buttons.delete-button url="${deleteUrl}" class="role-delete"/>
                                </div>
                            `;
                    }
                }
            ],
        });
    });

    // Delete Role
    $(document).on("click", ".role-delete", function(e) {
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
                            successToast('Role deleted successfully.');
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
</script>
