<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Images -->
    <x-fields.multi-file-upload-field label="Images" :data="old('images', isset($volunteer) ?  (isset($volunteer->images) && count(json_decode($volunteer->images)) > 0 ? $volunteer->images : null) : null)" fieldName="images" currentName="current_images"
        :required=true accept="image/*" routeName="volunteer" />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- Qualification En -->
    <x-fields.textarea-summernote-field label="Qualification En" :data="old('qualification_en', isset($volunteer) ? $volunteer->qualification_en : null)" fieldName="qualification_en"
        :required=true />

    <!-- Qualification Np -->
    <x-fields.textarea-summernote-field label="Qualification Np" :data="old('qualification_np', isset($volunteer) ? $volunteer->qualification_np : null)" fieldName="qualification_np"
        :required=false />

    <!-- Need of Volunteer En -->
    <x-fields.textarea-summernote-field label="Need of Volunteer En" :data="old('need_of_volunteer_en', isset($volunteer) ? $volunteer->need_of_volunteer_en : null)" fieldName="need_of_volunteer_en"
        :required=true />

    <!-- Need of Volunteer Np -->
    <x-fields.textarea-summernote-field label="Need of Volunteer Np" :data="old('need_of_volunteer_np', isset($volunteer) ? $volunteer->need_of_volunteer_np : null)" fieldName="need_of_volunteer_np"
        :required=false />

    <!-- description en -->
    <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($volunteer) ? $volunteer->description_en : null)" fieldName="description_en"
        :required=true />

    <!-- description np -->
    <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($volunteer) ? $volunteer->description_np : null)" fieldName="description_np"
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
