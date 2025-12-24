@if ($errors->any())
    <div id="error-box" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong>Whoops! Something went wrong:</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Full Name -->
    <x-fields.text-field label="Full Name" :data="old('full_name', isset($volunteerForm) ? $volunteerForm->full_name : null)" fieldName="full_name" :required=true />

    <!-- Date of Birth (AD) -->
    <x-fields.date-field label="Date of Birth (AD)" :data="old('date_of_birth_ad', isset($volunteerForm) ? $volunteerForm->date_of_birth_ad : null)" fieldName="date_of_birth_ad" :required=true />

    <!-- Date of Birth (BS) -->
    <x-fields.text-field label="Date of Birth (BS)" :data="old('date_of_birth_bs', isset($volunteerForm) ? $volunteerForm->date_of_birth_bs : null)" fieldName="date_of_birth_bs" :required=true />

    <!-- Age -->
    <x-fields.integer-field label="Age" :data="old('age', isset($volunteerForm) ? $volunteerForm->age : null)" fieldName="age" :required=true id="age"
        attribute="readonly" />

    <!-- Gender -->
    <x-fields.select-enum-field label="Gender" :data="isset($volunteerForm) ? $volunteerForm->gender : ''" fieldName="gender" :required=true :loopValue="$types"
        useEnum="GenderTypeEnum" />

    <!-- Other Gender -->
    <div id="otherGenderField"
        style="{{ old('gender', isset($volunteerForm) ? $volunteerForm->gender : '') == 'others' ? '' : 'display: none' }}">

        <x-fields.text-field label="Specify Gender" fieldName="other_gender" :data="old('other_gender', isset($volunteerForm) ? $volunteerForm->other_gender : null)" :required=false />
    </div>

    <!-- Nationality -->
    <x-fields.text-field label="Nationality" :data="old('nationality', isset($volunteerForm) ? $volunteerForm->nationality : null)" fieldName="nationality" :required=true />

    <!-- Passport Number -->
    <x-fields.tel-field label="Passport Number" :data="old('passport_number', isset($volunteerForm) ? $volunteerForm->passport_number : null)" fieldName="passport_number" :required=false />

    <!-- Email -->
    <x-fields.email-field label="Email" :data="old('email', isset($volunteerForm) ? $volunteerForm->email : null)" fieldName="email" :required=true />

    <!-- Contact Number -->
    <x-fields.tel-field label="Contact Number" :data="old('contact_no', isset($volunteerForm) ? $volunteerForm->contact_no : null)" fieldName="contact_no" :required=true />

    <!-- Current Address -->
    <x-fields.text-field label="Current Address" :data="old('current_address', isset($volunteerForm) ? $volunteerForm->current_address : null)" fieldName="current_address" :required=true />

    <!-- Emergency Full Name -->
    <x-fields.text-field label="Emergency Full Name" :data="old('emergency_full_name', isset($volunteerForm) ? $volunteerForm->emergency_full_name : null)" fieldName="emergency_full_name"
        :required=true />

    <!-- Emergency Relationship -->
    <x-fields.text-field label="Emergency Relationship" :data="old('emergency_relationship', isset($volunteerForm) ? $volunteerForm->emergency_relationship : null)" fieldName="emergency_relationship"
        :required=true />

    <!-- Emergency Contact Number -->
    <x-fields.tel-field label="Emergency Contact Number" :data="old('emergency_contact_number', isset($volunteerForm) ? $volunteerForm->emergency_contact_number : null)" fieldName="emergency_contact_number"
        :required=true />

    <!-- Emergency Email -->
    <x-fields.email-field label="Email" :data="old('emergency_email', isset($volunteerForm) ? $volunteerForm->emergency_email : null)" fieldName="emergency_email" :required=true />

    <!-- Area of Interest -->
    <x-fields.text-field label="Area of Interest" :data="old('area_of_interest', isset($volunteerForm) ? $volunteerForm->area_of_interest : null)" fieldName="area_of_interest" :required=true />

    <!-- Skll Experties -->
    <x-fields.text-field label="Skill Experties" :data="old('skill_experties', isset($volunteerForm) ? $volunteerForm->skill_experties : null)" fieldName="skill_experties" :required=true />

    <!-- Motivation -->
    <x-fields.text-field label="Motivation" :data="old('motivation', isset($volunteerForm) ? $volunteerForm->motivation : null)" fieldName="motivation" :required=true />

    <!-- Previous Volunteer Experience -->
    <x-fields.tel-field label="Previous Volunteer Experience" :data="old(
        'previous_volunteer_experience',
        isset($volunteerForm) ? $volunteerForm->previous_volunteer_experience : null,
    )"
        fieldName="previous_volunteer_experience" :required=true />

    <!-- Start Date -->
    <x-fields.date-field label="Start Date" :data="old('start_date', isset($volunteerForm) ? $volunteerForm->start_date : null)" fieldName="start_date" :required=true />

    <!-- Start Date -->
    <x-fields.date-field label="End Date" :data="old('end_date', isset($volunteerForm) ? $volunteerForm->end_date : null)" fieldName="end_date" :required=true />

    <!-- Daily Availability -->
    <x-fields.select-enum-field label="Daily Availability" :data="isset($volunteerForm) ? $volunteerForm->type : ''" fieldName="daily_availability"
        :required=true :loopValue="$dailyAvailabilitytypes" useEnum="DailyAvailabilityEnum" />

    <!-- Insurance Proof -->
    <x-fields.file-upload-field label="Insurance Proof" :data="old('insurance_proof', isset($volunteerForm) ? $volunteerForm->insurance_proof : null)" fieldName="insurance_proof"
        currentName="current_file" :required=true accept=".pdf, .doc, .docx, .xls, .xlsx" />

    <!-- CV -->
    <x-fields.file-upload-field label="CV" :data="old('cv', isset($volunteerForm) ? $volunteerForm->cv : null)" fieldName="cv" currentName="current_file"
        :required=true accept=".pdf, .doc, .docx, .xls, .xlsx" />

    <!-- Passport Copy -->
    <x-fields.image-upload-field label="Passport Copy" :data="old('passport_copy', isset($volunteerForm) ? $volunteerForm->passport_copy : null)" fieldName="passport_copy"
        currentName="current_image" :required=true />

    <!-- Visa Copy -->
    <x-fields.image-upload-field label="Visa Copy" :data="old('visa_copy', isset($volunteerForm) ? $volunteerForm->visa_copy : null)" fieldName="visa_copy" currentName="current_image"
        :required=true />

    <!-- Digital Signature -->
    <x-fields.image-upload-field label="Digital Signature" :data="old('digital_signature', isset($volunteerForm) ? $volunteerForm->digital_signature : null)" fieldName="digital_signature"
        currentName="current_image" :required=true />

    <!-- Accomendation Required -->
    <x-fields.boolean-field label="Accomendation Required?" :data="old('accomodation_required', isset($volunteerForm) ? $volunteerForm->accomodation_required : 0)" fieldName="accomodation_required"
        :required=false />

    <!-- Travel Insurance -->
    <x-fields.boolean-field label="Travel Insurance?" :data="old('travel_insurance', isset($volunteerForm) ? $volunteerForm->travel_insurance : 0)" fieldName="travel_insurance" :required=false />


    <!-- Criminal Record -->
    <x-fields.boolean-field label="Criminal Record?" :data="old('criminal_record', isset($volunteerForm) ? $volunteerForm->criminal_record : 0)" fieldName="criminal_record" :required=false />

    <!-- Aggrement -->
    <x-fields.boolean-field label="Aggrement?" :data="old('aggrement', isset($volunteerForm) ? $volunteerForm->aggrement : 0)" fieldName="aggrement" :required=false />

    <!-- Medical Condition -->
    <x-fields.boolean-field label="Medical Condition?" :data="old('medical_condition', isset($volunteerForm) ? $volunteerForm->medical_condition : 0)" fieldName="medical_condition"
        :required=false />

    <!-- Is Scanned -->
    <x-fields.boolean-field label="Is Scanned?" :data="old('is_scanned', isset($volunteerForm) ? $volunteerForm->is_scanned : 0)" fieldName="is_scanned" :required=false />

    <!-- Is Shortlisted -->
    <x-fields.boolean-field label="Is Shortlisted?" :data="old('is_shortlisted', isset($volunteerForm) ? $volunteerForm->is_shortlisted : 0)" fieldName="is_shortlisted" :required=false />

</div>
<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- Medical Description -->
    <x-fields.textarea-summernote-field id="medicalDescription" label="Medical Description" :data="old('medical_description', isset($volunteerForm) ? $volunteerForm->medical_description : null)"
        fieldName="medical_description" :required=true />

    <!-- Dietary Restriction -->
    <x-fields.textarea-summernote-field label="Dietary Restriction" :data="old('dietary_restriction', isset($volunteerForm) ? $volunteerForm->dietary_restriction : null)" fieldName="dietary_restriction"
        :required=false />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Nepali Date Picker
            $('#date_of_birth_bs').nepaliDatePicker({
                dateFormat: '%y-%m-%d',
                closeOnDateSelect: true
            });



            // BS -> AD & Age
            $('#date_of_birth_bs').on('dateChange', function(event) {
                var bs = $(this).val();
                if (bs) {
                    var ad = bsToAd(bs);

                    $('#date_of_birth_ad').val(ad);
                    $('#age').val(calculateAge(ad));
                }
            });

            // AD -> BS & Age
            $('#date_of_birth_ad').on('change', function() {
                var ad = $(this).val();
                if (ad) {
                    var bs = adToBs(ad);
                    $('#date_of_birth_bs').val(bs);
                    $('#age').val(calculateAge(ad));
                }
            });

            // Age -> AD & BS
            $('#age').on('input', function() {
                var age = parseInt($(this).val());
                if (!isNaN(age)) {
                    var today = new Date();
                    var birthYear = today.getFullYear() - age;
                    var month = today.getMonth() + 1;
                    var day = today.getDate();
                    var ad = birthYear + '-' + String(month).padStart(2, '0') + '-' + String(day).padStart(
                        2, '0');
                    $('#date_of_birth_ad').val(ad);
                    $('#date_of_birth_bs').val(adToBs(ad));
                }
            });

        });

        // Convert AD to BS
        function adToBs(ad) {
            var parts = ad.split('-');
            var adYear = parseInt(parts[0]);
            var adMonth = parseInt(parts[1]);
            var adDay = parseInt(parts[2]);
            var bsDate = calendarFunctions.getBsDateByAdDate(adYear, adMonth, adDay);
            var fullDate = bsDate.bsYear + '-' + String(bsDate.bsMonth).padStart(2, '0') + '-' + String(bsDate.bsDate)
                .padStart(2, '0');

            return convertEnglishToNepaliNumbers(fullDate);
        }

        // Convert BS to AD
        function bsToAd(bs) {
            var parts = bs.split('-');
            var bsYear = parseInt(calendarFunctions.getNumberByNepaliNumber(parts[0]));
            var bsMonth = parseInt(calendarFunctions.getNumberByNepaliNumber(parts[1]));
            var bsDate = parseInt(calendarFunctions.getNumberByNepaliNumber(parts[2]));
            var adDate = calendarFunctions.getAdDateByBsDate(bsYear, bsMonth, bsDate);
            return adDate.getFullYear() + '-' + String(adDate.getMonth() + 1).padStart(2, '0') + '-' + String(
                adDate.getDate()).padStart(2, '0');
        }

        // Calculate Age from AD
        function calculateAge(ad) {
            var parts = ad.split('-');
            var birthDate = new Date(parts[0], parts[1] - 1, parts[2]);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        $('.image').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });

        function toggleOtherGender() {
            var genderSelect = document.getElementById('gender');
            var otherGenderField = document.getElementById('otherGenderField');
            var otherGenderInput = document.getElementById('other_gender');

            if (genderSelect.value === 'others') {
                otherGenderField.style.display = 'block';
            } else {
                otherGenderField.style.display = 'none';
                otherGenderInput.value = '';
            }
        }

        window.onload = function() {
            toggleOtherGender();

            var genderSelect = document.getElementById('gender');
            if (genderSelect) {
                genderSelect.addEventListener('change', toggleOtherGender);
            }
        };

        //Medical Condition Field

        $(document).ready(function() {
            let isFeatured = $('input[name=medical_condition]:checked').val();
            toggleIcon(isFeatured);

            // On change
            $(document).on('change', 'input[name=medical_condition]', function() {
                let value = $(this).val();
                toggleIcon(value);
            });

            function toggleIcon(value) {
                if (value == 1) {
                    $('#medicalDescription').removeClass('hidden');
                } else {
                    $('#medicalDescription').addClass('hidden');
                    $('#medicalDescription input[type=file]').val(''); // clear if hidden
                }
            }
        });
    </script>
@endpush
