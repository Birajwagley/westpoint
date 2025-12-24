@extends('errors::custom')

@section('title', __('Forbidden'))

@section('code')
    @include('errors.error', [
        'code' => '403',
        'message' => 'Forbidden',
        'description' =>
            'You are not authorized to access this page. If you believe this is an error, please contact support.',
    ])
@endsection
