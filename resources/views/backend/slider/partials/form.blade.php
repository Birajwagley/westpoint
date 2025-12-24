<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name En -->
    <x-fields.text-field label="Name En" :data="old('name_en', isset($slider) ? $slider->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name Np" :data="old('name_np', isset($slider) ? $slider->name_np : null)" fieldName="name_np" :required=false />

    <!-- Image -->
    <x-fields.image-upload-field label="Slider Image" :data="old('image', isset($slider) ? $slider->image : null)" fieldName="image" currentName="current_image"
        :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($slider) ? $slider->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($slider) ? $slider->is_published : null)" fieldName="is_published" :required=false />
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
