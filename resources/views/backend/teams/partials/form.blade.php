<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Type -->
    <x-fields.select-enum-field label="Type" :data="isset($team) ? $team->type : ''" fieldName="type" :required=true :loopValue="$types"
        useEnum="TeamEnum" />

    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($team) ? $team->name_en : null)" fieldName="name_en" :required=true />


    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($team) ? $team->name_np : null)" fieldName="name_np" :required=false />

    <!-- Phone Number -->
    <x-fields.tel-field label="Phone Number" :data="old('phone_number', isset($team) ? $team->phone_number : null)" fieldName="phone_number" :required=false />

    <!-- Email -->
    <x-fields.email-field label="Email" :data="old('email', isset($team) ? $team->email : null)" fieldName="email" :required=false />


    <!-- Select Description -->
    <x-fields.select-field label="Department" :data="isset($team) ? $team->department_id : ''" fieldName="department_id" :required=true
        :loopValue="$departments" />

    <!-- Select Designation -->
    <x-fields.select-field label="Designation" :data="isset($team) ? $team->designation_id : ''" fieldName="designation_id" :required=true
        :loopValue="$designations" />

    <!-- Image -->
    <x-fields.image-upload-field label="Image" :data="old('image', isset($team) ? $team->image : null)" fieldName="image" currentName="current_image"
        :required=true />


    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($team) ? $team->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($team) ? $team->is_published : 1)" fieldName="is_published" :required=false />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($team) ? $team->is_featured : 1)" fieldName="is_featured" :required=false />



    <x-fields.url-field class="col-span-3 hidden" id="externalLinkSpace" label="External Link" :data="old('external_link', isset($team) ? $team->external_link : null)"
        fieldName="external_link" :required=false />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">

    <!-- facebook -->
    <x-fields.text-field label="Facebook" :data="old('facebook', isset($team) ? $team->facebook : null)" fieldName="facebook" :required=false />

    <!-- linked_in -->
    <x-fields.text-field label="Linkedin" :data="old('linked_in', isset($team) ? $team->linked_in : null)" fieldName="linked_in" :required=false />

    <!-- description en -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($team) ? $team->description_en : null)" fieldName="description_en"
        :required=true />

    <!-- description np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($team) ? $team->description_np : null)" fieldName="description_np"
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
    </script>
@endpush
