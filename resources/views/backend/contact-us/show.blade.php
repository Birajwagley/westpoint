@extends('backend.layouts.app')

@section('title')
    Show Contact Us
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mb-4">
        <!-- Full Name-->
        <div>
            <label class="text-sm font-semibold text-gray-700">Full Name: </label>
            <span>{{ $contactUs->full_name }}</span>
        </div>

        <!-- contact no -->
        <div>
            <label class="text-sm font-semibold text-gray-700">Contact No. </label>
            <span>{{ $contactUs->contact_no }}</span>
        </div>

        <!-- Email -->
        <div>
            <label class="text-sm font-semibold text-gray-700">Email </label>
            <span>{{ $contactUs->email }}</span>
        </div>

        <!-- Message -->
        <div class="col-span-3">
            <label class="text-sm font-semibold text-gray-700">Customer Message </label> <br>
            {{ $contactUs->message }}
        </div>

        {{-- is contacted --}}
        <div>
            <label class="text-sm font-semibold text-gray-700">Is Contacted? </label>
            <span>{{ $contactUs->is_contacted == true ? 'Yes' : 'No' }}</span>
        </div>

        <!-- contact remarks -->
        <div class="col-span-3">
            <label class="text-sm font-semibold text-gray-700">Contact Remarks </label> <br>
            {!! $contactUs->contact_remarks !!}
        </div>
    </div>

    @if ($contactUs->is_contacted == 0)
        <hr>

        <form action="{{ route('contact-us.update', $contactUs->id) }}" method="POST" class="mt-4">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">
                {{-- is contacted --}}
                <x-fields.boolean-field label="Is Contacted?" :data="old('is_contacted', isset($contactUs) ? $contactUs->is_contacted : 1)" fieldName="is_contacted" :required=true />

                {{-- contact remarks --}}
                <x-fields.textarea-summernote-field label="Remarks" :data="old('contact_remarks', isset($contactUs) ? $contactUs->contact_remarks : null)" fieldName="contact_remarks"
                    :required=true />
            </div>

            <div class="flex mt-6 gap-2">
                <x-buttons.form-save-button type="Update" />
                <x-buttons.form-cancel-button href="{{ route('contact-us.index') }}" />
            </div>
        </form>
    @endif
@endsection
