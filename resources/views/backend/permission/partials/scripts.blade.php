<script>
    $(document).ready(function() {
        const table = $('#permissionTable').DataTable({
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
                url: "{{ route('permission.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        return data;
                    }
                },

            ],
        });
    });
</script>
