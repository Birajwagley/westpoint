@extends('frontend.layouts.app')

@section('title', 'Club Page')

@push('styles')
@endpush

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.clubs_main_heading'),
        'subHeading' => __('pages.clubs_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.clubs'),
            'route' => route('clubs'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Main Content --}}
    <div class='h-auto w-full font-poppins py-10'>
        <div class='flex flex-col items-center'>
            @include('frontend.partials.beyond-academics-card', [
                'datas' => $clubs,
                'route' => 'club-detail',
            ])
        </div>
    </div>
@endsection
