@extends('backend.layouts.app')

@section('title')
    Create Drawer Navigation
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('drawer-navigation.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('backend.drawer-navigation.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Save" />
            <x-buttons.form-cancel-button href="{{ route('drawer-navigation.index') }}" />
        </div>
    </form>
@endsection
