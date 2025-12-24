@extends('backend.layouts.app')

@section('title')
    Academic Level
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

        <!-- Add Button -->
        <x-buttons.form-create-button route="{{ route('academic-level.create') }}" name="Academic Level " permission="academic level" />
    </div>
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@section('content')
    <table id="academicLevelTable" class="display" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th>S.N</th>
                <th>Name</th>
                <th>Thumbnail Image</th>
                <th>Is Published</th>
                <th>Is Featured</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            {{-- Data will be injected by DataTables --}}
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.academic-level.partials.scripts')
@endsection
