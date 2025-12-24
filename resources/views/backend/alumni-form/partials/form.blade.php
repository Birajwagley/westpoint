@php
    use App\Enum\AlumniSectionTypeEnum;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Full Name -->
    <x-fields.text-field label="Full Name" :data="old('full_name', isset($alumniForm) ? $alumniForm->full_name : null)" fieldName="full_name" :required=true />

    <!-- Image -->
    <x-fields.image-upload-field label="Image" :data="old('image')" fieldName="image" currentName="current_image"
        :required=true />

    <!-- Email -->
    <x-fields.email-field label="Email" :data="old('email', isset($alumniForm) ? $alumniForm->email : null)" fieldName="email" :required=true />

    <!-- Mobile Number -->
    <x-fields.tel-field label="Mobile Number" :data="old('mobile_number', isset($alumniForm) ? $alumniForm->mobile_number : null)" fieldName="mobile_number" :required=true />

    <!-- Occupation -->
    <x-fields.text-field label="Occupation" :data="old('occupation', isset($alumniForm) ? $alumniForm->occupation : null)" fieldName="occupation" :required=true />

    <!-- Company Logo -->
    <x-fields.image-upload-field label="Company Logo" :data="old('company_logo', isset($user) ? $user->company_logo : null)" fieldName="company_logo"
        currentName="current_company_logo" :required=true />

    <!-- Designation -->
    <x-fields.text-field label="Designation" :data="old('designation', isset($alumniForm) ? $alumniForm->designation : null)" fieldName="designation" :required=true />

    <!-- Batch -->
    <x-fields.integer-field label="Batch" :data="old('batch', isset($alumniForm) ? $alumniForm->batch : null)" fieldName="batch" :required=true />

    {{-- countries --}}
    <div>
        <label for="country" class="block text-sm font-semibold text-gray-700">Country
            <span class="text-red-600">*</span>
        </label>

        <select name="country" id="country"
            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-white focus:ring-primary focus:border-primary @error('country') border-red-500 @enderror select">
            <option value="">Select Country</option>
            @foreach ($countries as $code => $country)
                <option value="{{ $code }}"
                    {{ old('country', isset($alumniForm) && $alumniForm->country == $code ? 'selected' : '') }}>
                    {{ $country['emoji'] }}&nbsp;{{ $country['name'] }}
                </option>
            @endforeach
        </select>

        @error('country')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- section type -->
    <x-fields.select-enum-field label="Section Type" :data="isset($alumniForm) ? $alumniForm->section_type : ''" fieldName="section_type" :required=true
        :loopValue="$sectionType" useEnum="AlumniSectionTypeEnum" />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($alumniForm) ? $alumniForm->is_published : 0)" fieldName="is_published" :required=false />
</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    {{-- video url --}}
    <x-fields.url-field label="Testimonial (Video Url)" :data="old('testimonial_video', isset($club) ? $club->testimonial_video : null)" fieldName="testimonial_video"
        :required=false />

    <!-- Testimonial -->
    <x-fields.textarea-summernote-field label="Testimonial" :data="old('testimonial_text', isset($alumniForm) ? $alumniForm->testimonial_text : null)" fieldName="testimonial_text"
        :required=true />
</div>

@push('scripts')
    <script>
        $('#image').on('change', function() {
            fieldId = $(this).attr('id');

            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden');
                $('#current_' + fieldId + '_value').val(null);
            }
        });

        $('#company_logo').on('change', function() {
            fieldId = $(this).attr('id');

            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden');
                $('#current_' + fieldId + '_value').val(null);
            }
        });
    </script>
@endpush
