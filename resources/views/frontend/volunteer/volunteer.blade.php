@extends('frontend.layouts.app')

@section('title', 'Volunteer')

@php
    use App\Helpers\Helper;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.volunteer'),
        'subHeading' => __('pages.volunteer_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.volunteer'),
            'route' => route('volunteer-page.show'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <section id="carrer-detail-section">
        <!-- Volunteer Box -->
        <div id="registerYourself-section"
            class="bg-white w-full px-6 md:px-28 py-10 flex flex-col lg:flex-row gap-10 lg:gap-14">

            <!-- ------------------------- Left Section --------------------------- -->
            <div class="flex-1 flex flex-col space-y-8">

                <!-- Title Line -->
                <div class="flex items-center space-x-4">
                    <h2 class="text-primary opacity-70 font-semibold text-base">
                        {{ __('homepage.register_yourself_with_us') }}
                    </h2>
                    <span class="w-[44.5px] border-b-2 border-[#03624C]"></span>
                </div>

                <!-- Main Heading -->
                <h1 class="font-bold text-3xl sm:text-4xl lg:text-5xl">
                    {!! __('homepage.become_a_volunteer') !!}
                </h1>

                <!-- Images -->
                @php
                    $images = $volunteer->images ? json_decode($volunteer->images) : [];
                @endphp

                <div class="flex flex-col space-y-4">
                    @foreach ($images as $image)
                        <img src="{{ asset($image) }}" alt="Register Image"
                            class="w-full h-64 lg:h-80 object-cover rounded-xl shadow border border-gray-200" />
                    @endforeach
                </div>

                <!-- Description -->
                <div class="text-base leading-8 text-gray-700">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en'
                            ? $volunteer->description_en ?? ''
                            : $volunteer->description_np ?? ($volunteer->description_en ?? ''),
                    ) !!}
                </div>
            </div>

            <!-- ------------------------- Right Section --------------------------- -->
            <div class="flex-1 flex flex-col space-y-6">

                <!-- Image -->
                <img src="{{ asset('assets/frontend/images/homepage/volunteer-hands.png') }}" alt="Volunteer Hands"
                    class="w-full h-64 lg:h-[380px] object-cover rounded-xl  " />

                <!-- Title -->
                <p class="text-xl font-extrabold text-black">
                    {!! __('homepage.what_we_look_in_volunteers') !!}
                </p>

                <!-- Qualification -->
                <div class="text-base leading-7 text-gray-700">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en'
                            ? $volunteer->qualification_en ?? ''
                            : $volunteer->qualification_np ?? ($volunteer->qualification_en ?? ''),
                    ) !!}
                </div>
            </div>
        </div>
        <!-- Job Application Section -->
        <div class="max-w-6xl mx-auto my-10 p-6 bg-gray-50 rounded-lg shadow-md border border-gray-200">
            <h4 class="text-xl md:text-2xl font-bold mb-6 text-center">{{ __('pages.volunteer_form') }}</h4>
            <form class="space-y-4"action="{{ route('volunteer-page.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Full Name -->
                    <x-fields.text-field label="{{ __('pages.full_name') }}" :data="old('full_name')" fieldName="full_name"
                        :required=true />

                    <!-- Date of Birth (AD) -->
                    <x-fields.date-field label="{{ __('pages.date_of_birth_ad') }}" :data="old('date_of_birth_ad')"
                        fieldName="date_of_birth_ad" :required=true />

                    <!-- Date of Birth (BS) -->
                    <x-fields.text-field label="{{ __('pages.date_of_birth_bs') }}" :data="old('date_of_birth_bs')"
                        fieldName="date_of_birth_bs" :required=true />

                    <!-- Age -->
                    <x-fields.integer-field label="{{ __('pages.age') }}" :data="old('age')" fieldName="age" :required=true
                        id="age" attribute="readonly" />

                    <!-- Gender -->
                    <x-fields.select-enum-field label="{{ __('pages.gender') }}" :data="old('gender')" fieldName="gender"
                        :required=true :loopValue="$types" useEnum="GenderTypeEnum" />

                    <!-- Other Gender -->
                    <x-fields.text-field id="otherGenderField" class="hidden" label="{{ __('pages.specify_gender') }}"
                        fieldName="other_gender" :data="old('other_gender')" :required=false />

                    <!-- Nationality -->
                    <x-fields.text-field label="{{ __('pages.nationality') }}" :data="old('nationality')" fieldName="nationality"
                        :required=true />

                    <!-- Passport Number -->
                    <x-fields.tel-field label="{{ __('pages.passport_no') }}" :data="old('passport_number')" fieldName="passport_number"
                        :required=false />

                    <!-- Email -->
                    <x-fields.email-field label="{{ __('pages.email') }}" :data="old('email')" fieldName="email"
                        :required=true />

                    <!-- Contact Number -->
                    <x-fields.tel-field label="{{ __('pages.contact_no') }}" :data="old('contact_no')" fieldName="contact_no"
                        :required=true />

                    <!-- Current Address -->
                    <x-fields.text-field label="{{ __('pages.current_address') }}" :data="old('current_address')"
                        fieldName="current_address" :required=true />
                </div>

                <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                    <legend class="block text-sm font-semibold text-gray-700 px-5">{{ __('pages.emergency_detail') }}
                    </legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Emergency Full Name -->
                        <x-fields.text-field label="{{ __('pages.full_name') }}" :data="old('emergency_full_name')"
                            fieldName="emergency_full_name" :required=true />

                        <!-- Emergency Relationship -->
                        <x-fields.text-field label="{{ __('pages.relationship') }}" :data="old('emergency_relationship')"
                            fieldName="emergency_relationship" :required=true />

                        <!-- Emergency Contact Number -->
                        <x-fields.tel-field label="{{ __('pages.contact_no') }}" :data="old('emergency_contact_number')"
                            fieldName="emergency_contact_number" :required=true />

                        <!-- Emergency Email -->
                        <x-fields.email-field label="{{ __('pages.email') }}" :data="old('emergency_email')"
                            fieldName="emergency_email" :required=true />
                    </div>
                </fieldset>

                <div class="grid grid-cols-1 gap-4">
                    <!-- Area of Interest -->
                    <x-fields.textarea-summernote-field label="{{ __('pages.area_of_interest') }}" :data="old('area_of_interest')"
                        fieldName="area_of_interest" :required=true />

                    <!-- Skll Experties -->
                    <x-fields.textarea-summernote-field label="{{ __('pages.skill_experties') }}" :data="old('skill_experties')"
                        fieldName="skill_experties" :required=true />

                    <!-- Motivation -->
                    <x-fields.textarea-summernote-field label="{{ __('pages.motivation') }}" :data="old('motivation')"
                        fieldName="motivation" :required=true />

                    <!-- Previous Volunteer Experience -->
                    <x-fields.textarea-summernote-field label="{{ __('pages.volunteer_experience') }}" :data="old('previous_volunteer_experience')"
                        fieldName="previous_volunteer_experience" :required=true />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Start Date -->
                    <x-fields.date-field label="{{ __('pages.start_date') }}" :data="old('start_date')" fieldName="start_date"
                        :required=true />

                    <!-- Start Date -->
                    <x-fields.date-field label="{{ __('pages.end_date') }}" :data="old('end_date')" fieldName="end_date"
                        :required=true />

                    <!-- Daily Availability -->
                    <x-fields.select-enum-field label="{{ __('pages.daily_availability') }}" :data="old('daily_availability')"
                        fieldName="daily_availability" :required=true :loopValue="$dailyAvailabilitytypes" useEnum="DailyAvailabilityEnum" />

                    <!-- Insurance Proof -->
                    <x-fields.file-upload-field label="{{ __('pages.insurance_proof') }}" :data="old('insurance_proof')"
                        fieldName="insurance_proof" currentName="current_file" :required=true
                        accept=".pdf, .doc, .docx, .xls, .xlsx" />

                    <!-- CV -->
                    <x-fields.file-upload-field label="{{ __('pages.cv') }}" :data="old('cv')" fieldName="cv"
                        currentName="current_file" :required=true accept=".pdf, .doc, .docx, .xls, .xlsx" />

                    <!-- Passport Copy -->
                    <x-fields.image-upload-field label="{{ __('pages.passport_copy') }}" :data="old('passport_copy')"
                        fieldName="passport_copy" currentName="current_image" :required=true />

                    <!-- Visa Copy -->
                    <x-fields.image-upload-field label="{{ __('pages.visa_copy') }}" :data="old('visa_copy')"
                        fieldName="visa_copy" currentName="current_image" :required=true />

                    <!-- Digital Signature -->
                    <x-fields.image-upload-field label="{{ __('pages.digital_signature') }}" :data="old('digital_signature')"
                        fieldName="digital_signature" currentName="current_image" :required=true />

                    <!-- Accomendation Required -->
                    <x-fields.boolean-field label="{{ __('pages.accomodation_required') }}?" :data="old('accomodation_required')"
                        fieldName="accomodation_required" :required=false />

                    <!-- Travel Insurance -->
                    <x-fields.boolean-field label="{{ __('pages.travel_insurance') }}?" :data="old('travel_insurance')"
                        fieldName="travel_insurance" :required=false />


                    <!-- Criminal Record -->
                    <x-fields.boolean-field label="{{ __('pages.criminal_record') }}?" :data="old('criminal_record')"
                        fieldName="criminal_record" :required=false />

                    <!-- Medical Condition -->
                    <x-fields.boolean-field label="{{ __('pages.medical_condition') }}?" :data="old('medical_condition')"
                        fieldName="medical_condition" :required=false />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
                    <!-- Medical Description -->
                    <x-fields.textarea-field id="medicalDescription" label="{{ __('pages.medical_description') }}"
                        :data="old('medical_description')" fieldName="medical_description" :required=true />

                    <!-- Dietary Restriction -->
                    <x-fields.textarea-field label="{{ __('pages.dietary_restriction') }}" :data="old('dietary_restriction')"
                        fieldName="dietary_restriction" :required=false />
                </div>

                <div class="col-span-1 md:col-span-2 lg:col-span-3 flex items-center gap-2 mt-3">
                    <input type="checkbox" id="aggrement" name="aggrement"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-primary focus:ring-2"
                        value="1" {{ old('aggrement') == 1 ? 'checked' : '' }}>
                    <label for="aggrement" class="block text-sm font-semibold text-gray-700">
                        {!! app()->getLocale() == 'en'
                            ? 'I accept all the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a>.'
                            : 'म सबै <a href="#" class="text-blue-600 hover:underline">नियम तथा शर्तहरू</a> स्वीकृत गर्दछु' !!}
                    </label>
                    <br>
                    @error('aggrement')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr>

                <div class="w-full flex justify-center">
                    <button type="submit"
                        class="w-44 text-center py-3 px-5 rounded-lg border-2 border-primary bg-primary text-white hover:bg-white hover:text-primary transition-all ease-in-out cursor-pointer tracking-wide my-6 font-semibold shadow-md hover:shadow-lg">
                        {{ __('pages.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

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

        $(document).ready(function() {

            function toggleOtherGender() {
                var genderSelect = document.getElementById('gender');
                var otherGenderField = document.getElementById('otherGenderField');
                var otherGenderInput = document.getElementById('other_gender');

                if (!genderSelect || !otherGenderField || !otherGenderInput) return;

                if (genderSelect.value === 'others') {
                    otherGenderField.style.display = 'block';
                } else {
                    otherGenderField.style.display = 'none';
                    otherGenderInput.value = '';
                }
            }

            toggleOtherGender();

            $('#gender').on('change', toggleOtherGender);

        });


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
