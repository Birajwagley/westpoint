@extends('backend.layouts.app')

@section('title')
    Permissions
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@section('content')
    <table id="permissionTable" class="display" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th class="w-16">S.N</th>
                <th>Name</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            {{-- DataTables will populate --}}
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.permission.partials.scripts')
@endsection
