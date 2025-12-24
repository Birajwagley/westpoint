@extends('backend.layouts.app')

@section('title')
    Job Application
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

        <!-- Add Button -->
        {{-- <x-buttons.form-create-button route="{{ route('job-application.create') }}" name="Job Application" permission="job application" /> --}}
    </div>
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@section('content')
    <fieldset class="border border-gray-300 p-2 rounded-lg shadow-sm mb-5">
        <legend class="text-lg font-semibold px-2 text-gray-700">
            Export Filter
        </legend>

        <form action="{{ route('job-application.excel-export') }}" method="GET" id="excelExportForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                {{-- Career --}}
                <div>
                    <select name="career_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary focus:border-primary">
                        <option value="all">All Career</option>
                        @foreach ($careers as $value)
                            <option value="{{ $value->id }}" {{ old('career_id') == $value->id ? 'selected' : '' }}>
                                @isset($value->name_en)
                                    {{ $value->name_en . (isset($value->name_np) ? ' | ' . $value->name_np : '') }}
                                @else
                                    {{ $value->name }}
                                @endisset
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Is Scanned -->
                <x-fields.boolean-field label="Is Scanned?" :data="old('is_scanned')" fieldName="is_scanned" :required=false />

                <!-- Is Shortlisted -->
                <x-fields.boolean-field label="Is Shortlisted?" :data="old('is_shortlisted')" fieldName="is_shortlisted"
                    :required=false />

                {{-- Buttons --}}
                <x-buttons.export-button />
            </div>
        </form>
    </fieldset>

    <div class="overflow-x-auto w-full">
        <table id="jobApplicationTable" class="display min-w-max w-full">
            <thead class="bg-gray-50">
                <tr class="{{ $trClass }}">
                    <th>S.N</th>
                    <th>Career</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Current Address</th>
                    <th>Mobile Number</th>
                    <th>CV</th>
                    <th>Is Scanned?</th>
                    <th>Is Short Listed?</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                {{-- Data will be injected by DataTables --}}
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @include('backend.jobApplication.partials.scripts')
@endsection
