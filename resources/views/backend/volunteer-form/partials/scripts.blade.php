<script>
    $(document).ready(function() {
        const table = $('#volunteerFormTable').DataTable({
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
                url: "{{ route('volunteer-form.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'age'
                },
                {
                    data: 'nationality'
                },
                {
                    data: 'contact_no'
                },
                {
                    data: 'current_address'
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
                        const viewUrl = "{{ route('volunteer-form.show', ':id') }}".replace(
                            ':id', data
                            .id);
                        const deleteUrl = "{{ route('volunteer-form.destroy', ':id') }}"
                            .replace(':id',
                                data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.show-button url="${viewUrl}" />
                                </div>
                            `;
                    }
                }
            ],
        });

    });
</script>
