@extends('backend.layouts.app')

@section('title')
    View Job Application
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    <form action="{{ route('job-application.update', $jobApplication->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        @include('backend.jobApplication.partials.view-form')

        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('job-application.index') }}" />
        </div>

    </form>
@endsection
