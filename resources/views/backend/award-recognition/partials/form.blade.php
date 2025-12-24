@php
    use App\Enum\AwardTypeEnum;
    use App\Enum\AwardAchivementTypeEnum;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- type -->
    <x-fields.select-enum-field label="Type" :data="isset($awardRecognition) ? $awardRecognition->type : ''" fieldName="type" :required=true :loopValue="$types"
        useEnum="AwardAchivementTypeEnum" />

    <!-- award type -->
    <x-fields.select-enum-field class="award hidden" label="Award Type" :data="isset($awardRecognition) ? $awardRecognition->award_type : ''" fieldName="award_type"
        :required=true :loopValue="$awardTypes" useEnum="AwardTypeEnum" />

    <!-- Name En -->
    <x-fields.text-field label="Title (English)" :data="old('title_en', isset($awardRecognition) ? $awardRecognition->title_en : null)" fieldName="title_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Title (Nepali)" :data="old('title_np', isset($awardRecognition) ? $awardRecognition->title_np : null)" fieldName="title_np" :required=false />

    <!-- Image -->
    <x-fields.image-upload-field class="achivement hidden" label="Image" :data="old('image', isset($awardRecognition) ? $awardRecognition->image : null)" fieldName="image"
        currentName="current_image" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($awardRecognition) ? $awardRecognition->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- short description En -->
    <x-fields.text-field class="md:col-span-2 lg:col-span-3" label="Short Description (English)" :data="old('short_description_en', isset($awardRecognition) ? $awardRecognition->short_description_en : null)"
        fieldName="short_description_en" :required=true />

    <!-- short description Np -->
    <x-fields.text-field class="md:col-span-2 lg:col-span-3" label="Short Description (Nepali)" :data="old('short_description_np', isset($awardRecognition) ? $awardRecognition->short_description_np : null)"
        fieldName="short_description_np" :required=false />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($awardRecognition) ? $awardRecognition->is_featured : 0)" fieldName="is_featured" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($awardRecognition) ? $awardRecognition->is_published : 1)" fieldName="is_published" :required=true />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            type = $('#type').val();
            typeChange(type);
        });

        $(document).on('change', '#type', function() {
            type = $(this).val();

            typeChange(type);
        });

        $('.image').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });

        function typeChange(type) {
            if (type != '') {
                if (type == 'award') {
                    $('.award').removeClass('hidden');
                    $('.achivement').addClass('hidden');
                } else {
                    $('.award').addClass('hidden');
                    $('.achivement').removeClass('hidden');
                }
            }

            $('#award_type').val(null).trigger('change');
            $('#image').val(null);
        }
    </script>
@endpush
