@extends('backend.layouts.app')

@section('title')
    Roles
@endsection

@section('headerWithButton')
    {{-- title --}}
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

    <!-- Add Button -->
    <x-buttons.form-create-button route="{{ route('role.create') }}" permission="role" />
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@section('content')
    <table id="roleTable" class="display table-auto" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th class="w-16">
                    S.N</th>
                <th>Name
                </th>
                <th>
                    Permissions</th>
                <th class="w-20">
                    Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            {{-- DataTables will populate --}}
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.role.partials.scripts')
@endsection
