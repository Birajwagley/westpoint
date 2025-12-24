@extends('errors::custom')

@section('title', __('Page Expired'))

@section('code')
    @include('errors.error', [
        'code' => '419',
        'message' => 'Page Expired',
        'description' => 'For security reasons, your session has timed out. Please reload the page.',
    ])
@endsection
