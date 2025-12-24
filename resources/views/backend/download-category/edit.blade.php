@extends('backend.layouts.app')

@section('title')
    Edit Download Category
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('download-category.update', $downloadCategory->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')


        @include('backend.download-category.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('download-category.index') }}" />
        </div>
    </form>
@endsection
