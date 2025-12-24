@php
    use App\Enum\LinkTypeEnum;
@endphp

<script>
    $(document).ready(function() {
        const table = $('#linkTable').DataTable({
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
                url: "{{ route('link.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'type',
                    render: function(data, type, row) {
                        types = @json(LinkTypeEnum::map());

                        return types[data];
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'menu',
                    render: function(data, type, row) {
                        return row.menu ? row.menu.name : '-';
                    },
                },
                {
                    data: 'url',
                    render: function(data, type, row) {
                        return data ? `<a href="${data}" target="_blank"><svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Box/frame -->
                                        <path d="M18 13v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h5"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <!-- Arrow pointing out (external) -->
                                        <path d="M15 3h6v6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 14L21 3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></a>` : '-';
                    },
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
                        const editUrl = "{{ route('link.edit', ':id') }}".replace(':id',
                            data
                            .id);
                        const deleteUrl = "{{ route('link.destroy', ':id') }}".replace(
                            ':id',
                            data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    <x-buttons.delete-button url="${deleteUrl}" class="link-delete"/>
                                </div>
                            `;
                    }
                }
            ],
        });

        // DELETE Handler
        $(document).on("click", ".link-delete", function(e) {
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
                                successToast('Link deleted successfully.');

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
            updateUrl = updateUrl.replace(':id', id).replace(':model', 'Link');

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
                    errorToast('Sorry, there was some issue. Please try again!!');
                }
            });
        });
    });
</script>
