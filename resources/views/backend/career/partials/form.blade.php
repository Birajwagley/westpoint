<!-- Slug Display -->
<div class="mb-4">
    <div class="inline-block bg-blue-50 border border-blue-500 rounded-lg px-4 py-2 shadow-sm">
        <span class="text-sm font-semibold text-gray-600">Slug:</span>
        <span id="slug"
            class="text-sm font-bold text-blue-600 ">{{ old('slug', isset($career) ? $career->slug : '') }}</span>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', isset($career) ? $career->slug : '') }}">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">


    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($career) ? $career->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($career) ? $career->name_np : null)" fieldName="name_np" :required=false />

    <!-- Select Designation -->
    <x-fields.select-field label="Designation" :data="isset($career) ? $career->designation_id : ''" fieldName="designation_id" :required=true
        :loopValue="$designations" />

    <!-- Number of Post -->
    <x-fields.integer-field label="Number of Post" :data="old('number_of_post', isset($career) ? $career->number_of_post : null)" fieldName="number_of_post" :required=true />

    {{-- timing --}}
    <x-fields.select-enum-field label="Timing" :data="isset($career) ? $career->timing : ''" fieldName="timing" :required=true :loopValue="$timings"
        useEnum="TimingTypeEnum" />

    <!-- Valid Date -->
    <x-fields.date-field label="Valid Date" :data="old('valid_date', isset($career) ? $career->valid_date : null)" fieldName="valid_date" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($career) ? $career->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($career) ? $career->is_published : 1)" fieldName="is_published" :required=false />

</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- requirement description en -->
    <x-fields.textarea-summernote-field label="Requirement (English)" :data="old('requirement_en', isset($career) ? $career->requirement_en : null)" fieldName="requirement_en"
        :required=true />

    <x-fields.textarea-summernote-field label="Requirement (Nepali)" :data="old('requirement_np', isset($career) ? $career->requirement_np : null)" fieldName="requirement_np"
        :required=false />
</div>



@push('scripts')
    <script>
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
