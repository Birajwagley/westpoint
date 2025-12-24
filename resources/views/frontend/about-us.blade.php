@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')
    @php
        use Carbon\Carbon;
        use App\Helpers\Helper;
    @endphp

    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => app()->getLocale() == 'en' ? 'Experience the Difference' : 'फरकपनको अनुभव गर्नुहोस्',
        'subHeading' =>
            app()->getLocale() == 'en'
                ? 'Join us and start your journey today.'
                : 'आजै हाम्रो यात्रा सुरु गर्नुहोस्।',
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.school_profile'),
            'route' => route('about-us'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <!-- ============================= -->
    <!-- 📘 About Us Section -->
    <!-- ============================= -->
    @include('frontend.homepage.partials.about-us', ['displayButton' => false, 'isHome' => false])

    <!-- Navigation Section -->
    <div class="flex flex-col gap-10 px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 my-5 ">
        <!-- Navigation Section -->
        <section class="relative">
            <!-- Container for section header and navigation -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-20">
                <div class="max-w-4xl mx-auto flex flex-col items-center">
                    <!-- Section Header -->
                    <div class="text-center mb-12">
                        <h3 class="text-primary text-lg sm:text-xl font-bold uppercase tracking-wide">
                            {{ __('aboutUs.know_more') }}</h3>
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-dark leading-tight">
                            {!! __('aboutUs.our_journey_throuth_the_years') !!}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- Slider Content -->
            <div class="overflow-x-auto w-full px-2 md:px-4 mt-5 scrollbar-hide">
                <div id="navigation-slider-content"
                    class="flex gap-4 md:gap-6 transition-transform duration-500 ease-in-out whitespace-nowrap justify-start sm:justify-center">
                    @foreach ($cards as $card)
                        <div
                            class="navigation-review-card flex-none w-[320px] sm:w-[320px] md:w-[320px] lg:w-[360px] bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 group p-5 flex flex-col justify-between min-h-[420px]">
                            <div class="flex justify-center items-center h-[240px] w-full mb-4">
                                <img src="{{ asset($card->image) }}" alt="Online Banking"
                                    class="h-full w-full object-cover rounded-lg" />
                            </div>
                            <h3 class="text-base sm:text-lg font-semibold text-left sm:text-center text-gray-800">
                                {{ app()->getLocale() == 'en' ? $card->name_en : $card->name_np ?? $card->name_en }}
                            </h3>
                            <p class="text-sm text-left sm:text-center text-gray-600 mt-2 line-clamp-4">
                                {{ app()->getLocale() == 'en' ? $card->short_description_en : $card->short_description_np ?? $card->short_description_en }}
                            </p>
                            <div class="mt-4 flex justify-start sm:justify-center">
                                <a href="{{ $card->link }}" target="__blank"
                                    class="px-4 py-2 rounded-full bg-primary text-white font-medium text-sm hover:opacity-90 transition">
                                    Read more
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
                class="flex justify-center items-center gap-3 mt-8 w-fit mx-auto bg-white/80 backdrop-blur-md border border-gray-200 shadow-md rounded-full p-2">
                <button onclick="prevNavigationSlider()" aria-label="Previous slide"
                    class="group p-2 rounded-full transition-all duration-200 hover:bg-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-accent">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-accent" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="nextNavigationSlider()" aria-label="Next slide"
                    class="group p-2 rounded-full transition-all duration-200 hover:bg-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-accent">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-accent" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </section>
    </div>
    <!-- Navigation Section -->

    <section class="bg-primary text-white body-font py-16">
        <!-- Mission Section -->
        <div class="container mx-auto flex flex-col-reverse md:flex-row items-center gap-10 md:gap-16 px-4 md:px-8 mb-16">
            <!-- Text Content -->
            <div class="flex-1 flex flex-col text-center md:text-left animate-fadeIn">
                <!-- Title -->
                <div class="flex items-center justify-center md:justify-start gap-3 mb-6">
                    <h2 class="text-3xl sm:text-4xl font-heading font-semibold text-white">
                        {{ __('aboutUs.mission') }}
                    </h2>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-8 h-8 sm:w-10 sm:h-10"
                        fill="none">
                        <style>
                            .st0 {
                                fill: none;
                                stroke: white;
                                stroke-width: 2;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                stroke-miterlimit: 10;
                            }
                        </style>
                        <g>
                            <line class="st0" x1="16" y1="16" x2="22" y2="10"></line>
                            <polygon class="st0" points="30,6 26,6 26,2 22,6 22,10 26,10 "></polygon>
                            <circle class="st0" cx="16" cy="16" r="6"></circle>
                            <path class="st0"
                                d="M27,9c1.3,2,2,4.4,2,7c0,7.2-5.8,13-13,13S3,23.2,3,16S8.8,3,16,3c2.6,0,5,0.7,7,2"></path>
                        </g>
                    </svg>
                </div>

                <!-- Paragraph -->
                <p class="text-base sm:text-lg leading-relaxed mb-6 text-white">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en' ? $aboutUs->mission_en : $aboutUs->mission_np ?? $aboutUs->mission_en,
                    ) !!}
                </p>
            </div>

            <!-- Image -->
            <div class="flex-1 w-full">
                <img src="https://res.cloudinary.com/dj3qdir59/image/upload/v1644157136/large_laptoptest_0d41cb2dca.jpg"
                    alt="Mission Image"
                    class="w-full h-auto object-cover rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300">
            </div>
        </div>

        <!-- Vision Section -->
        <div class="container mx-auto flex flex-col md:flex-row items-center gap-10 md:gap-16 px-4 md:px-8">
            <!-- Image -->
            <div class="flex-1 w-full">
                <img src="https://res.cloudinary.com/dj3qdir59/image/upload/v1644157136/large_laptoptest_0d41cb2dca.jpg"
                    alt="Vision Image"
                    class="w-full h-auto object-cover rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300">
            </div>

            <!-- Text Content -->
            <div class="flex-1 flex flex-col text-center md:text-left animate-fadeIn">
                <!-- Title -->
                <div class="flex items-center justify-center md:justify-start gap-3 mb-6">
                    <h2 class="text-3xl sm:text-4xl font-heading font-semibold text-white">
                        {{ __('aboutUs.vision') }}
                    </h2>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-45.5 -45.5 546 546" class="w-8 h-8 sm:w-10 sm:h-10"
                        fill="#ffff" stroke="#ffff" stroke-width="0.00455">
                        <g>
                            <polygon
                                points="332.707,322.265 274.968,363.853 227.495,329.659 180.027,363.854 122.29,322.262 0,454.397 455,454.397">
                            </polygon>
                            <polygon
                                points="212.5,224.789 142.82,300.078 180.027,326.881 227.493,292.686 274.968,326.882 312.175,300.081 242.5,224.801 242.5,0.603 104.54,0.603 104.54,101.86 212.5,101.86">
                            </polygon>
                        </g>
                    </svg>
                </div>

                <!-- Paragraph -->
                <p class="text-base sm:text-lg leading-relaxed mb-6 text-white">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en' ? $aboutUs->vision_en : $aboutUs->vision_np ?? $aboutUs->vision_en,
                    ) !!}
                </p>
            </div>
        </div>
    </section>


    <!-- ============================= -->
    <!-- 🕒 Chronology Section -->
    <!-- ============================= -->
    <section class="relative bg-slate-50 py-20 font-inter antialiased">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">
            <div class="text-center mb-12">
                <h3 class="text-primary text-lg sm:text-xl font-bold uppercase tracking-wide">
                    {{ __('aboutUs.chronology') }}</h3>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-dark leading-tight">
                    {!! __('aboutUs.our_journey_throuth_the_years') !!}
                </h2>
            </div>

            <div class="w-full max-w-6xl mx-auto">
                <div class="-my-6">
                    @foreach ($cronologies as $cronology)
                        <div class="relative pl-8 sm:pl-32 py-6 group">
                            <div class="font-caveat font-medium text-2xl text-primary mb-1 sm:mb-0">
                                {{ app()->getLocale() == 'en' ? $cronology->name_en : $cronology->name_np ?? $cronology->name_en }}
                            </div>

                            <div
                                class="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px before:bg-secondary
                                    sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3 after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-primary
                                    after:border-4 after:box-content after:border-slate-50 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                                <time
                                    class="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-7 mb-3 sm:mb-0 text-white bg-secondary
                                    rounded-full">
                                    {{ app()->getLocale() == 'en' ? $cronology->date_en . ' A.D.' : $cronology->date_np . ' वि.सं.' ?? $cronology->date_en . ' A.D.' }}
                                </time>
                            </div>

                            <div class="text-slate-500">
                                {!! Helper::stripInlineStyle(
                                    app()->getLocale() == 'en' ? $cronology->description_en : $cronology->description_np ?? $cronology->description_en,
                                ) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>

    <section class="w-full px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- YouTube Video -->
            <div class="w-full aspect-video rounded-xl overflow-hidden shadow-md">
                <iframe class="w-full h-full" src="{{ $setting->youtube_video }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>

            <!-- Google Map -->
            <div class="w-full aspect-video rounded-xl overflow-hidden shadow-md">
                <iframe src="{{ $setting->map }}"
                    class="w-full h-[350px] sm:h-[400px] md:h-[450px] rounded-xl border-0 shadow-md" allowfullscreen
                    loading="lazy"></iframe>

            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        // Navigation slider functionality
        let navigationCurrentSlide = 0;
        const navigationSliderContent = document.getElementById('navigation-slider-content');
        const navigationCards = document.querySelectorAll('.navigation-review-card');
        const navigationCardWidth = navigationCards.length > 0 ? navigationCards[0].offsetWidth + 32 : 400; // width + gap
        const navigationMaxSlide = Math.max(0, navigationCards.length - 3); // Show 3 items at once on desktop

        function nextNavigationSlider() {
            if (navigationCurrentSlide < navigationMaxSlide) {
                navigationCurrentSlide++;
                updateNavigationSliderPosition();
            }
        }

        function prevNavigationSlider() {
            if (navigationCurrentSlide > 0) {
                navigationCurrentSlide--;
                updateNavigationSliderPosition();
            }
        }

        function updateNavigationSliderPosition() {
            const position = -navigationCurrentSlide * navigationCardWidth;
            navigationSliderContent.style.transform = `translateX(${position}px)`;
        }

        // Initialize slider positions on page load
        window.addEventListener('load', function() {
            if (navigationSliderContent && navigationCards.length > 0) {
                updateNavigationSliderPosition();
            }
        });
    </script>
@endpush
