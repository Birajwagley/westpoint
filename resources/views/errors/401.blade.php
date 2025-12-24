@extends('errors::custom')

@section('title', __('Unauthorized'))

@section('code')
    @include('errors.error', [
        'code' => '401',
        'message' => 'Unauthorized',
        'description' =>
            'You are not authorized to access this page. If you believe this is an error, please contact support.',
    ])
@endsection
