@extends('backend.layouts.app')

@section('title')
    Create Career
@endsection

@section('headerWithButton')
    {{-- title --}}
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('career.update', $career->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('backend.career.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('career.index') }}" />
        </div>
    </form>
@endsection
