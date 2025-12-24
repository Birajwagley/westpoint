<form action="{{ route('aboutus.update-cronology') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <table class="display table-auto" width="100%" id="cronologyTable">
        <tbody id="cronologyTableBody">
            @if (old('cronology_name_en'))
                @foreach ((array) old('cronology_name_en') as $key => $old)
                    @include('backend.about-us.partials.cronology.detail', [
                        'index' => $loop->index,
                    ])
                @endforeach
            @elseif($cronologies->isNotEmpty())
                @foreach ($cronologies as $cronology)
                    @include('backend.about-us.partials.cronology.detail', [
                        'index' => $loop->index,
                        'cronologyDetail' => $cronology,
                    ])
                @endforeach
            @else
                @include('backend.about-us.partials.cronology.detail', [
                    'index' => 0,
                ])
            @endif
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" class="text-right mt-2">
                    <button type="button"
                        class="mt-3 px-2 py-2 rounded-lg shadow-sm font-semibold text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                        id="add-cronology-btn">
                        <i class="fa fa-plus"></i> &nbsp;Add Cronology
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="flex mt-6 gap-2">
        <x-buttons.form-save-button type="Update" />
        <x-buttons.form-cancel-button href="{{ route('aboutus.edit') }}" />
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
            checkRowNumber('cronology-remove');
        });

        cronologyCount = {{ isset($cronologyCount) ? $cronologyCount - 1 : 0 }};
        $(document).on('click', '#add-cronology-btn', function() {
            cronologyCount = cronologyCount + 1;

            $.ajax({
                type: "GET",
                url: "{{ route('aboutus.get-cronology-detail') }}",
                data: {
                    index: cronologyCount,
                },
                success: function(response) {
                    $('#cronologyTableBody').append(response);

                    summernoteInitiate();
                }
            });

            checkRowNumber('cronology-remove');
        });

        $(document).on("click", ".cronology-remove", function() {
            $(this).closest(".cronology-detail").remove();

            checkRowNumber('cronology-remove');
        });

        function checkRowNumber(field) {
            if ($('.' + field).length === 1) {
                $('.' + field).hide();
            }
        }

        function summernoteInitiate(className) {
            $('.summernote').summernote({
                height: 300,
                tabsize: 2,
                codemirror: {
                    theme: 'monokai',
                    mode: 'text/html',
                    lineNumbers: true,
                    lineWrapping: true
                },
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                        'subscript', 'clear'
                    ]],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, editable) {
                        let content = $(this).summernote('code');
                        if (content.match(/(<p><br><\/p>\s*){2,}/g)) {
                            $(this).summernote('code', content.replace(/(<p><br><\/p>\s*){2,}/g,
                                ''));
                        }

                        if (content.replace(/\s+/g, '') == '<p><br></p>' || content.replace(/\s+/g,
                                '') == '<br>') {
                            $(this).summernote('code', null);
                        }
                    }
                }
            });
        }
    </script>
@endpush
