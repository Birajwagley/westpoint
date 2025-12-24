<!-- Slug Display -->
<div class="mb-4" id="slugDiv">
    <div class="inline-block bg-blue-50 border border-blue-500 rounded-lg px-4 py-2 shadow-sm">
        <span class="text-sm font-semibold text-gray-600">Slug:</span>
        <span id="slug"
            class="text-sm font-bold text-blue-600 ">{{ old('slug', isset($academicLevel) ? $academicLevel->slug : '') }}</span>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', isset($academicLevel) ? $academicLevel->slug : '') }}">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($academicLevel) ? $academicLevel->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($academicLevel) ? $academicLevel->name_np : null)" fieldName="name_np" :required=false />

    <!-- Thumbnail Image -->
    <x-fields.image-upload-field label="Thumbnail Image" :data="old('thumbnail_image', isset($academicLevel) ? $academicLevel->thumbnail_image : null)" fieldName="thumbnail_image"
        currentName="current_thumbnail_image" :required=true />

    <!-- Images -->
    <x-fields.multi-file-upload-field label="Images" :data="old('images', isset($academicLevel) ? $academicLevel->images : null)" fieldName="images" currentName="current_images"
        :required=false accept="image/*" routeName="academic-level" />

    <!-- Icon -->
    <x-fields.icon-field label="Icon" :data="old('icon', isset($academicLevel) ? $academicLevel->icon : null)" fieldName="icon" :required=true />

    <!-- Classes -->
    <x-fields.multi-select-field label="Class" :data="isset($academicLevel) ? $academicLevel->classes->pluck('id')->toArray() : []" fieldName="class_id" class="col-span-3"
        :required=false :loopValue="$classes" />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($academicLevel) ? $academicLevel->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($academicLevel) ? $academicLevel->is_featured : 0)" fieldName="is_featured" :required=false />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($academicLevel) ? $academicLevel->is_published : 1)" fieldName="is_published" :required=false />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- tagline en -->
    <x-fields.textarea-field label="Tagline (English)" :data="old('tagline_en', isset($academicLevel) ? $academicLevel->tagline_en : null)" fieldName="tagline_en" :required=true />

    <!-- tagline np -->
    <x-fields.textarea-field label="Tagline (Nepali)" :data="old('tagline_np', isset($academicLevel) ? $academicLevel->tagline_np : null)" fieldName="tagline_np" :required=false />

    <!-- short description en -->
    <x-fields.textarea-summernote-field label="Short Description (English)" :data="old('short_description_en', isset($academicLevel) ? $academicLevel->short_description_en : null)"
        fieldName="short_description_en" :required=true />

    <!-- short description np -->
    <x-fields.textarea-summernote-field label="Short Description (Nepali)" :data="old('short_description_np', isset($academicLevel) ? $academicLevel->short_description_np : null)"
        fieldName="short_description_np" :required=false />

    <!-- description en -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($academicLevel) ? $academicLevel->description_en : null)" fieldName="description_en"
        :required=false />

    <!-- description np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($academicLevel) ? $academicLevel->description_np : null)" fieldName="description_np"
        :required=false />
</div>


@push('scripts')
    <script>
        $(document).on('input', '#name_en', function() {
            type = $('#type').val();

            let nameEnValue = $(this).val();
            let slug = generateSlug(nameEnValue);
            $('input[name=slug]').val(slug);
            $('#slug').text(slug);
        });

        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }

        $('.select-multi').select2({
            theme: 'tailwindcss-3',
        });

        $('.image').on('change', function() {
            fieldId = $(this).attr('id');

            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });
    </script>
@endpush
