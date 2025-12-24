    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- Full Name -->

        <div class="flex flex-col gap-1">
            <label for="full_name" class="text-sm  font-semibold text-black">
                Full Name<span class="text-red-600">*</span></label>

            <p id="full_name" class="text-gray-800">
                {{ $volunteerForm->full_name ?? '' }}
            </p>
        </div>
        <!-- Date of Birth (AD) -->

        <div class="flex flex-col gap-1">
            <label for="date_of_birth_ad" class="text-sm  font-semibold text-black">
                Date of Birth (AD) <span class="text-red-600">*</span></label>

            <p id="date_of_birth_ad" class="text-gray-800">
                {{ $volunteerForm->date_of_birth_ad ?? '' }}
            </p>
        </div>

        <!-- Date of Birth (BS) -->
        <div class="flex flex-col gap-1">
            <label for="date_of_birth_bs" class="text-sm  font-semibold text-black">
                Date of Birth (BS) <span class="text-red-600">*</span></label>

            <p id="date_of_birth_bs" class="text-gray-800">
                {{ $volunteerForm->date_of_birth_bs ?? '' }}
            </p>
        </div>

        <!-- Age -->

        <div class="flex flex-col gap-1">
            <label for="age" class="text-sm  font-semibold text-black">
                Age <span class="text-red-600">*</span></label>

            <p id="age" class="text-gray-800">
                {{ $volunteerForm->age ?? '' }}
            </p>
        </div>

        <!-- Gender -->

        <div class="flex flex-col gap-1">
            <label for="gender" class="text-sm  font-semibold text-black">
                Gender <span class="text-red-600">*</span></label>

            <p id="gender" class="text-gray-800">
                {{ $volunteerForm->gender ?? '' }}
            </p>
        </div>


        <!-- Other Gender -->

        <div id="otherGenderField" class="flex flex-col gap-1" style="display: none;">
            <label for="other_gender" class="text-sm font-semibold text-black">
                Other Gender <span class="text-red-600">*</span>
            </label>

            <p id="other_gender" class="text-gray-800">
                {{ $volunteerForm->other_gender ?? '' }}
            </p>
        </div>

        <!-- Nationality -->

        <div class="flex flex-col gap-1">
            <label for="nationality" class="text-sm  font-semibold text-black">
                Nationality <span class="text-red-600">*</span></label>

            <p id="nationality" class="text-gray-800">
                {{ $volunteerForm->nationality ?? '' }}
            </p>
        </div>

        <!-- Passport Number -->

        <div class="flex flex-col gap-1">
            <label for="passport_number" class="text-sm  font-semibold text-black">
                Passport Number <span class="text-red-600">*</span></label>

            <p id="passport_number" class="text-gray-800">
                {{ $volunteerForm->passport_number ?? '' }}
            </p>
        </div>

        <!-- Email -->

        <div class="flex flex-col gap-1">
            <label for="email" class="text-sm  font-semibold text-black">
                Email <span class="text-red-600">*</span></label>

            <p id="email" class="text-gray-800">
                {{ $volunteerForm->email ?? '' }}
            </p>
        </div>

        <!-- Contact Number -->
        <div class="flex flex-col gap-1">
            <label for="contact_no" class="text-sm  font-semibold text-black">
                Contact Number <span class="text-red-600">*</span></label>

            <p id="contact_no" class="text-gray-800">
                {{ $volunteerForm->contact_no ?? '' }}
            </p>
        </div>

        <!-- Current Address -->

        <div class="flex flex-col gap-1">
            <label for="current_address" class="text-sm  font-semibold text-black">
                Current Address <span class="text-red-600">*</span></label>

            <p id="current_address" class="text-gray-800">
                {{ $volunteerForm->current_address ?? '' }}
            </p>
        </div>

        <!-- Emergency Full Name -->
        <div class="flex flex-col gap-1">
            <label for="emergency_full_name" class="text-sm  font-semibold text-black">
                Emergency Full Name <span class="text-red-600">*</span></label>

            <p id="emergency_full_name" class="text-gray-800">
                {{ $volunteerForm->emergency_full_name ?? '' }}
            </p>
        </div>


        <!-- Emergency Relationship -->

        <div class="flex flex-col gap-1">
            <label for="emergency_relationship" class="text-sm  font-semibold text-black">
                Emergency Relationship <span class="text-red-600">*</span></label>

            <p id="emergency_relationship" class="text-gray-800">
                {{ $volunteerForm->emergency_relationship ?? '' }}
            </p>
        </div>

        <!-- Emergency Contact Number -->

        <div class="flex flex-col gap-1">
            <label for="emergency_contact_number" class="text-sm  font-semibold text-black">
                Emergency Contact Number <span class="text-red-600">*</span></label>

            <p id="emergency_contact_number" class="text-gray-800">
                {{ $volunteerForm->emergency_contact_number ?? '' }}
            </p>
        </div>

        <!-- Emergency Email -->

        <div class="flex flex-col gap-1">
            <label for="emergency_email" class="text-sm  font-semibold text-black">
                Emergency Email <span class="text-red-600">*</span></label>

            <p id="emergency_email" class="text-gray-800">
                {{ $volunteerForm->emergency_email ?? '' }}
            </p>
        </div>

        <!-- Area of Interest -->

        <div class="flex flex-col gap-1">
            <label for="area_of_interest" class="text-sm  font-semibold text-black">
                Area of Interest <span class="text-red-600">*</span></label>

            <p id="area_of_interest" class="text-gray-800">
                {{ strip_tags($volunteerForm->area_of_interest ?? '') }}
            </p>
        </div>

        <!-- Skill Expertise -->

        <div class="flex flex-col gap-1">
            <label for="skill_experties" class="text-sm  font-semibold text-black">
                Skill Expertise <span class="text-red-600">*</span></label>

            <p id="skill_experties" class="text-gray-800">
                {{ strip_tags($volunteerForm->skill_experties ?? '') }}
            </p>
        </div>

        <!-- Motivation -->

        <div class="flex flex-col gap-1">
            <label for="motivation" class="text-sm  font-semibold text-black">
                Motivation <span class="text-red-600">*</span></label>

            <p id="motivation" class="text-gray-800">
                {{ strip_tags($volunteerForm->motivation ?? '') }}
            </p>
        </div>

        <!--Previous Volunteer Experience -->
        <div class="flex flex-col gap-1">
            <label for="previous_volunteer_experience" class="text-sm  font-semibold text-black">
                Previous Volunteer Experience <span class="text-red-600">*</span></label>

            <p id="previous_volunteer_experience" class="text-gray-800">
                {{ strip_tags($volunteerForm->previous_volunteer_experience ?? '') }}
            </p>
        </div>

        <!-- Start Date -->

        <div class="flex flex-col gap-1">
            <label for="start_date" class="text-sm  font-semibold text-black">
                Start Date <span class="text-red-600">*</span></label>

            <p id="start_date" class="text-gray-800">
                {{ $volunteerForm->start_date ?? '' }}
            </p>
        </div>

        <!-- End Date -->

        <div class="flex flex-col gap-1">
            <label for="end_date" class="text-sm  font-semibold text-black">
                End Date <span class="text-red-600">*</span></label>

            <p id="end_date" class="text-gray-800">
                {{ $volunteerForm->end_date ?? '' }}
            </p>
        </div>

        <!-- Daily Availablity -->
        <div class="flex flex-col gap-1">
            <label for="daily_availability" class="text-sm  font-semibold text-black">
                Daily Availablity <span class="text-red-600">*</span></label>

            <p id="daily_availability" class="text-gray-800">
                {{ $volunteerForm->daily_availability ?? '' }}
            </p>
        </div>

        <!-- Insurance Proof -->

        <div class="flex flex-col gap-1">
            <label for="insurance_proof" class="text-sm  font-semibold text-black">
                Insurance Proof <span class="text-red-600">*</span></label>

            <p class="text-gray-800">
                @if ($volunteerForm->insurance_proof)
                    <a href="{{ asset($volunteerForm->insurance_proof) }}" target="_blank">
                        <i class="fa-solid fa-file fa-2x"></i>
                    </a>
                @else
                    <span class="text-gray-500">No Insurance Proof uploaded</span>
                @endif
            </p>
        </div>

        <!-- CV -->
        <div class="flex flex-col gap-1">
            <label for="cv" class="text-sm  font-semibold text-black">
                CV <span class="text-red-600">*</span></label>

            <p class="text-gray-800">
                @if ($volunteerForm->cv)
                    <a href="{{ asset($volunteerForm->cv) }}" target="_blank">
                        <i class="fa-solid fa-file fa-2x"></i>
                    </a>
                @else
                    <span class="text-gray-500">No CV uploaded</span>
                @endif
            </p>
        </div>

        <!-- Passport Copy -->

        <div class="flex flex-col gap-1">
            <label for="passport_copy" class="text-sm font-semibold text-black">
                Passport Copy <span class="text-red-600">*</span>
            </label>

            <div class="text-gray-800">
                @if ($volunteerForm->passport_copy)
                    <a href="{{ asset($volunteerForm->passport_copy) }}" target="_blank">
                        <img src="{{ asset($volunteerForm->passport_copy) }}" alt="Passport Copy"
                            class="w-32 h-32 object-cover border rounded-lg hover:opacity-90 transition">
                    </a>
                @else
                    <span class="text-gray-500">No passport copy uploaded</span>
                @endif
            </div>
        </div>

        <!-- Visa Copy -->

        <div class="flex flex-col gap-1">
            <label for="visa_copy" class="text-sm font-semibold text-black">
                Visa Copy <span class="text-red-600">*</span>
            </label>

            <div class="text-gray-800">
                @if ($volunteerForm->visa_copy)
                    <a href="{{ asset($volunteerForm->visa_copy) }}" target="_blank">
                        <img src="{{ asset($volunteerForm->visa_copy) }}" alt="Passport Copy"
                            class="w-32 h-32 object-cover border rounded-lg hover:opacity-90 transition">
                    </a>
                @else
                    <span class="text-gray-500">No visa copy uploaded</span>
                @endif
            </div>
        </div>

        <!-- Digital Signature -->

        <div class="flex flex-col gap-1">
            <label for="digital_signature" class="text-sm font-semibold text-black">
                Digital Signature <span class="text-red-600">*</span>
            </label>

            <div class="text-gray-800">
                @if ($volunteerForm->digital_signature)
                    <a href="{{ asset($volunteerForm->digital_signature) }}" target="_blank">
                        <img src="{{ asset($volunteerForm->digital_signature) }}" alt="Passport Copy"
                            class="w-32 h-32 object-cover border rounded-lg hover:opacity-90 transition">
                    </a>
                @else
                    <span class="text-gray-500">No digital signature uploaded</span>
                @endif
            </div>
        </div>

        <!-- Accomendation Required -->

        <div class="flex flex-col gap-1">
            <label for="accomodation_required" class="text-sm font-semibold text-black">
                Accommodation Required <span class="text-red-600">*</span>
            </label>

            <p id="accomodation_required" class="text-gray-800">
                {{ $volunteerForm->accomodation_required == 1 ? 'Yes' : 'No' }}
            </p>
        </div>

        <!-- Travel Insurance -->

        <div class="flex flex-col gap-1">
            <label for="travel_insurance" class="text-sm font-semibold text-black">
                Travel Insurance <span class="text-red-600">*</span>
            </label>

            <p id="travel_insurance" class="text-gray-800">
                {{ $volunteerForm->travel_insurance == 1 ? 'Yes' : 'No' }}
            </p>
        </div>

        <!-- Criminal Record -->

        <div class="flex flex-col gap-1">
            <label for="criminal_record" class="text-sm font-semibold text-black">
                Criminal Record <span class="text-red-600">*</span>
            </label>

            <p id="criminal_record" class="text-gray-800">
                {{ $volunteerForm->criminal_record == 1 ? 'Yes' : 'No' }}
            </p>
        </div>

        <!-- Aggrement -->

        <div class="flex flex-col gap-1">
            <label for="aggrement" class="text-sm font-semibold text-black">
                Aggrement <span class="text-red-600">*</span>
            </label>

            <p id="aggrement" class="text-gray-800">
                {{ $volunteerForm->aggrement == 1 ? 'Yes' : 'No' }}
            </p>
        </div>

        <!-- Medical Condition -->

        <div class="flex flex-col gap-1">
            <label for="medical_condition" class="text-sm font-semibold text-black">
                Medical Condition <span class="text-red-600">*</span>
            </label>

            <p id="medical_condition" class="text-gray-800">
                {{ $volunteerForm->medical_condition == 1 ? 'Yes' : 'No' }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 mt-2">
        <!-- Medical Description -->

        @if ($volunteerForm->medical_condition == 1)
            <div class="flex flex-col gap-1 mt-2">
                <label for="medical_description" class="text-sm font-semibold text-black">
                    Medical Description <span class="text-red-600">*</span>
                </label>

                <p id="medical_description" class="text-gray-800">
                    {{ $volunteerForm->medical_description ?? '' }}
                </p>
            </div>
        @endif
        <!-- Dietary Restriction -->

        <div class="flex flex-col gap-1">
            <label for="dietary_restriction" class="text-sm  font-semibold text-black">
                Dietary Restriction <span class="text-red-600">*</span></label>

            <p id="dietary_restriction" class="text-gray-800">
                {{ $volunteerForm->dietary_restriction ?? '' }}
            </p>
        </div>
        <hr>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Is Scanned -->
            <x-fields.boolean-field label="Is Scanned?" :data="$volunteerForm->is_scanned" fieldName="is_scanned" :required="false" />

            <!-- Is Shortlisted -->
            <x-fields.boolean-field label="Is Shortlisted?" :data="$volunteerForm->is_shortlisted" fieldName="is_shortlisted"
                :required="false" />
        </div>

        <!-- Remarks -->
        <x-fields.textarea-field label="Remarks" :data="$volunteerForm->remarks" fieldName="remarks" :required="true" />
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
