@php
    use App\Enum\PerspectiveFromEnum;
@endphp

<script>
    $(document).ready(function() {
        const table = $('#testimonialTable').DataTable({
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
                url: "{{ route('testimonial.data') }}",
                dataSrc: 'datas',
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'perspective_from',
                    render: function(data, type, row) {
                        types = @json(PerspectiveFromEnum::map());

                        return types[data];
                    }
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'image',
                    orderable: false,
                    searchable: false,
                    render: data => {
                        const imageUrl = data ?
                            `<img src="${'/' + data}" alt="Image" class="h-10 w-10 rounded-full border object-cover" />` :
                            '-';
                        return imageUrl;
                    }
                },
                {
                    data: 'is_featured',
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
                        const editUrl = "{{ route('testimonial.edit', ':id') }}".replace(':id',
                            data.id);
                        const deleteUrl = "{{ route('testimonial.destroy', ':id') }}".replace(
                            ':id', data.id);

                        return `
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="${editUrl}" />
                                    <x-buttons.delete-button url="${deleteUrl}" class="testimonial-delete"/>
                                </div>
                            `;
                    }
                }
            ],
        });

        // Delete Role
        $(document).on("click", ".testimonial-delete", function(e) {
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
                                successToast('Testimonial  deleted successfully.');
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
