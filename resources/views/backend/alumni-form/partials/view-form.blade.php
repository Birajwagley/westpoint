<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Full Name -->
    <div class="flex flex-col gap-1">
        <label for="full_name" class="text-sm  font-semibold text-black">
            Full Name</label>

        <p id="full_name" class="text-gray-800">
            {{ $alumniForm->full_name ?? '' }}
        </p>
    </div>

    {{-- image --}}
    <div class="flex flex-col gap-1">
        <label for="image" class="text-sm  font-semibold text-black">
            Image</label>

        <a href="{{ asset($alumniForm->testimonial->image) }}" target="_blank">
            <div
                class="w-24 h-24 rounded-xl overflow-hidden shadow-md ring-1 ring-gray-300 hover:ring-blue-400 transition-all duration-300">
                <img src="{{ asset($alumniForm->testimonial->image) }}" alt="Image"
                    class="w-full h-full object-cover">
            </div>
        </a>
    </div>

    <!-- Email -->
    <div class="flex flex-col gap-1">
        <label for="email" class="text-sm  font-semibold text-black">
            Email</label>

        <p id="email" class="text-gray-800">
            {{ $alumniForm->email ?? '' }}
        </p>
    </div>

    <!-- Mobile Number -->
    <div class="flex flex-col gap-1">
        <label for="mobile_number" class="text-sm  font-semibold text-black">
            Mobile Number</label>

        <p id="mobile_number" class="text-gray-800">
            {{ $alumniForm->mobile_number ?? '' }}
        </p>
    </div>

    <!-- Occupation -->
    <div class="flex flex-col gap-1">
        <label for="occupation" class="text-sm  font-semibold text-black">
            Occupation</label>

        <p id="occupation" class="text-gray-800">
            {{ $alumniForm->occupation ?? '' }}
        </p>
    </div>

    {{-- company logo --}}
    <div class="flex flex-col gap-1">
        <label for="company_logo" class="text-sm  font-semibold text-black">
            Company Logo</label>

        <a href="{{ asset($alumniForm->company_logo) }}" target="_blank">
            <div
                class="w-24 h-24 rounded-xl overflow-hidden shadow-md ring-1 ring-gray-300 hover:ring-blue-400 transition-all duration-300">
                <img src="{{ asset($alumniForm->company_logo) }}" alt="Company Logo" class="w-full h-full object-cover">
            </div>
        </a>
    </div>

    <!-- Designation -->
    <div class="flex flex-col gap-1">
        <label for="designation" class="text-sm  font-semibold text-black">
            Designation</label>

        <p id="designation" class="text-gray-800">
            {{ $alumniForm->designation ?? '' }}
        </p>
    </div>

    <!-- Batch -->
    <div class="flex flex-col gap-1">
        <label for="batch" class="text-sm  font-semibold text-black">
            Batch</label>

        <p id="batch" class="text-gray-800">
            {{ $alumniForm->batch ?? '' }}
        </p>
    </div>

    <!-- Country -->
    <div class="flex flex-col gap-1">
        <label for="country" class="text-sm  font-semibold text-black">
            Country</label>

        <p id="country" class="text-gray-800">
            {{ countries()[$alumniForm->country]['name'] ?? '' }}
        </p>
    </div>
</div>

<div class="grid grid-cols-1 gap-4 mt-2">
    <!-- Testimonial -->
    <div class="flex flex-col gap-1">
        <label for="testimonial" class="text-sm  font-semibold text-black">
            Testimonial</label>

        <p id="testimonial" class="text-gray-800">
            {!! $alumniForm->testimonial->testimonial_text ?? '' !!}
        </p>
    </div>
    <hr>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- section type -->
        <x-fields.select-enum-field label="Section Type" :data="isset($alumniForm) ? $alumniForm->section_type : ''" fieldName="section_type" :required=true
            :loopValue="$sectionType" useEnum="AlumniSectionTypeEnum" />

        <!-- Is Published -->
        <x-fields.boolean-field label="Is Published?" :data="$alumniForm->is_published" fieldName="is_published" :required="false" />

        {{-- video url --}}
        <x-fields.url-field class="col-span-1 md:col-span-2 lg:col-span-3" label="Testimonial (Video Url)"
            :data="old(
                'testimonial_video',
                isset($alumniForm) ? $alumniForm->testimonial->testimonial_video : null,
            )" fieldName="testimonial_video" :required=false />
    </div>
</div>


@push('scripts')
    <script>
        // Hide/show Other Gender dynamically
        function toggleOtherGender() {
            var genderSelect = document.getElementById('gender');
            var otherGenderField = document.getElementById('otherGenderField');
            if (!genderSelect) return;
            if (genderSelect.value === 'others') {
                otherGenderField.style.display = 'block';
            } else {
                otherGenderField.style.display = 'none';
            }
        }

        window.onload = function() {
            toggleOtherGender();
            var genderSelect = document.getElementById('gender');
            if (genderSelect) genderSelect.addEventListener('change', toggleOtherGender);
        };
    </script>
@endpush
