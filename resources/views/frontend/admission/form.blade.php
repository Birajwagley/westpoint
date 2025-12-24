@php
    use App\Helpers\Helper;
    $subjectMappings = $subjectMappings ?? [];
@endphp

@if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 border border-red-400 rounded">
        <ul class="list-disc list-inside text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">{{ __('pages.personal_details') }}</h2>
<!-- Student Photo Upload -->
<div class="mb-6 flex flex-col items-start" id="photoDiv">
    <x-fields.image-upload-field label="{{ __('pages.student_photo') }}" :data="old('photo', $admission->photo ?? null)" fieldName="photo"
        currentName="current_photo" :required="false" />
</div>

<!-- Basic Info -->
<div class="mt-6  pt-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <x-fields.text-field label="{{ __('pages.first_name') }}" :data="old('first_name', $admission->first_name ?? null)" fieldName="first_name"
            :required=true />
        <x-fields.text-field label="{{ __('pages.middle_name') }}" :data="old('middle_name', $admission->middle_name ?? null)" fieldName="middle_name"
            :required=false />
        <x-fields.text-field label="{{ __('pages.last_name') }}" :data="old('last_name', $admission->last_name ?? null)" fieldName="last_name"
            :required=true />
        <x-fields.text-field label="{{ __('pages.email') }}" :data="old('email', $admission->email ?? null)" fieldName="email" :required="true" />
        <x-fields.date-field label="{{ __('pages.date_of_birth_ad') }}" :data="old('dob_ad', isset($admission) ? $admission->dob_ad : null)" fieldName="dob_ad"
            :required=true />
        <x-fields.text-field label="{{ __('pages.date_of_birth_bs') }}" :data="old('dob_bs', isset($admission) ? $admission->dob_bs : null)" fieldName="dob_bs"
            :required=true />
        <x-fields.integer-field label="{{ __('pages.age') }}" :data="old('age', isset($admission) ? $admission->age : null)" fieldName="age" :required=true
            id="age" attribute="readonly" />
        <x-fields.select-enum-field label="{{ __('pages.gender') }}" :data="isset($admission) ? $admission->gender : ''" fieldName="gender"
            :required=true :loopValue="$types" useEnum="GenderTypeEnum" />
        <div id="otherGenderField"
            style="{{ old('gender', isset($admission) ? $admission->gender : '') == 'others' ? '' : 'display:none' }}">
            <x-fields.text-field label="{{ __('pages.specify_gender') }}" fieldName="other_gender" :data="old('other_gender', isset($admission) ? $admission->other_gender : null)"
                :required=false />
        </div>
    </div>
</div>

{{-- Contact Details --}}
<div class="mt-6  pt-4">
    <h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">Contact Details</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <x-fields.text-field label="{{ __('pages.permanent_address') }}" :data="old('permanent_address', $admission->permanent_address ?? null)"
            fieldName="permanent_address" :required="true" />
        <x-fields.text-field label="{{ __('pages.current_address') }}" :data="old('current_address', $admission->current_address ?? null)" fieldName="current_address"
            :required="true" />
        <x-fields.text-field label="{{ __('pages.nationality') }}" :data="old('nationality', $admission->nationality ?? null)" fieldName="nationality"
            :required="true" />
        <x-fields.text-field label="{{ __('pages.contact_no') }}" :data="old('contact_no', $admission->contact_no ?? null)" fieldName="contact_no"
            :required="true" />

    </div>
</div>

{{-- Academic Details --}}
<div class="mt-6  pt-4">
    <h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">Academic Details</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <x-fields.text-field label="{{ __('pages.academic_year') }}" :data="old('academic_year', $admission->academic_year ?? null)" fieldName="academic_year"
            :required="true" />
        <x-fields.text-field label="{{ __('pages.previous_school') }}" :data="old('previous_school', $admission->previous_school ?? null)" fieldName="previous_school"
            :required="true" />
        <x-fields.text-field label="{{ __('pages.previous_school_address') }}" :data="old('previous_school_address', $admission->previous_school_address ?? null)"
            fieldName="previous_school_address" :required="true" />
        <x-fields.select-field label="{{ __('pages.academic_level') }}" fieldName="academic_level_id"
            :data="old('academic_level_id', $admission->academic_level_id ?? null)" :loopValue="$academicLevels" :required="true" />
    </div>
</div>

<!-- Parents / Guardians -->
<div class="mt-6 pt-4">
    <h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">{{ __('pages.parents_guardians') }}</h2>

    <div class="mb-6 flex flex-col items-start">
        <x-fields.boolean-field label="{{ __('pages.living_with_guardian') }}" :data="old('living_with_guardian', $admission->living_with_guardian ?? 0)"
            fieldName="living_with_guardian" :required="true" />
    </div>

    <div id="parentsWrapper" class="space-y-3">
        @php
            $parents = old(
                'parents',
                $admission
                    ? $admission->parents
                        ->map(function ($parent) {
                            return [
                                'relation' => $parent->relation,
                                'name' => $parent->name,
                                'occupation' => $parent->occupation,
                                'contact_no' => $parent->contact_no,
                            ];
                        })
                        ->toArray()
                    : [],
            );

            if (!$admission || $admission->parents->isEmpty()) {
                $parents = [
                    ['relation' => 'Father', 'name' => '', 'occupation' => '', 'contact_no' => ''],
                    ['relation' => 'Mother', 'name' => '', 'occupation' => '', 'contact_no' => ''],
                ];
            }
        @endphp

        @foreach ($parents as $index => $parent)
            @php
                $labelName =
                    $index == 0 ? __('pages.father') : ($index == 1 ? __('pages.mother') : __('pages.guardian'));
            @endphp

            <div class="parent-fields border p-3 mb-3 rounded-lg relative {{ $index > 1 ? 'guardian-field' : '' }}">
                @if ($index > 1)
                    <button type="button"
                        class="remove-parent-btn absolute top-2 right-2 text-red-500 font-bold">&times;</button>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700"
                            for="parents[{{ $index }}][name]">
                            {{ $labelName }} {{ __('pages.name') }} <span class="text-red-600">*</span>
                        </label>

                        <input type="text" name="parents[{{ $index }}][name]"
                            value="{{ old("parents.$index.name", $parent['name'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary
                            @error("parents.$index.name") border-red-500 @enderror">

                        @error("parents.$index.name")
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label class="block text-sm font-semibold text-gray-700"
                            for="parents[{{ $index }}][relation]">
                            {{ $labelName }} {{ __('pages.relation') }} <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="parents[{{ $index }}][relation]"
                            value="{{ old("parents.$index.relation", $parent['relation'] ?? $labelName) }}"
                            @if ($index < 2) readonly @endif
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                            focus:ring-primary focus:border-primary
                            @error("parents.$index.relation") border-red-500 @enderror
                            @if ($index < 2) bg-gray-100 cursor-not-allowed @endif">
                        @error("parents.$index.relation")
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700"
                            for="parents[{{ $index }}][occupation]">{{ $labelName }}
                            {{ __('pages.occupation') }}</label>
                        <input type="text" name="parents[{{ $index }}][occupation]"
                            value="{{ old("parents.$index.occupation", $parent['occupation'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary
                            @error("parents.$index.occupation") border-red-500 @enderror">
                        @error("parents.$index.occupation")
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700"
                            for="parents[{{ $index }}][contact_no]">{{ $labelName }}
                            {{ __('pages.contact_no') }}</label>
                        <input type="text" name="parents[{{ $index }}][contact_no]"
                            value="{{ old("parents.$index.contact_no", $parent['contact_no'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary
                            @error("parents.$index.contact_no") border-red-500 @enderror">
                        @error("parents.$index.contact_no")
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-buttons.add-more-button wrapperId="parentsWrapper" componentName="parent-field" />
</div>

<!-- Apply For -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6 {{ $applyFor ?? '' }}">
    <div class="mt-4" id="is_school">
        <label class="block text-sm font-semibold text-gray-700 mb-1">{{ __('pages.apply_for') }}</label>
        <div class="flex items-center space-x-6 mt-1">
            <label class="inline-flex items-center">
                <input type="radio" name="is_school" value="1"
                    class="form-radio text-primary focus:ring-secondary"
                    {{ old('is_school', isset($typeOfAdmission) ? $typeOfAdmission : $admission->is_school ?? 1) == 1 ? 'checked' : '' }} />
                <span class="ml-2 text-gray-700">{{ __('pages.school_level') }}</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="is_school" value="0"
                    class="form-radio text-primary focus:ring-secondary"
                    {{ old('is_school', isset($typeOfAdmission) ? $typeOfAdmission : $admission->is_school ?? 1) == 0 ? 'checked' : '' }} />
                <span class="ml-2 text-gray-700">{{ __('pages.college_level') }}</span>
            </label>
        </div>
    </div>
</div>

<!-- School Section -->
<div class="mt-6 pt-4" id="schoolSection">
    <h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">{{ __('pages.school_level') }}
        {{ __('pages.info') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <x-fields.select-enum-field label="{{ __('pages.admission_type') }}" :data="isset($admission) ? $admission->admission_type : ''"
            fieldName="admission_type" :required="false" :loopValue="$admissionType" useEnum="AdmissionTypeEnum" />

        <x-fields.select-field label="{{ __('pages.class_id') }}" fieldName="class_id" :data="old('class_id', $admission->school->class_id ?? null)"
            :loopValue="$classes" :required="false" />
        <x-fields.select-field label="{{ __('pages.last_class') }}" fieldName="last_class_id" :data="old('last_class_id', $admission->school->last_class_id ?? null)"
            :loopValue="$classes" :required="false" />
    </div>
</div>

<!-- College Info -->
<div class="mt-6  pt-4" id="collegeSection">
    <h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">{{ __('pages.college_level') }}
        {{ __('pages.info') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <x-fields.select-field label="{{ __('pages.faculty_name') }}" fieldName="faculty_id" :data="old('faculty_id', $admission->college->faculty_id ?? null)"
            :loopValue="$faculties" :required="false" id="facultySelect" />
        <x-fields.text-field label="{{ __('pages.gpa') }}" :data="old('gpa', $admission->college->gpa ?? null)" fieldName="gpa" :required="false" />
        <x-fields.text-field label="{{ __('pages.board') }}" :data="old('board', $admission->college->board ?? null)" fieldName="board"
            :required="false" />
    </div>

    <!-- Subjects Table -->
    <div class="mt-6">
        <label class="block font-medium text-gray-700 mb-3 text-lg">{{ __('pages.subjects') }}</label>

        <div class="overflow-x-auto">
            <table class="min-w-[30vw] bg-white shadow-md rounded-lg overflow-hidden text-sm" id="subjectsTable">
                <thead class="bg-secondary">
                    <tr>
                        <th class="px-5 py-3 text-left text-white uppercase tracking-wider">{{ __('pages.subjects') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($groups as $group)
                        <tr class="hover:bg-gray-50 transition-colors duration-200"
                            data-group-id="{{ $group->id }}">

                            <td class="px-5 py-4">
                                <select name="subjects[{{ $group->id }}]" id="groupId{{ $group->id }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 subject-select @error('subjects.' . $group->id) border-red-500 @enderror">
                                    <option value="" selected>{{ __('pages.select_faculty_first') }}</option>
                                </select>

                                @error('subjects.' . $group->id)
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pick & Drop Facility -->
<div class="mt-6 pt-4">
    <h2 class="font-semibold text-white bg-primary p-3 mb-4 rounded-md">{{ __('pages.pick_drop_facility') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        <x-fields.boolean-field label="{{ __('pages.pick_drop_facility_needed') }}" :data="old('pick_drop_facility_needed', $admission->pick_drop_facility_needed ?? 0)"
            fieldName="pick_drop_facility_needed" :required="true" />

        <div id="pickDropLocationDiv" class="mt-3"
            style="{{ old('pick_drop_facility_needed', $admission->pick_drop_facility_needed ?? 0) == 1 ? '' : 'display:none;' }}">
            <x-fields.text-field label="{{ __('pages.pick_drop_location') }}" fieldName="pick_drop_location"
                :data="old('pick_drop_location', $admission->pick_drop_location ?? null)" :required="false" />
        </div>
    </div>
</div>

<div>
    {!! NoCaptcha::renderJs() !!}
    {!! NoCaptcha::display() !!}
    @error('g-recaptcha-response')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6 mt-6 pt-4">
    <div class="flex items-center space-x-2">
        <input type="checkbox" id="approval" name="approval" value="1"
            class="h-5 w-5 text-blue-600 border-gray-300 rounded"
            {{ old('approval', $admission->approval ?? 0) == 1 ? 'checked' : '' }}>
        <label for="approval" class="text-gray-700 font-medium">{{ __('pages.i_agree_to_the_above_declaration') }}
        </label>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            facultyValue = $('#faculty_id').val();
            if (facultyValue != '') {
                let oldSubjectValue = {!! json_encode(isset($admission) ? $subjectMappings : old('subjects')) !!};

                getFacultySubject(oldSubjectValue);
            }

            /*** Pick & Drop Facility Toggle ***/
            $('input[name="pick_drop_facility_needed"]').on('change', function() {
                if ($(this).is(':checked') && $(this).val() == 1) {
                    $('#pickDropLocationDiv').show();
                } else {
                    $('#pickDropLocationDiv').hide().find('input').val('');
                }
            });

            /*** Other Gender Toggle ***/
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

            /*** Initialize Nepali Date Picker ***/
            $('#dob_bs').nepaliDatePicker({
                dateFormat: '%y-%m-%d',
                closeOnDateSelect: true
            });

            /*** BS -> AD & Age ***/
            $('#dob_bs').on('dateChange', function(event) {
                var bs = $(this).val();
                if (bs) {
                    var ad = bsToAd(bs);
                    $('#dob_ad').val(ad);
                    $('#age').val(calculateAge(ad));
                }
            });

            /*** AD -> BS & Age ***/
            $('#dob_ad').on('change', function() {
                var ad = $(this).val();
                if (ad) {
                    var bs = adToBs(ad);
                    $('#dob_bs').val(bs);
                    $('#age').val(calculateAge(ad));
                }
            });

            /*** Age -> AD & BS ***/
            $('#age').on('input', function() {
                var age = parseInt($(this).val());
                if (!isNaN(age)) {
                    var today = new Date();
                    var birthYear = today.getFullYear() - age;
                    var month = today.getMonth() + 1;
                    var day = today.getDate();
                    var ad = birthYear + '-' + String(month).padStart(2, '0') + '-' + String(day).padStart(
                        2, '0');
                    $('#dob_ad').val(ad);
                    $('#dob_bs').val(adToBs(ad));
                }
            });

            /*** Faculty -> Subjects AJAX ***/
            $('#faculty_id').on('change', function() {
                getFacultySubject(null);
            });

            function getFacultySubject(oldSubjectValue) {
                var selectSubjectText = "{{ __('pages.select_subject') }}";
                var currentLang = "{{ app()->getLocale() }}";

                const facultyId = $('#faculty_id').val();
                let url = "{{ route('admission.getSubjects', ':id') }}".replace(':id', facultyId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {

                        $('.subject-select').empty().append(
                            '<option value="">' + selectSubjectText + '</option>'
                        );

                        $.each(response, function(index, value) {
                            let groupId = value.group_id;
                            let subjectId = value.subject_id;

                            let subjectSelect = $('#groupId' + groupId);

                            // Check if old value exists at this index
                            let isSelected = oldSubjectValue != null ?
                                (oldSubjectValue[groupId] == subjectId ?
                                    "selected" :
                                    "") : "";

                            subjectSelect.append(`
                                <option value="${subjectId}" ${isSelected}>
                                ${currentLang === 'en' ? value.subject.name_en : (value.subject.name_np ?? value.subject.name_en)}
                                </option>`);
                        });
                    }
                });

            }

            /*** Initialize Select2 ***/
            $('.select-single, .select-multi').select2({
                theme: 'tailwindcss-3'
            });

            /*** Parents / Guardians Dynamic Fields ***/
            const wrapper = document.getElementById('parentsWrapper');
            let template = document.getElementById('parent-field-template').innerHTML;


            template = template.replace(
                /name="parents\[__INDEX__]\[relation\]".*?>/,
                'name="parents[__INDEX__][relation]" placeholder="Relation (e.g. Uncle, Aunt, Sponsor)" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">'
            );

            function addGuardianField() {
                let index = wrapper.querySelectorAll('.parent-fields').length;
                let newField = template.replace(/__INDEX__/g, index);
                wrapper.insertAdjacentHTML('beforeend', newField);
            }

            function clearGuardians() {
                wrapper.querySelectorAll('.guardian-field').forEach(el => el.remove());
            }

            function toggleGuardians() {
                const selected = $('input[name="living_with_guardian"]:checked').val();

                if (selected == '1') {
                    wrapper.style.display = 'block';
                    clearGuardians();
                    addGuardianField();
                } else {
                    clearGuardians();
                }
            }

            $(document).on('click', '.remove-parent-btn', function() {
                $(this).closest('.parent-fields').remove();
            });

            toggleGuardians();
            $('input[name="living_with_guardian"]').on('change', toggleGuardians);

            toggleSchoolCollege();
            document.querySelectorAll('input[name="is_school"]').forEach(function(el) {
                el.addEventListener('change', toggleSchoolCollege);
            });
        });

        /*** School / College Toggle ***/
        function toggleSchoolCollege() {
            var schoolSection = document.getElementById('schoolSection');
            var collegeSection = document.getElementById('collegeSection');

            var isSchool = document.querySelector('input[name="is_school"]:checked').value === '1';

            if (isSchool) {
                schoolSection.style.display = 'block';
                collegeSection.style.display = 'none';

                collegeSection.querySelectorAll('input, select, textarea').forEach(function(el) {
                    el.value = '';
                });
            } else {
                collegeSection.style.display = 'block';
                schoolSection.style.display = 'none';

                schoolSection.querySelectorAll('input, select, textarea').forEach(function(el) {
                    el.value = '';
                });
            }
        }

        /*** Helper Functions ***/
        function adToBs(ad) {
            var parts = ad.split('-');
            var adYear = parseInt(parts[0]);
            var adMonth = parseInt(parts[1]);
            var adDay = parseInt(parts[2]);
            var bsDate = calendarFunctions.getBsDateByAdDate(adYear, adMonth, adDay);
            var fullDate = bsDate.bsYear + '-' + String(bsDate.bsMonth).padStart(2, '0') + '-' + String(bsDate.bsDate)
                .padStart(2,
                    '0');

            var toNepaliNumber = convertEnglishToNepaliNumbers(fullDate);
            return toNepaliNumber;
        }

        function bsToAd(bs) {
            var parts = bs.split('-');
            var bsYear = parseInt(calendarFunctions.getNumberByNepaliNumber(parts[0]));
            var bsMonth = parseInt(calendarFunctions.getNumberByNepaliNumber(parts[1]));
            var bsDate = parseInt(calendarFunctions.getNumberByNepaliNumber(parts[2]));
            var adDate = calendarFunctions.getAdDateByBsDate(bsYear, bsMonth, bsDate);
            return adDate.getFullYear() + '-' + String(adDate.getMonth() + 1).padStart(2, '0') + '-' + String(adDate
                .getDate()).padStart(2, '0');
        }

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
    </script>
@endpush
