@extends('backend.layouts.app')

@section('title')
    View Admission
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-6">

        <!-- ================= PERSONAL DETAILS ================= -->
        <div>
            <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                Personal Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Student Photo -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-semibold text-black">
                        Student Photo <span class="text-red-600">*</span>
                    </label>

                    @if ($admission->photo)
                        <a href="{{ asset($admission->photo) }}" target="_blank">
                            <img src="{{ asset($admission->photo) }}" class="w-32 h-32 object-cover border rounded-lg">
                        </a>
                    @else
                        <span class="text-gray-500">No student photo uploaded</span>
                    @endif
                </div>

                <div>
                    <label class="text-sm font-semibold">First Name</label>
                    <p>{{ $admission->first_name ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Middle Name</label>
                    <p>{{ $admission->middle_name ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Last Name</label>
                    <p>{{ $admission->last_name ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <p>{{ $admission->email ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">DOB (AD)</label>
                    <p>{{ $admission->dob_ad ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">DOB (BS)</label>
                    <p>{{ $admission->dob_bs ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Age</label>
                    <p>{{ $admission->age ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Gender</label>
                    <p id="gender">{{ $admission->gender ?? '' }}</p>
                </div>

                <div id="otherGenderField">
                    <label class="text-sm font-semibold">Other Gender</label>

                    <p id="other_gender">
                        {{ $admission->other_gender ?? '' }}
                    </p>
                </div>

            </div>
        </div>

        <!-- ================= CONTACT DETAILS ================= -->
        <div>
            <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                Contact Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-semibold">Permanent Address</label>
                    <p>{{ $admission->permanent_address ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Current Address</label>
                    <p>{{ $admission->current_address ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Nationality</label>
                    <p>{{ $admission->nationality ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Contact Number</label>
                    <p>{{ $admission->contact_no ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- ================= ACADEMIC DETAILS ================= -->
        <div>
            <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                Academic Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-semibold">Academic Year</label>
                    <p>{{ $admission->academic_year ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Previous School</label>
                    <p>{{ $admission->previous_school ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">School Address</label>
                    <p>{{ $admission->previous_school_address ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Academic Level</label>
                    <p>{{ $admission->academicLevel->name_en ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- ================= PARENTS / GUARDIANS ================= -->
        <div>
            <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                Parents / Guardians
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Living with Guardian --}}
                <div>
                    <label class="text-sm font-semibold">Living With Guardian</label>
                    <p>{{ $admission->living_with_guardian ? 'Yes' : 'No' }}</p>
                </div>

                {{-- Parents / Guardians --}}
                @forelse ($admission->parents as $parent)
                    <div>
                        <label class="text-sm font-semibold">
                            {{ ucfirst($parent->relation) }} Name
                        </label>
                        <p>{{ $parent->name ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">
                            {{ ucfirst($parent->relation) }} Occupation
                        </label>
                        <p>{{ $parent->occupation ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">
                            {{ ucfirst($parent->relation) }} Contact
                        </label>
                        <p>{{ $parent->contact_no ?? '-' }}</p>
                    </div>
                @empty
                    <div class="col-span-3 text-gray-500">
                        No parent / guardian details available.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ================= SCHOOL INFO ================= -->
        @if ($admission->is_school == 1)
            <div>
                <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                    School Info
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Admission Type</label>
                        <p>{{ $admission->school->admission_type ?? '' }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Class</label>
                        <p>{{ $admission->school->class->name_en ?? '' }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Last Class</label>
                        <p>{{ $admission->school->lastClass->name_en ?? '' }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- ================= +2 Level School Info ================= -->
        @if ($admission->is_school == 0)
            <div>
                <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                    +2 Level School Info
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Faculty</label>
                        <p>{{ $admission->college->faculty->name_en ?? '' }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">GPA</label>
                        <p>{{ $admission->college->gpa ?? '' }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Board</label>
                        <p>{{ $admission->college->board ?? '' }}</p>
                    </div>
                </div>
            </div>

            <!-- ================= Subjects ================= -->

            <!-- Subjects List -->
            <table class="min-w-[50vw] bg-white shadow-md rounded-lg overflow-hidden text-sm">
                <thead class="bg-primary">
                    <tr>
                        <th class="px-5 py-3 text-left text-white uppercase tracking-wider">
                            Group
                        </th>
                        <th class="px-5 py-3 text-left text-white uppercase tracking-wider">
                            Subject
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($groups as $group)
                        @php
                            $subject = $admission->subjects->first(
                                fn($subject) => $subject->groups->contains('id', $group->id),
                            );
                        @endphp

                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-5 py-4 font-medium text-gray-700">
                                {{ $group->name }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($subject)
                                    <span class="inline-block bg-primary/10 text-primary px-3 py-1 rounded-full text-xs">
                                        {{ $subject->name_en }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic">Not selected</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-5 py-4 text-center text-gray-500">
                                No subjects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif

        <!-- ================= PICK & DROP ================= -->
        <div>
            <h2 class="font-semibold text-white bg-primary p-3 rounded-md mb-4">
                Pick & Drop Facility
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-semibold">Pick & Drop Needed</label>
                    <p>{{ $admission->pick_drop_facility_needed ? 'Yes' : 'No' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Location</label>
                    <p>{{ $admission->pick_drop_location ?? '' }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold">Approval</label>
                    <p>{{ $admission->approval ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>

    </div>
@endsection


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
