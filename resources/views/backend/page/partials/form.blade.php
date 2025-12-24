<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name EN -->
    <x-fields.text-field label="Title (English)" :data="old('title_en', isset($page) ? $page->title_en : null)" fieldName="title_en" :required=true />

    <!-- Name NP -->
    <x-fields.text-field label="Title (Nepali)" :data="old('title_np', isset($page) ? $page->title_np : null)" fieldName="title_np" :required=false />

    @if (isset($page) && $page->id == 1)
    @else
        <!-- menu -->
        <x-fields.select-field label="Menu" :data="isset($page) ? $page->menu_id : ''" fieldName="menu_id" :required=true :loopValue="$menus" />
    @endif

    <!-- Banner Image -->
    <x-fields.image-upload-field label="Banner Image" :data="old('banner_image', isset($page) ? $page->banner_image : null)" fieldName="banner_image"
        currentName="current_banner_image" :required=true />

    <!-- short description EN -->
    <x-fields.text-field class="col-span-3" label="Short Description (English)" :data="old('short_description_en', isset($page) ? $page->short_description_en : null)"
        fieldName="short_description_en" :required=true />

    <!-- short description NP -->
    <x-fields.text-field class="col-span-3" label="Short Description (Nepali)" :data="old('short_description_np', isset($page) ? $page->short_description_np : null)"
        fieldName="short_description_np" :required=false />

    <!-- Description En -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($page) ? $page->description_en : null)" fieldName="description_en"
        :required=true class="col-span-3" />

    <!-- Description Np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($page) ? $page->description_np : null)" fieldName="description_np"
        :required=false class="col-span-3" />
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
