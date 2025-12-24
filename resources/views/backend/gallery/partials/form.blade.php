@php
    use App\Enum\GalleryTypeEnum;
@endphp

<!-- Slug Display -->
<div class="mb-4">
    <div class="inline-block bg-blue-50 border border-blue-500 rounded-lg px-4 py-2 shadow-sm">
        <span class="text-sm font-semibold text-gray-600">Slug:</span>
        <span id="slug"
            class="text-sm font-bold text-blue-600 ">{{ old('slug', isset($gallery) ? $gallery->slug : '') }}</span>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', isset($gallery) ? $gallery->slug : '') }}">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name EN -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($gallery) ? $gallery->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name NP -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($gallery) ? $gallery->name_np : null)" fieldName="name_np" :required=false />

    <!-- type -->
    <x-fields.select-enum-field label="Type" :data="isset($gallery) ? $gallery->type : ''" fieldName="type" :required=true :loopValue="$types"
        useEnum="GalleryTypeEnum" />

    <!-- Cover Image -->
    <x-fields.image-upload-field label="Cover Image" :data="old('cover_image', isset($gallery) ? $gallery->cover_image : null)" fieldName="cover_image"
        currentName="current_cover_image" :required=true />

    <!-- Images -->
    <x-fields.multi-file-upload-field label="Images" :data="old(
        'images',
        isset($gallery) && $gallery->type == GalleryTypeEnum::IMAGE->value
            ? (isset($gallery->value) && count(json_decode($gallery->value)) > 0
                ? $gallery->value
                : null)
            : null,
    )" fieldName="images" currentName="current_images"
        :required=true accept="image/*" class="imageTypeSection hidden" routeName="gallery" />

    <!-- Video Link -->
    <x-fields.text-field class="col-span-3 videoTypeSection hidden" label="Video Link" :data="old(
        'video_link',
        isset($gallery) && $gallery->type == GalleryTypeEnum::VIDEO->value ? $gallery->value : null,
    )"
        fieldName="video_link" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($gallery) ? $gallery->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($gallery) ? $gallery->is_published : 1)" fieldName="is_published" :required=false />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($gallery) ? $gallery->is_featured : 0)" fieldName="is_featured" :required=false />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            checkType();
            checkFieldActivity();
        });

        $(document).on('input', '#name_en', function() {
            let nameEnValue = $(this).val();
            let slug = generateSlug(nameEnValue);
            $('input[name=slug]').val(slug);
            $('#slug').text(slug);
        });

        $('#type').change(function(e) {
            e.preventDefault();

            checkType();
        });

        $('input[name="is_field_activities"]').on('change', function() {
            checkFieldActivity();
        });

        $('.image').on('change', function() {
            fieldId = $(this).attr('id');

            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                // $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });

        function checkType() {
            type = $('#type').val();

            if (type == @json(GalleryTypeEnum::IMAGE->value)) {
                $('.imageTypeSection').removeClass('hidden');
                $('.videoTypeSection').addClass('hidden');

                $('#cover_image, #images').val(null);
            } else {
                $('.imageTypeSection').addClass('hidden');
                $('.videoTypeSection').removeClass('hidden');

                $('#cover_image, #images').val(null);
            }
        }

        function checkFieldActivity() {
            activity = $('input[name="is_field_activities"]:checked').val();

            if (activity == 1) {
                $('.fieldActivitySection').removeClass('hidden');
            } else {
                $('.fieldActivitySection').addClass('hidden');
                $('#district').val('').trigger('change');
            }
        }

        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    </script>
@endpush
