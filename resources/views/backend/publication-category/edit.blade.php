@extends('backend.layouts.app')

@section('title')
    Create Publication Category
@endsection

@section('headerWithButton')
    {{-- title --}}
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('publication-category.update', $publicationCategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('backend.publication-category.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('publication-category.index') }}" />
        </div>
    </form>
@endsection
