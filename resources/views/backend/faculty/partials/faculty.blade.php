<form action="{{ $method == 'put' ? route('faculty.update', $faculty->id) : route('faculty.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    @if ($method == 'put')
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Name En -->
        <x-fields.text-field label="Name (English)" :data="old('name_en', isset($faculty) ? $faculty->name_en : null)" fieldName="name_en" :required=true />


        <!-- Name Np -->
        <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($faculty) ? $faculty->name_np : null)" fieldName="name_np" :required=false />

        <!-- Thumbnail Image -->
        <x-fields.image-upload-field label="Thumbnail Image" :data="old('thumbnail_image', isset($faculty) ? $faculty->thumbnail_image : null)" fieldName="thumbnail_image"
            currentName="current_thumbnail_image" class="" :required=true />

        <!-- Images -->
        <x-fields.multi-file-upload-field label="Images" :data="old('images', isset($faculty) ? $faculty->images : null)" fieldName="images"
            currentName="current_images" :required=false accept="image/*" routeName="faculty" />

        <!-- Display Order -->
        <x-fields.integer-field label="Display Order" :data="old('display_order', isset($faculty) ? $faculty->display_order : $displayOrder)" fieldName="display_order" class=""
            :required=true />

        <!-- Is Featured -->
        <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($faculty) ? $faculty->is_featured : 0)" fieldName="is_featured" class=""
            :required=false />

        <!-- Is Published -->
        <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($faculty) ? $faculty->is_published : 1)" fieldName="is_published" class=""
            :required=false />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">

        <!-- short description en -->
        <x-fields.textarea-field label="Short Description (English)" :data="old('short_description_en', isset($faculty) ? $faculty->short_description_en : null)" fieldName="short_description_en"
            :required=true />

        <!-- short description np -->
        <x-fields.textarea-field label="Short Description (Nepali)" :data="old('short_description_np', isset($faculty) ? $faculty->short_description_np : null)" fieldName="short_description_np"
            :required=false />

        <!-- description en -->
        <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($faculty) ? $faculty->description_en : null)" fieldName="description_en"
            :required=false />

        <!-- description np -->
        <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($faculty) ? $faculty->description_np : null)" fieldName="description_np"
            :required=false />
    </div>

    <div class="flex mt-6 gap-2">
        <x-buttons.form-save-button type="Save" />
        <x-buttons.form-cancel-button href="{{ route('faculty.index') }}" />
    </div>
</form>

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
