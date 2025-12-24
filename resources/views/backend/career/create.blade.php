@extends('backend.layouts.app')

@section('title')
    Create Career
@endsection

@section('headerWithButton')
    {{-- title --}}
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('backend.career.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Save" />
            <x-buttons.form-cancel-button href="{{ route('career.index') }}" />
        </div>
    </form>
@endsection
