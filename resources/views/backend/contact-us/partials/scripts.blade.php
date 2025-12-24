<script>
    $(document).ready(function() {
        const table = $('#contactUsTable').DataTable({
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
                url: "{{ route('contact-us.data') }}",
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
                    data: 'contact_no'
                },
                {
                    data: 'email'
                },
                {
                    data: 'is_contacted',
                    render: function(data) {
                        return data == true ? 'Yes' : 'No';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        const show = "{{ route('contact-us.show', ':id') }}".replace(':id', data
                            .id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.show-button url="${show}" />
                                </div>
                            `;
                    }
                }
            ],
        });
    });
</script>
