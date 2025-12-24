@extends('backend.layouts.app')

@section('title')
    Create Faculty
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    @include('backend.faculty.partials.faculty', ['method' => 'post'])
@endsection
