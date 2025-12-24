@extends('backend.layouts.app')

@section('title')
    Award/ Achivements
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

        <!-- Add Button -->
        <x-buttons.form-create-button route="{{ route('award-recognition.create') }}" name="Award & Achivements"
            permission="award & achivements" />
    </div>
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@section('content')
    <table id="awardRecognitionTable" class="display" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th>S.N</th>
                <th>Title</th>
                <th>Display Order</th>
                <th>Is Featured</th>
                <th>Is Published</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            {{-- Data will be injected by DataTables --}}
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.award-recognition.partials.scripts')
@endsection
