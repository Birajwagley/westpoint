<script>
    $(document).ready(function() {
        const table = $('#subscriptionTable').DataTable({
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
                url: "{{ route('subscription.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'email'
                },
                {
                    data: 'is_active',
                    render: function(data, type, row) {
                        return `<span class="font-semibold ${data ==1? 'text-green-500' : 'text-red-500'}">${data == 1? 'Yes' : 'No'}</span>`;
                        return `<x-buttons.status-toggle-button dataId="${row.id}" status=${checked} class="is-published-toggle"/>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const editUrl = "{{ route('subscription.edit', ':id') }}".replace(':id',
                            data
                            .id);
                        const deleteUrl = "{{ route('subscription.destroy', ':id') }}".replace(
                            ':id',
                            data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    <x-buttons.delete-button url="${deleteUrl}" class="subscription-delete"/>
                                </div>
                            `;
                    }
                }
            ],
        });

        // DELETE Handler
        $(document).on("click", ".subscription-delete", function(e) {
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
                                successToast('Subscription deleted successfully.');
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
    });
</script>
