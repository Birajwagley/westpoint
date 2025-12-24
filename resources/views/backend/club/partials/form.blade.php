@php
    use App\Enum\LinkTypeEnum;
    use App\Enum\ClubEnum;
@endphp

<!-- Slug Display -->
<div class="mb-4">
    <div class="inline-block bg-blue-50 border border-blue-500 rounded-lg px-4 py-2 shadow-sm">
        <span class="text-sm font-semibold text-gray-600">Slug:</span>
        <span id="slug"
            class="text-sm font-bold text-blue-600 ">{{ old('slug', isset($club) ? $club->slug : '') }}</span>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', isset($club) ? $club->slug : '') }}">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <x-fields.select-enum-field label="School Amenity" :data="isset($club) ? $club->school_amenity : ''" fieldName="school_amenity" :required=true
        :loopValue="$school_amenities" useEnum="ClubEnum" />

    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($club) ? $club->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($club) ? $club->name_np : null)" fieldName="name_np" :required=false />

    <!-- Icon -->
    <x-fields.icon-field label="Icon" :data="old('icon', isset($club) ? $club->icon : null)" fieldName="icon" :required=false />

    <!-- Thumbnail Image -->
    <x-fields.image-upload-field label="Thumbnail Image" :data="old('thumbnail_image', isset($club) ? $club->thumbnail_image : null)" fieldName="thumbnail_image"
        currentName="current_thumbnail_image" :required=true />

    <!-- Images -->
    <x-fields.multi-file-upload-field label="Images" :data="old('images', isset($club) ? $club->images : null)" fieldName="images" currentName="current_images"
        :required=false accept="image/*" routeName="beyond-academic" />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($club) ? $club->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($club) ? $club->is_published : 1)" fieldName="is_published" :required=false />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($club) ? $club->is_featured : 0)" fieldName="is_featured" :required=false />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- short description en -->
    <x-fields.textarea-field label="Short Description (English)" :data="old('short_description_en', isset($club) ? $club->short_description_en : null)" fieldName="short_description_en"
        :required=true />

    <!-- short description np -->
    <x-fields.textarea-field label="Short Description (Nepali)" :data="old('short_description_np', isset($club) ? $club->short_description_np : null)" fieldName="short_description_np"
        :required=false />

    <!-- description en -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($club) ? $club->description_en : null)" fieldName="description_en"
        :required=false />

    <!-- description np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($club) ? $club->description_np : null)" fieldName="description_np"
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
