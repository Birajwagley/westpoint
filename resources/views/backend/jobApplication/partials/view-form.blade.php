    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Career -->
        <div class="flex flex-col gap-1">
            <label for="career" class="text-sm  font-semibold text-black">
                Career <span class="text-red-600">*</span></label>

            <p id="career" class="text-gray-800">
                {{ strip_tags($jobApplication->career->name) }}
            </p>
        </div>

        <!-- Full Name -->
        <div class="flex flex-col gap-1">
            <label for="full_name" class="text-sm  font-semibold text-black">
                Full Name <span class="text-red-600">*</span></label>

            <p id="full_name" class="text-gray-800">
                {{ $jobApplication->full_name ?? '' }}
            </p>
        </div>

        <!-- Gender -->

        <div class="flex flex-col gap-1">
            <label for="gender" class="text-sm  font-semibold text-black">
                Gender <span class="text-red-600">*</span></label>

            <p id="gender" class="text-gray-800">
                {{ $jobApplication->gender ?? '' }}
            </p>
        </div>

        <!-- Other Gender -->
        <div id="otherGenderField" class="flex flex-col gap-1" style="display: none;">
            <label for="other_gender" class="text-sm font-semibold text-black">
                Other Gender <span class="text-red-600">*</span>
            </label>

            <p id="other_gender" class="text-gray-800">
                {{ $jobApplication->other_gender ?? '' }}
            </p>
        </div>

        <!-- Date of Birth (AD) -->

        <div class="flex flex-col gap-1">
            <label for="date_of_birth_ad" class="text-sm  font-semibold text-black">
                Date of Birth (AD) <span class="text-red-600">*</span></label>

            <p id="date_of_birth_ad" class="text-gray-800">
                {{ $jobApplication->date_of_birth_ad ?? '' }}
            </p>
        </div>

        <!-- Date of Birth (BS) -->
        <div class="flex flex-col gap-1">
            <label for="date_of_birth_bs" class="text-sm  font-semibold text-black">
                Date of Birth (BS) <span class="text-red-600">*</span></label>

            <p id="date_of_birth_bs" class="text-gray-800">
                {{ $jobApplication->date_of_birth_bs ?? '' }}
            </p>
        </div>

        <!-- Age -->
        <div class="flex flex-col gap-1">
            <label for="age" class="text-sm  font-semibold text-black">
                Age <span class="text-red-600">*</span></label>

            <p id="age" class="text-gray-800">
                {{ $jobApplication->age ?? '' }}
            </p>
        </div>

        <!-- Current Address -->
        <div class="flex flex-col gap-1">
            <label for="current_address" class="text-sm  font-semibold text-black">
                Current Address <span class="text-red-600">*</span></label>

            <p id="current_address" class="text-gray-800">
                {{ $jobApplication->current_address ?? '' }}
            </p>
        </div>

        <!-- Mobile Number -->
        <div class="flex flex-col gap-1">
            <label for="mobile_number" class="text-sm  font-semibold text-black">
                Mobile Number <span class="text-red-600">*</span></label>

            <p id="mobile_number" class="text-gray-800">
                {{ $jobApplication->mobile_number ?? '' }}
            </p>
        </div>

        <!-- Email -->

        <div class="flex flex-col gap-1">
            <label for="email" class="text-sm  font-semibold text-black">
                Email <span class="text-red-600">*</span></label>

            <p id="email" class="text-gray-800">
                {{ $jobApplication->email ?? '' }}
            </p>
        </div>

        <!-- Phone Number -->

        <div class="flex flex-col gap-1">
            <label for="phone_no" class="text-sm  font-semibold text-black">
                Phone Number <span class="text-red-600">*</span></label>

            <p id="phone_no" class="text-gray-800">
                {{ $jobApplication->phone_no ?? '' }}
            </p>
        </div>

        <!-- Highest Education Qualification -->
        <div class="flex flex-col gap-1">
            <label for="highest_education_qualification" class="text-sm  font-semibold text-black">
                Highest Education Qualification <span class="text-red-600">*</span></label>

            <p id="highest_education_qualification" class="text-gray-800">
                {{ $jobApplication->highest_education_qualification ?? '' }}
            </p>
        </div>

        <!-- CV -->
        <div class="flex flex-col gap-1">
            <label for="cv" class="text-sm  font-semibold text-black">
                CV <span class="text-red-600">*</span></label>

            <p class="text-gray-800">
                @if ($jobApplication->cv)
                    <a href="{{ asset($jobApplication->cv) }}" target="_blank">
                        <i class="fa-solid fa-file fa-2x"></i>
                    </a>
                @else
                    <span class="text-gray-500">No CV uploaded</span>
                @endif
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 gap-4 mt-2">
        <!-- Cover Letter -->
        <div class="flex flex-col gap-1">
            <label for="cover_letter" class="text-sm  font-semibold text-black">
                Cover Letter <span class="text-red-600">*</span></label>

            <p id="cover_letter" class="text-gray-800">
                {{ strip_tags($jobApplication->cover_letter) ?? '' }}
            </p>
        </div>
        <hr>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Is Scanned -->
            <x-fields.boolean-field label="Is Scanned?" :data="$jobApplication->is_scanned" fieldName="is_scanned" :required="false" />

            <!-- Is Shortlisted -->
            <x-fields.boolean-field label="Is Shortlisted?" :data="$jobApplication->is_shortlisted" fieldName="is_shortlisted"
                :required="false" />
        </div>

        <!-- Remarks -->
        <x-fields.textarea-field label="Remarks" :data="$jobApplication->remarks" fieldName="remarks" :required="true" />
    </div>


    @push('scripts')
        <script>
            window.onload = function() {
                var genderText = document.getElementById('gender').innerText.trim().toLowerCase();
                var otherGenderField = document.getElementById('otherGenderField');

                if (genderText === 'other' || genderText === 'others') {
                    otherGenderField.style.display = 'block';
                } else {
                    otherGenderField.style.display = 'none';
                }
            };
        </script>
    @endpush
