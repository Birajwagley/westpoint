<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Select Download -->
    <x-fields.select-field label="Download Category" :data="isset($download) ? $download->download_category_id : ''" fieldName="download_category_id" :required=true
        :loopValue="$downloadCategories" />

    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($download) ? $download->name_en : null)" fieldName="name_en" :required=true />


    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($download) ? $download->name_np : null)" fieldName="name_np" :required=false />

    <!-- Files -->
    <x-fields.file-upload-field label="File" :data="old('file', isset($download) ? $download->file : null)" fieldName="file" currentName="current_file"
        :required=false accept=".pdf, .doc, .docx, .xls, .xlsx" routeName="download" />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($download) ? $download->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($download) ? $download->is_published : null)" fieldName="is_published" :required=false />
</div>

@push('scripts')
    <script>
        $('#file').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden');
                $('#current_' + fieldId + '_value').val(null);
            }
        });
    </script>
@endpush
