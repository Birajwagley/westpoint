@extends('backend.layouts.app')

@section('title')
    Create Page
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('backend.page.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Save" />
            <x-buttons.form-cancel-button href="{{ route('page.index') }}" />
        </div>
    </form>
@endsection
