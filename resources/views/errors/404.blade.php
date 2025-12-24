@extends('errors::custom')

@section('title', __('Not Found'))

@section('code')
    @include('errors.error', [
        'code' => '404',
        'message' => 'Page does not exist',
        'description' =>
            'Maybe you got a broken link, or maybe you made a misprint in the address bar. Try to start all over again in the main sections.',
    ])
@endsection
