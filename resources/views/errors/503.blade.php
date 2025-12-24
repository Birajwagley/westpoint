@extends('errors::custom')

@section('title', __('Service Unavailable'))

@section('code')
    @include('errors.error', [
        'code' => '503',
        'message' => 'Service Unavailable',
        'description' => 'The server is temporarily unable to handle your request. Please try again later.',
    ])
@endsection
