@extends('backend.layouts.app')

@section('title')
    Edit Academic Level
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('academic-level.update', $academicLevel->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')


        @include('backend.academic-level.partials.form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('academic-level.index') }}" />
        </div>
    </form>
@endsection
