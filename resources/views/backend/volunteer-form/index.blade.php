@extends('backend.layouts.app')

@section('title')
    Volunteer Form
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

        <!-- Add Button -->
        {{-- <x-buttons.form-create-button route="{{ route('volunteer-form.create') }}" name="Volunteer Form"
            permission="volunteer form" /> --}}
    </div>
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@section('content')
    <table id="volunteerFormTable" class="display" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th>S.N</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Nationality</th>
                <th>Contact Number</th>
                <th>Current Address</th>
                <th>Is Scanned?</th>
                <th>Is Short Listed?</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            {{-- Data will be injected by DataTables --}}
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.volunteer-form.partials.scripts')
@endsection
