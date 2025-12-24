<script>
    $(document).ready(function() {
        const table = $('#admissionTable').DataTable({
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
                url: "{{ route('admission.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: null,
                    render: function(data) {
                        const middle = data.middle_name ? ` ${data.middle_name}` : '';
                        return `${data.first_name}${middle} ${data.last_name}`;
                    }
                },
                {
                    data: 'email'
                },
                {
                    data: 'academic_level_id',
                    render: function(data, type, row) {
                        return row.academic_level.name ?? '';
                    }
                },
                {
                    data: 'is_school',
                    render: function(data) {
                        return data ? 'Yes' : 'No';
                    }
                },
                {
                    data: 'photo',
                    render: function(data) {
                        if (!data) return '';
                        return `<a href="${data}" target="_blank">
                                    <img src="${data}" alt="Photo" style="height: 50px; width: auto; border-radius: 4px;" />
                                </a>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const viewUrl = "{{ route('admission.show', ':id') }}".replace(
                            ':id', data.id);
                        const editUrl = "{{ route('admission.edit', ':id') }}".replace(':id',
                            data.id);
                        const deleteUrl = "{{ route('admission.destroy', ':id') }}".replace(
                            ':id', data.id);

                        return `
                            <div class="flex space-x-2">
                                <x-buttons.show-button url="${viewUrl}" />
                                <x-buttons.edit-button url="${editUrl}" />
                                <x-buttons.delete-button url="${deleteUrl}" class="admission-delete"/>
                            </div>
                        `;
                    }
                }
            ],
        });

        // Delete Admission
        $(document).on("click", ".admission-delete", function(e) {
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
                                successToast('Admission deleted successfully.');
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
