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
    <!-- Select Career -->
    <x-fields.select-field label="Career" :data="isset($jobApplication) ? $jobApplication->career_id : ''" fieldName="career_id" :required=true :loopValue="$careers" />

    <!-- Full Name -->
    <x-fields.text-field label="Full Name" :data="old('full_name', isset($jobApplication) ? $jobApplication->full_name : null)" fieldName="full_name" :required=true />

    <!-- Gender -->
    <x-fields.select-enum-field label="Gender" :data="isset($jobApplication) ? $jobApplication->gender : ''" fieldName="gender" :required=true :loopValue="$types"
        useEnum="GenderTypeEnum" />

    <!-- Other Gender -->
    <div id="otherGenderField"
        style="{{ old('gender', isset($jobApplication) ? $jobApplication->gender : '') == 'others' ? '' : 'display: none' }}">

        <x-fields.text-field label="Specify Gender" fieldName="other_gender" :data="old('other_gender', isset($jobApplication) ? $jobApplication->other_gender : null)" :required=false />
    </div>

    <!-- Date of Birth (AD) -->
    <x-fields.date-field label="Date of Birth (AD)" :data="old('date_of_birth_ad', isset($jobApplication) ? $jobApplication->date_of_birth_ad : null)" fieldName="date_of_birth_ad" :required=true />

    <!-- Date of Birth (BS) -->
    <x-fields.text-field label="Date of Birth (BS)" :data="old('date_of_birth_bs', isset($jobApplication) ? $jobApplication->date_of_birth_bs : null)" fieldName="date_of_birth_bs" :required=true />

    <!-- Age -->
    <x-fields.integer-field label="Age" :data="old('age', isset($jobApplication) ? $jobApplication->age : null)" fieldName="age" :required=true id="age"
        attribute="readonly" />

    <!-- Current Address -->
    <x-fields.text-field label="Current Address" :data="old('current_address', isset($jobApplication) ? $jobApplication->current_address : null)" fieldName="current_address" :required=true />

    <!-- Mobile Number -->
    <x-fields.tel-field label="Mobile Number" :data="old('mobile_number', isset($jobApplication) ? $jobApplication->mobile_number : null)" fieldName="mobile_number" :required=true />

    <!-- Email -->
    <x-fields.email-field label="Email" :data="old('email', isset($jobApplication) ? $jobApplication->email : null)" fieldName="email" :required=true />

    <!-- Phone Number -->
    <x-fields.tel-field label="Phone Number" :data="old('phone_no', isset($jobApplication) ? $jobApplication->phone_no : null)" fieldName="phone_no" :required=false />

    <!-- Highest Education Qualification -->
    <x-fields.text-field label="Highest Education Qualification" :data="old(
        'highest_education_qualification',
        isset($jobApplication) ? $jobApplication->highest_education_qualification : null,
    )"
        fieldName="highest_education_qualification" :required=true />

    <!-- CV -->
    <x-fields.file-upload-field label="CV" :data="old('cv', isset($jobApplication) ? asset($jobApplication->cv) : null)" fieldName="cv" currentName="current_file"
        :required=false accept=".pdf, .doc, .docx, .xls, .xlsx" />

    <!-- Is Scanned -->
    <x-fields.boolean-field label="Is Scanned?" :data="old('is_scanned', isset($jobApplication) ? $jobApplication->is_scanned : null)" fieldName="is_scanned" :required=false />

    <!-- Is Shortlisted -->
    <x-fields.boolean-field label="Is Shortlisted?" :data="old('is_shortlisted', isset($jobApplication) ? $jobApplication->is_shortlisted : null)" fieldName="is_shortlisted" :required=false />

</div>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
    <!-- Cover Letter -->
    <x-fields.textarea-field label="Cover Letter" :data="old('cover_letter', isset($jobApplication) ? $jobApplication->cover_letter : null)" fieldName="cover_letter" :required=true />
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
    </script>
@endpush
