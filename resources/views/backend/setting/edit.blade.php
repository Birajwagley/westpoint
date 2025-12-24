@extends('backend.layouts.app')

@section('title')
    Edit Setting
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    @php
        $emailCount = $setting->emails != null ? count(json_decode($setting->emails)) : 0;
        $contactCount = $setting->contacts != null ? count(json_decode($setting->contacts)) : 0;
    @endphp

    <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4">
            {{-- primary logo --}}
            <x-fields.image-upload-field label="Primary Logo" :data="old('primary_logo', isset($setting) ? $setting->primary_logo : null)" fieldName="primary_logo"
                currentName="current_primary_logo" :required=true />

            {{-- secondary logo --}}
            <x-fields.image-upload-field label="Secondary Logo" :data="old('secondary_logo', isset($setting) ? $setting->secondary_logo : null)" fieldName="secondary_logo"
                currentName="current_secondary_logo" :required=true />

            {{-- experience logo --}}
            <x-fields.image-upload-field label="Experience Logo" :data="old('experience_logo', isset($setting) ? $setting->experience_logo : null)" fieldName="experience_logo"
                currentName="current_experience_logo" :required=true />

            {{-- favicon --}}
            <x-fields.image-upload-field label="Favicon" :data="old('favicon', isset($setting) ? $setting->favicon : null)" fieldName="favicon" currentName="current_favicon"
                :required=true />

            {{-- school overview image --}}
            <x-fields.image-upload-field label="School Overview Image" :data="old('school_overview_image', isset($setting) ? $setting->school_overview_image : null)" fieldName="school_overview_image"
                currentName="current_school_overview_image" :required=true />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-3">
            {{-- title en --}}
            <x-fields.text-field label="Title (English)" :data="old('title_en', isset($setting) ? $setting->title_en : null)" fieldName="title_en" :required=true />

            {{-- title np --}}
            <x-fields.text-field label="Title (Nepali)" :data="old('title_np', isset($setting) ? $setting->title_np : null)" fieldName="title_np" :required=false />

            {{-- address en --}}
            <x-fields.text-field label="Address (English)" :data="old('address_en', isset($setting) ? $setting->address_en : null)" fieldName="address_en" :required=true />

            {{-- address np --}}
            <x-fields.text-field label="Address (Nepali)" :data="old('address_np', isset($setting) ? $setting->address_np : null)" fieldName="address_np" :required=false />

            {{-- admission notify email --}}
            <x-fields.text-field label="Admission Notify Email" :data="old('admission_notify_email', isset($setting) ? $setting->admission_notify_email : null)" fieldName="admission_notify_email"
                :required=true />

            {{-- career notify email --}}
            <x-fields.text-field label="Career Notify Email" :data="old('career_notify_email', isset($setting) ? $setting->career_notify_email : null)" fieldName="career_notify_email"
                :required=true />

            {{-- volunteer Notify Email --}}
            <x-fields.text-field label="Volunteer Notify Email" :data="old('volunteer_notify_email', isset($setting) ? $setting->volunteer_notify_email : null)" fieldName="volunteer_notify_email"
                :required=true />

            {{-- feedback Notify Email --}}
            <x-fields.text-field label="Feedback Notify Email" :data="old('feedback_notify_email', isset($setting) ? $setting->feedback_notify_email : null)" fieldName="feedback_notify_email"
                :required=true />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-3">
            {{-- multi email --}}
            <div>
                <fieldset class="border mb-3 p-3">
                    <legend class="float-none w-auto font-weight-bold">Emails <span class="text-red-600">*</span></legend>

                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    <table class="display table-auto" width="100%" id="emailTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="emailTableBody">
                            @if (old('emails'))
                                @foreach ((array) old('emails') as $key => $old)
                                    @include('backend.setting.partials.emails', [
                                        'index' => $loop->index,
                                    ])
                                @endforeach
                            @elseif($setting->emails)
                                @foreach (json_decode($setting->emails) as $email)
                                    @include('backend.setting.partials.emails', [
                                        'index' => $loop->index,
                                        'data' => $email,
                                    ])
                                @endforeach
                            @else
                                @include('backend.setting.partials.emails', [
                                    'index' => 0,
                                ])
                            @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right mt-2">
                                    <button type="button"
                                        class="mt-3 px-2 py-2 rounded-lg shadow-sm font-semibold text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        id="add-emails-btn">
                                        <i class="fa fa-plus"></i> &nbsp;Add Email
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </fieldset>
            </div>

            {{-- multi contact --}}
            <div>
                <fieldset class="border mb-3 p-3">
                    <legend class="float-none w-auto font-weight-bold">Contacts <span class="text-red-600">*</span></legend>

                    @error('contact')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    <table class="display table-auto" width="100%" id="contactTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="contactTableBody">
                            @if (old('contacts'))
                                @foreach ((array) old('contacts') as $key => $old)
                                    @include('backend.setting.partials.contacts', [
                                        'index' => $loop->index,
                                    ])
                                @endforeach
                            @elseif($setting->contacts)
                                @foreach (json_decode($setting->contacts) as $contact)
                                    @include('backend.setting.partials.contacts', [
                                        'index' => $loop->index,
                                        'data' => $contact,
                                    ])
                                @endforeach
                            @else
                                @include('backend.setting.partials.contacts', [
                                    'index' => 0,
                                ])
                            @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right mt-2">
                                    <button type="button"
                                        class="mt-3 px-2 py-2 rounded-lg shadow-sm font-semibold text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        id="add-contacts-btn">
                                        <i class="fa fa-plus"></i> &nbsp;Add Contact
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </fieldset>
            </div>

            {{-- map --}}
            <x-fields.text-field label="Map" :data="old('map', isset($setting) ? $setting->map : null)" fieldName="map" :required=true />

            {{-- facebook --}}
            <x-fields.text-field label="Facebook" :data="old('facebook', isset($setting) ? $setting->facebook : null)" fieldName="facebook" :required=true />

            {{-- instagram --}}
            <x-fields.text-field label="Instagram" :data="old('instagram', isset($setting) ? $setting->instagram : null)" fieldName="instagram" :required=true />

            {{-- linkedin --}}
            <x-fields.text-field label="Linkedin" :data="old('linkedin', isset($setting) ? $setting->linkedin : null)" fieldName="linkedin" :required=true />

            {{-- x --}}
            <x-fields.text-field label="X" :data="old('x', isset($setting) ? $setting->x : null)" fieldName="x" :required=false />

            {{-- youtube --}}
            <x-fields.text-field label="Youtube" :data="old('youtube', isset($setting) ? $setting->youtube : null)" fieldName="youtube" :required=true />

            {{-- youtube video --}}
            <x-fields.text-field label="Youtube Video" :data="old('youtube_video', isset($setting) ? $setting->youtube_video : null)" fieldName="youtube_video" :required=true />

            {{-- schema markup --}}
            <x-fields.text-field label="Schema Markup" :data="old('schema_markup', isset($setting) ? $setting->schema_markup : null)" fieldName="schema_markup" :required=false />

            {{-- canonical url --}}
            <x-fields.text-field label="Canonical Url" :data="old('canonical_url', isset($setting) ? $setting->canonical_url : null)" fieldName="canonical_url" :required=false />

            {{-- keyword --}}
            <x-fields.text-field label="Keyword" :data="old('keyword', isset($setting) ? $setting->keyword : null)" fieldName="keyword" :required=false />

            {{-- School Hour en --}}
            <x-fields.textarea-summernote-field label="School Hour (English)" :data="old('school_hour_en', isset($setting) ? $setting->school_hour_en : null)" fieldName="school_hour_en"
                :required=false />

            {{-- School Hour np --}}
            <x-fields.textarea-summernote-field label="School Hour (Nepali)" :data="old('school_hour_np', isset($setting) ? $setting->school_hour_np : null)" fieldName="school_hour_np"
                :required=false />

            {{-- description en --}}
            <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', isset($setting) ? $setting->description_en : null)" fieldName="description_en"
                :required=false />

            {{-- description np --}}
            <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', isset($setting) ? $setting->description_np : null)" fieldName="description_np"
                :required=false />
        </div>

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('setting.edit') }}" />
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            checkRowNumber('email-remove');
            checkRowNumber('contact-remove');
        });
        $('.image').on('change', function() {
            fieldId = $(this).attr('id');

            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });

        emailsCount = {{ isset($emailCount) ? $emailCount - 1 : 0 }};
        $(document).on('click', '#add-emails-btn', function() {
            emailsCount = emailsCount + 1;

            $.ajax({
                type: "GET",
                url: "{{ route('setting.emails') }}",
                data: {
                    type: 'en',
                },
                success: function(response) {
                    $('#emailTableBody').append(response);
                }
            });
            checkRowNumber('email-remove');
        });

        $(document).on("click", ".email-remove", function() {
            $(this).closest("tr").remove();

            checkRowNumber('email-remove');
        });

        contactsCount = {{ isset($contactCount) ? $contactCount - 1 : 0 }};
        $(document).on('click', '#add-contacts-btn', function() {
            contactsCount = contactsCount + 1;

            $.ajax({
                type: "GET",
                url: "{{ route('setting.contacts') }}",
                data: {
                    type: 'en',
                },
                success: function(response) {
                    $('#contactTableBody').append(response);
                }
            });

            checkRowNumber('contact-remove');
        });

        $(document).on("click", ".contact-remove", function() {
            $(this).closest("tr").remove();

            checkRowNumber('contact-remove');
        });

        function checkRowNumber(field) {
            if ($('.' + field).length === 1) {
                $('.' + field).hide();
            }
        }
    </script>
@endpush
