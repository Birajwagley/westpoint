<!-- Slug Display -->
<div class="mb-4">
    <div class="inline-block bg-blue-50 border border-blue-500 rounded-lg px-4 py-2 shadow-sm">
        <span class="text-sm font-semibold text-gray-600">Slug:</span>
        <span id="slug"
            class="text-sm font-bold text-blue-600 ">{{ old('slug', isset($publication) ? $publication->slug : '') }}</span>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', isset($publication) ? $publication->slug : '') }}">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Select Publication -->
    <x-fields.select-field label="Publication Category" :data="isset($publication) ? $publication->publication_category_id : ''" fieldName="publication_category_id"
        :required=true :loopValue="$publicationCategories"/>

    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($publication) ? $publication->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($publication) ? $publication->name_np : null)" fieldName="name_np" :required=false />

    <!-- Author -->
    <x-fields.text-field label="Author" :data="old('author', isset($publication) ? $publication->author : null)" fieldName="author" :required=false />

    <!-- Thumbnail Image -->
    <x-fields.image-upload-field label="Thumbnail Image" :data="old('thumbnail_image', isset($publication) ? $publication->thumbnail_image : null)" fieldName="thumbnail_image"
        currentName="current_thumbnail_image" :required=true />

    <!-- Images -->
    <x-fields.multi-file-upload-field label="Images" :data="old('images', isset($publication) ? $publication->images : null)" fieldName="images" currentName="current_images"
        :required=false accept="image/*" routeName="publication" />

    <!-- Published Date -->
    <x-fields.date-field label="Published Date" :data="old('published_date', isset($publication) ? $publication->published_date : null)" fieldName="published_date" :required=true />

    <!-- External Link -->
    <x-fields.url-field class="col-span-3 hidden" id="externalLinkSpace" label="External Link" :data="old('external_link', isset($publication) ? $publication->external_link : null)"
        fieldName="external_link" :required=false />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($publication) ? $publication->is_published : 1)" fieldName="is_published" :required=false />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($publication) ? $publication->is_featured : 0)" fieldName="is_featured" :required=false />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- short description en -->
    <x-fields.textarea-field label="Short Description (English)" :data="old('short_description_en', isset($publication) ? $publication->short_description_en : null)" fieldName="short_description_en"
        :required=true />

    <!-- short description np -->
    <x-fields.textarea-field label="Short Description (Nepali)" :data="old('short_description_np', isset($publication) ? $publication->short_description_np : null)" fieldName="short_description_np"
        :required=false />

    <!-- description en -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($publication) ? $publication->description_en : null)" fieldName="description_en"
        :required=false />

    <!-- description np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($publication) ? $publication->description_np : null)" fieldName="description_np"
        :required=false />
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


        // on name_en field input create slug
        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '') // Remove invalid characters
                .replace(/\s+/g, '-') // Replace spaces with dashes
                .replace(/-+/g, '-'); // Remove duplicate dashes
        }

        $(document).on('input', '#name_en', function() {
            let nameEnValue = $(this).val();
            let slug = generateSlug(nameEnValue);

            $('input[name=slug]').val(slug);
            $('#slug').text(slug);
        });
    </script>
@endpush
