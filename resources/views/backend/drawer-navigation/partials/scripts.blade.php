@php
    use App\Enum\DrawerNavigationType;
@endphp

<script>
    $(document).ready(function() {
        const table = $('#drawerNavigationTable').DataTable({
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
                url: "{{ route('drawer-navigation.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'icon',
                    orderable: false,
                    searchable: false,
                    render: data => {
                        return '<i class="' + data + ' fa-2x"></i>';
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'type',
                    render: function(data, type, row) {
                        types = @json(DrawerNavigationType::map());

                        return types[data];
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        if (data.type == @json(DrawerNavigationType::MENU->value)) {
                            return row.menu.name;
                        } else if (data.type == @json(DrawerNavigationType::EXTERNALLINK->value)) {
                            return '<a target="_blank" href=' + data.value +
                                '><i class="fa fa-link"></i></a>';
                        } else {
                            return data.value;
                        }
                    }
                },
                {
                    data: 'display_order'
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
                        const editUrl = "{{ route('drawer-navigation.edit', ':id') }}".replace(
                            ':id', data
                            .id);
                        const deleteUrl = "{{ route('drawer-navigation.destroy', ':id') }}"
                            .replace(':id',
                                data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    <x-buttons.delete-button url="${deleteUrl}" class="drawer-navigation-delete"/>
                                </div>
                            `;
                    }
                }
            ],
        });

        // DELETE Handler
        $(document).on("click", ".drawer-navigation-delete", function(e) {
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
                                    'Drawer Navigation deleted successfully.');
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

        // PUBLISHED Toggle
        $(document).on("change", ".is-published-toggle", function() {
            const isChecked = $(this).prop('checked');
            const id = $(this).data('id');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            let updateUrl = "{{ route('update-is-published', [':id', ':model']) }}";
            updateUrl = updateUrl.replace(':id', id).replace(':model', 'DrawerNavigation');

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
                        successToast('Published status updated.');
                    }
                },
                error: function() {
                    errorToast('Sorry, there was some issue. Please try again!!');
                }
            });
        });
    });
</script>
