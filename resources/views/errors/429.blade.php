@extends('errors::custom')

@section('title', __('Too Many Requests'))

@section('code')
    @include('errors.error', [
        'code' => '429',
        'message' => 'Too Many Requests',
        'description' => 'You have exceeded the allowable request limit. Kindly wait and retry.',
    ])
@endsection
