@extends('frontend.layouts.app')

@php
    use Carbon\Carbon;
    use App\Helpers\Helper;
    use App\Enum\TimingTypeEnum;
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;

    $name = app()->getLocale() == 'en' ? $career->name_en ?? '' : $career->name_np ?? ($career->name_en ?? '');
@endphp

@section('title', $career->name_en)

@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.career_details'),
        'subHeading' => __('pages.career_details_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.career'),
            'route' => route('career'),
        ],
        'breadcrumb3' => [
            'name' => $name,
            'route' => route('career-details.show', $career->slug),
            'class' => 'text-gray-400',
        ],
        'breadcrumb4' => null,
    ])

    <section id="carrer-detail-section">
        <!-- Career Detail Box -->
        <div class="w-full bg-white px-8 py-6">
            @if (isset($career))
                <h4 class="text-xl md:text-2xl font-bold mb-2 text-primary">
                    {{ $name }}
                </h4>

                <p class="text-gray-700 mb-2">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en'
                            ? $career->requirement_en ?? ''
                            : $career->requirement_np ?? ($career->requirement_en ?? ''),
                    ) !!}
                </p>

                <p class="text-black-600 mb-1">
                    <strong>{{ __('pages.designation') }} :</strong>
                    {{ app()->getLocale() == 'en' ? $career->designation->name_en ?? '' : $career->designation->name_np ?? ($career->designation->name_en ?? '') }}
                </p>

                <p class="text-black-600 mb-1">
                    <strong>{{ __('pages.apply_till') }} :</strong>
                    {{ app()->getLocale() == 'en'
                        ? $career->valid_date
                        : LaravelNepaliDate::from($career->valid_date)->toNepaliDate(format: 'j F Y', locale: 'np') }}
                </p>

                <p class="text-black-600 mb-1">
                    <strong>{{ __('pages.shift') }} :</strong>
                    {{ app()->getLocale() == 'en'
                        ? TimingTypeEnum::map($career->timing) ?? ''
                        : TimingTypeEnum::mapNp($career->timing) ?? (TimingTypeEnum::map($career->timing) ?? '') }}
                </p>

                <p class="text-black-600">
                    <strong>{{ __('pages.no_of_post') }} :</strong>
                    {{ app()->getLocale() == 'en'
                        ? $career->number_of_post ?? ''
                        : Helper::convertEnglishToNepaliNumbers($career->number_of_post) ?? ($career->number_of_post ?? '') }}
                </p>
            @endif
        </div>

        <!-- Job Application Section -->
        <div class="max-w-3xl mx-auto my-10 p-6 bg-gray-50 rounded-lg shadow-md border border-gray-200">
            <h4 class="text-xl md:text-2xl font-bold mb-6 text-center text-primary">{{ __('pages.apply_for_this_job') }}</h4>
            <form class="space-y-4"action="{{ route('career-details.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    <!-- Select Career -->
                    <x-fields.select-field label="{{ __('pages.career') }}" :data="old('career_id', $career->id)" fieldName="career_id"
                        :required=true :loopValue="$jobApplicationCategories" :disabled="false" class="hidden" />

                    <!-- Full Name (Full width) -->
                    <div class="md:col-span-2">
                        <x-fields.text-field label="{{ __('pages.full_name') }}" :data="old('full_name')" fieldName="full_name"
                            :required="true" />
                    </div>

                    <!-- Gender -->
                    <x-fields.select-enum-field label="{{ __('pages.gender') }}" :data="old('gender')" fieldName="gender"
                        :required=true :loopValue="$types" useEnum="GenderTypeEnum" />

                    <!-- Other Gender -->
                    <x-fields.text-field id="otherGenderField" class="hidden" label="{{ __('pages.specify_gender') }}"
                        fieldName="other_gender" :data="old('other_gender')" :required=false />

                    <!-- Date of Birth (AD) -->
                    <x-fields.date-field label="{{ __('pages.date_of_birth_ad') }}" :data="old('date_of_birth_ad')"
                        fieldName="date_of_birth_ad" :required=true />

                    <!-- Date of Birth (BS) -->
                    <x-fields.text-field label="{{ __('pages.date_of_birth_bs') }}" :data="old('date_of_birth_bs')"
                        fieldName="date_of_birth_bs" :required=true />

                    <!-- Age -->
                    <x-fields.integer-field label="{{ __('pages.age') }}" :data="old('age')" fieldName="age" :required=true
                        id="age" attribute="readonly" />

                    <!-- Current Address -->
                    <x-fields.text-field label="{{ __('pages.current_address') }}" :data="old('current_address')"
                        fieldName="current_address" :required=true />

                    <!-- Mobile Number -->
                    <x-fields.tel-field label="{{ __('pages.mobile_no') }}" :data="old('mobile_number')" fieldName="mobile_number"
                        :required=true />

                    <!-- Email -->
                    <x-fields.email-field label="{{ __('pages.email') }}" :data="old('email')" fieldName="email"
                        :required=true />

                    <!-- Phone Number -->
                    <x-fields.tel-field label="{{ __('pages.phone_no') }}" :data="old('phone_no')" fieldName="phone_no"
                        :required=false />

                    <!-- Highest Education Qualification -->
                    <x-fields.text-field label="{{ __('pages.qualification') }}" :data="old('highest_education_qualification')"
                        fieldName="highest_education_qualification" :required=true />

                    <!-- CV -->
                    <x-fields.file-upload-field label="{{ __('pages.cv') }}" :data="old('cv')" fieldName="cv"
                        currentName="current_file" :required=true accept=".pdf, .doc, .docx, .xls, .xlsx" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-2">
                    <!-- Cover Letter -->
                    <x-fields.textarea-field label="{{ __('pages.cover_letter') }}" :data="old('cover_letter')"
                        fieldName="cover_letter" :required=true />
                </div>

                <div>
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full flex justify-center">
                    <button type="submit"
                        class="w-44 text-center py-3 px-5 rounded-lg border-2 border-primary bg-primary text-white hover:bg-white hover:text-primary transition-all ease-in-out cursor-pointer tracking-wide my-6 font-semibold shadow-md hover:shadow-lg">
                        Submit
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
    </script>
@endpush
