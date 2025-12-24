@extends('backend.layouts.app')

@section('title')
    All Subscription
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

        <!-- Add Button -->
        <x-buttons.form-create-button route="{{ route('subscription.create') }}" permission="subscription" />
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

        <form action="{{ route('subscription.excel-export') }}" method="GET" id="excelExportForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                <!-- Is Active -->
                <x-fields.boolean-field label="Is Active?" :data="old('is_active')" fieldName="is_active" :required=false />

                {{-- Buttons --}}
                <x-buttons.export-button />
            </div>
        </form>
    </fieldset>

    <table id="subscriptionTable" class="display table-auto" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th>S.N</th>
                <th>Email</th>
                <th>Is Active?</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            {{-- Data will be injected by DataTables --}}
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.subscription.partials.scripts')
@endsection
