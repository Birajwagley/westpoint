<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name En -->
    <x-fields.text-field label="Name En" :data="old('name_en', isset($popup) ? $popup->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name Np" :data="old('name_np', isset($popup) ? $popup->name_np : null)" fieldName="name_np" :required=false />

    <!-- Image -->
    <x-fields.image-upload-field label="Popup Image" :data="old('image', isset($popup) ? $popup->image : null)" fieldName="image" currentName="current_image"
        :required=true />

    <!-- Publish Date -->
    <x-fields.date-field label="Publish Date" :data="old('publish_date', isset($popup) ? $popup->publish_date : null)" fieldName="publish_date" :required=true />

    <!-- Publish Up to -->
    <x-fields.date-field label="Publish Up to" :data="old('publish_upto', isset($popup) ? $popup->publish_upto : null)" fieldName="publish_upto" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($popup) ? $popup->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($popup) ? $popup->is_published : null)" fieldName="is_published" :required=false />
</div>

@push('scripts')
    <script>
        $('.image').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });
    </script>
@endpush
