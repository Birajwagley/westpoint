<script>
    $(document).ready(function() {
        const table = $('#jobApplicationTable').DataTable({
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
                url: "{{ route('job-application.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'career_id',
                    render: function(data, type, row) {
                        return row.career ? row.career.name : '';
                    }
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'age'
                },
                {
                    data: 'current_address'
                },
                {
                    data: 'mobile_number'
                },
                {
                    data: 'cv',
                    render: function(data, type, row) {
                        if (data && data !== 'null') {
                            return `
                            <a href="/${data}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-file fa-2x"></i>
                            </a>
                        `;
                        }
                        return '<span class="text-muted">No CV</span>';
                    }
                },
                {
                    data: 'is_scanned',
                    render: function(data, type, row) {
                        checked = data == true ? 'Yes' : 'No';
                        return checked;
                    }
                },
                {
                    data: 'is_shortlisted',
                    render: function(data, type, row) {
                        checked = data == true ? 'Yes' : 'No';
                        return checked;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const viewUrl = "{{ route('job-application.show', ':id') }}".replace(
                            ':id', data.id);
                        const deleteUrl = "{{ route('job-application.destroy', ':id') }}"
                            .replace(':id', data.id);

                        return `
                        <div class="flex space-x-2">
                            <x-buttons.show-button url="${viewUrl}" />
                        </div>
                    `;
                    }
                }
            ],
            // rowCallback: function(row, data) {
            //     if ((data.is_scanned == 1 || data.is_scanned === true) &&
            //         (data.is_shortlisted == 1 || data.is_shortlisted === true)) {
            //         $(row).css('background-color', '#e0b3ff');
            //     } else if (data.is_scanned == 1 || data.is_scanned === true) {
            //         $(row).css('background-color', '#d4edda');
            //     } else if (data.is_shortlisted == 1 || data.is_shortlisted === true) {
            //         $(row).css('background-color', '#cce5ff');
            //     }
            // }

        });

        // Delete Role
        $(document).on("click", ".jobApplication-delete", function(e) {
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
                                    'Job Application deleted successfully.');
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

        // Is Scanned Toggle
        $(document).on("change", ".is-scanned-toggle", function() {
            const isChecked = $(this).prop('checked');
            const id = $(this).data('id');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            let scannedUrl = "{{ route('job-application.update-scanned-status', ':id') }}";
            scannedUrl = scannedUrl.replace(':id', id);

            $.ajax({
                type: "PUT",
                url: scannedUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    'is_scanned': isChecked
                },
                success: function(response) {
                    if (response == 1) {
                        successToast('Active status updated.');
                        table.ajax.reload(null,
                            false); // refresh row colors without reset paging
                    }
                },
                error: function() {
                    errorToast('Sorry, there was some issue. Please try again!!');
                }
            });
        });


        // Is Short Listed Toggle
        $(document).on("change", ".is-shortlisted-toggle", function() {
            const isChecked = $(this).prop('checked');
            const id = $(this).data('id');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            let updateUrl = "{{ route('job-application.update-shortlisted-status', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);

            $.ajax({
                type: "PUT",
                url: updateUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    'is_shortlisted': isChecked
                },
                success: function(response) {
                    if (response == 1) {
                        successToast('Active status updated.');
                        table.ajax.reload(null,
                            false); // refresh row colors without reset paging
                    }
                },
                error: function() {
                    errorToast('Sorry, there was some issue. Please try again!!');
                }
            });
        });
    });
</script>
