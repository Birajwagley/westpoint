@extends('frontend.layouts.app')

@section('title', 'Usp Page')

@push('styles')
@endpush

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.usps_main_heading'),
        'subHeading' => __('pages.usps_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.usp'),
            'route' => route('usps'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Main Content --}}
    <div class='h-auto w-full font-poppins py-10'>
        <div class='flex flex-col items-center'>
            @include('frontend.partials.beyond-academics-card', [
                'datas' => $usps,
                'route' => 'usp-detail',
            ])
        </div>
    </div>
@endsection
