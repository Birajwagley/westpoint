@extends('backend.layouts.app')

@section('title')
    Create Alumni Form
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('alumni-form.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('backend.alumni-form.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Save" />
            <x-buttons.form-cancel-button href="{{ route('alumni-form.index') }}" />
        </div>


    </form>
@endsection
