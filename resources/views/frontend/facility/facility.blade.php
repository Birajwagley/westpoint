@extends('frontend.layouts.app')

@section('title', 'Facilities')

@push('styles')
@endpush

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.facility_main_heading'),
        'subHeading' => __('pages.facility_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.facility'),
            'route' => route('about-us'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Main Content --}}
    <div class='h-auto w-full font-poppins py-10'>
        <div class='flex flex-col items-center'>
            @include('frontend.partials.beyond-academics-card', [
                'datas' => $facilities,
                'route' => 'facility-detail',
            ])
        </div>
    </div>
@endsection
