@extends('errors::custom')

@section('title', __('Server Error'))

@section('code')
    @include('errors.error', [
        'code' => '500',
        'message' => 'Server Error',
        'description' => 'Our system encountered an internal problem. We appreciate your patience.',
    ])
@endsection
