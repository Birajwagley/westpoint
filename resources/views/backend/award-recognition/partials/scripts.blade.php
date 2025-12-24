<script>
    $(document).ready(function() {
        const table = $('#awardRecognitionTable').DataTable({
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
                url: "{{ route('award-recognition.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'title_en'
                },
                {
                    data: 'display_order'
                },
                {
                    data: 'is_featured',
                    render: function(data, type, row, meta) {
                        return data == 1 ? '<span class="font-semibold text-green-500">Yes</span>' :
                            '<span class="font-semibold text-red-500">No</span>';
                    }
                },
                {
                    data: 'is_published',
                    render: function(data, type, row) {
                        checked = data == true ? 'checked' : '';
                        return `<x-buttons.status-toggle-button dataId="${row.id}" status=${checked} class="is-published-toggle"/>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const editUrl = "{{ route('award-recognition.edit', ':id') }}".replace(
                            ':id', data
                            .id);
                        const deleteUrl = "{{ route('award-recognition.destroy', ':id') }}"
                            .replace(':id',
                                data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    <x-buttons.delete-button url="${deleteUrl}" class="award-recognition-delete"/>
                                </div>
                            `;
                    }
                }
            ],
        });

        // Delete Role
        $(document).on("click", ".award-recognition-delete", function(e) {
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
                                successToast(
                                    'Award Recognition deleted successfully.');
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
            updateUrl = updateUrl.replace(':id', id).replace(':model', 'AwardRecognition');

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
