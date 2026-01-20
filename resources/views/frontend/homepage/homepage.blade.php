@extends('frontend.layouts.app')

@section('title', 'Home')

@push('styles')
    @include('frontend.homepage.partials.styles')
@endpush

@section('content')
    {{-- Slider --}}
    @include('frontend.homepage.partials.video')



    {{-- Quick Navigation --}}
    @include('frontend.homepage.partials.quick-navigation')

    {{-- Acadmic Level --}}
    @include('frontend.homepage.partials.academic-level')

    <!-- Introduction Section -->
    @include('frontend.homepage.partials.introduction')

    {{-- About Us --}}
    @include('frontend.homepage.partials.about-us', [
        'displayButton' => true,
        'isHome' => true,
    ])

    <!-- Why Choose Us -->
    @include('frontend.homepage.partials.why-choose-us')


    {{-- Slider --}}
    {{-- @include('frontend.homepage.partials.slider') --}}

    {{-- Academic Excellence --}}
    @include('frontend.homepage.partials.academic-excellence')

    <!-- Upcoming Events -->
    @include('frontend.homepage.partials.upcomming-events')

    {{-- Testimonials --}}
    @include('frontend.homepage.partials.testimonials')

    {{-- Gallery --}}
    {{-- @include('frontend.homepage.partials.gallery') --}}

        <!-- Gallery Section -->
    @include('frontend.homepage.partials.gallery-design')

    <!-- Achievements -->
    {{-- @include('frontend.homepage.partials.achivements') --}}

    {{-- volunteers --}}
    {{-- @include('frontend.homepage.partials.volunteers') --}}

    <!-- Popups -->
    @include('frontend.homepage.partials.popup')

@endsection

@push('scripts')
    @include('frontend.homepage.partials.scripts')
@endpush
