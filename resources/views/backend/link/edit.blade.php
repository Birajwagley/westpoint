@extends('backend.layouts.app')

@section('title')
    Update Link
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('link.update', $link->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        @include('backend.link.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('link.index') }}" />
        </div>
    </form>
@endsection
