<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    <!-- Images -->
    <x-fields.multi-file-upload-field label="Images" :data="old(
        'images',
        isset($alumni)
            ? (isset($alumni->images) && count(json_decode($alumni->images)) > 0
                ? $alumni->images
                : null)
            : null,
    )" fieldName="images" currentName="current_images"
        :required=true accept="image/*" routeName="alumni" />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">

    <!-- Link -->

    <div>
        <fieldset class="border mb-3 p-3">

            <table class="display table-auto" width="100%" id="contactTable">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Link</th>
                    </tr>
                </thead>

                <tbody id="linkTableBody">
                    @if (old('link'))
                        @foreach ((array) old('link') as $key => $old)
                            @include('backend.alumni.partials.link', [
                                'index' => $loop->index,
                            ])
                        @endforeach
                    @elseif(isset($alumni) && $alumni->links)
                        @foreach ($alumni->links as $link)
                            @include('backend.alumni.partials.link', [
                                'index' => $loop->index,
                                'data' => $link,
                            ])
                        @endforeach
                    @else
                        @include('backend.alumni.partials.link', [
                            'index' => 0,
                        ])
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right mt-2">
                            <button type="button"
                                class="mt-3 px-2 py-2 rounded-lg shadow-sm font-semibold text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                                id="add-links-btn">
                                <i class="fa fa-plus"></i> &nbsp;Add Link
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </fieldset>
    </div>

    <!-- description en -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($alumni) ? $alumni->description_en : null)" fieldName="description_en"
        :required=true />

    <!-- description np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($alumni) ? $alumni->description_np : null)" fieldName="description_np"
        :required=false />

    <!-- group en -->
    <x-fields.textarea-summernote-field label="Group (English)" :data="old('group_en', isset($alumni) ? $alumni->group_en : null)" fieldName="group_en" :required=true />

    <!-- group np -->
    <x-fields.textarea-summernote-field label="Group (Nepali)" :data="old('group_np', isset($alumni) ? $alumni->group_np : null)" fieldName="group_np" :required=false />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            checkRowNumber('link-remove');
        });
        $('.image').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });

        linksCount = {{ isset($linkCount) ? $linkCount - 1 : 0 }};
        $(document).on('click', '#add-links-btn', function() {
            linksCount = linksCount + 1;

            $.ajax({
                type: "GET",
                url: "{{ route('alumni.links') }}",
                data: {
                    type: 'en',
                },
                success: function(response) {
                    $('#linkTableBody').append(response);
                }
            });
            checkRowNumber('link-remove');
        });

        $(document).on("click", ".link-remove", function() {
            $(this).closest("tr").remove();

            checkRowNumber('link-remove');
        });

        function checkRowNumber(field) {
            if ($('.' + field).length === 1) {
                $('.' + field).hide();
            }
        }
    </script>
@endpush
