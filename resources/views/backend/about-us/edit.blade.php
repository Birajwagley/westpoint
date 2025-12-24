@extends('backend.layouts.app')

@section('title')
    About Us
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    @include('backend.about-us.partials.form')
@endsection
