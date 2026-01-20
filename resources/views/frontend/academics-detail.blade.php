@extends('frontend.layouts.app')

@section('title', $academicLevel->name_en)

@section('styles')
    <style>
        /* Infinite Marquee */
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .marquee-wrapper {
            display: flex;
            overflow: hidden;
            width: 100%;
        }

        .marquee-row {
            display: flex;
            min-width: max-content;
        }

        .animate-marquee {
            animation: marquee 40s linear infinite;
        }

        .marquee-wrapper:hover .animate-marquee,
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
@endsection

@php
    use App\Helpers\Helper;

    $name =
        app()->getLocale() == 'en'
            ? $academicLevel->name_en
            : (isset($academicLevel->name_np)
                ? $academicLevel->name_np
                : $academicLevel->name_en);

    $images = $academicLevel->images ? json_decode($academicLevel->images) : [];
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => $name,
        'subHeading' =>
            app()->getLocale() == 'en'
                ? $academicLevel->tagline_en
                : (isset($academicLevel->tagline_np)
                    ? $academicLevel->tagline_np
                    : $academicLevel->tagline_en),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.academic_levels'),
            'route' => route('academics'),
        ],
        'breadcrumb3' => [
            'name' => $name,
            'route' => route('academics-detail', $academicLevel->slug),
            'class' => 'text-gray-400',
        ],
        'breadcrumb4' => null,
    ])

    <!-- ============================= -->
    <!-- 📘 Intro Section -->
    <!-- ============================= -->
    <div
        class="container mx-auto px-4 flex flex-col-reverse lg:flex-row items-center justify-between gap-10 lg:gap-16 my-20">
        <div class=" w-full md:w-1/2 flex justify-center items-center">
            <img src="{{ asset($academicLevel->thumbnail_image) }}" alt="WPHS"
                class=" top-0 left-0 w-[200px] sm:w-[600px] h-auto rounded-2xl shadow-lg object-cover transform transition duration-300">
        </div>

        <div class="flex flex-col items-center lg:items-start text-center lg:text-left max-w-2xl space-y-5">
            <h3 class="text-primary text-lg sm:text-xl font-bold uppercase tracking-wide">
                {{ app()->getLocale() == 'en'
                    ? $academicLevel->name_en
                    : (isset($academicLevel->name_np)
                        ? $academicLevel->name_np
                        : $academicLevel->name_en) }}
            </h3>

            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
                @php
                    $text =
                        app()->getLocale() == 'en'
                            ? $academicLevel->tagline_en
                            : (isset($academicLevel->tagline_np)
                                ? $academicLevel->tagline_np
                                : $academicLevel->tagline_en);

                    $words = explode(' ', $text);
                    $lastTwo = array_splice($words, -2);
                @endphp


                {{ implode(' ', $words) }} <span class="text-secondary">{{ implode(' ', $lastTwo) }}</span>
            </h2>

            <div class="text-base sm:text-lg text-gray-600 leading-relaxed text-justify">
                {!! Helper::stripInlineStyle(
                    app()->getLocale() === 'en'
                        ? $academicLevel->description_en
                        : $academicLevel->description_np ?? $academicLevel->description_en,
                ) !!}
            </div>
        </div>
    </div>

    {{-- image scroll section --}}
    @if ($images)
        <section class="flex flex-col my-20">
            <div class="relative w-full overflow-hidden">
                <!-- Infinite Scroll -->
                <div class="marquee-wrapper">
                    <div class="marquee-row animate-marquee gap-10">
                        @foreach ($images as $image)
                            <div class="flex flex-col items-center">
                                <img src="{{ asset($image) }}" class="h-40 rounded-xl shadow-md object-contain"
                                    alt="WPHS">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- --------------------Why Section---------------------------- -->
    <section class="relative py-12 z-0 bg-primary">
        <div class="absolute top-8 left-8 w-12 h-12 bg-white/20 rounded-full animate-pulse-slow"></div>
        <div class="absolute top-24 left-16 w-8 h-8 bg-white/20 rounded-full animate-pulse-slow delay-200"></div>

        <div class="absolute bottom-8 right-8 w-16 h-16 bg-white/20 rounded-full animate-pulse-slow delay-400"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-[#FFFFFF] sm:text-4xl mb-20">
                {{ __('pages.our') . ' ' . $name . ' ' . __('pages.programs') }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 text-left">
                @foreach ($academicLevel->classes as $class)
                    <div class="flex flex-col bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow-xl h-full">
                        <div class="flex items-center mb-4 space-x-4">
                            <div class="w-16 h-16 rounded-xl bg-accent flex items-center justify-center shadow">
                                <i class="fa {{ $class->icon ?? 'fa-book' }} text-3xl text-primary"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-white">
                                {{ app()->getLocale() == 'en' ? $class->name_en : (isset($class->name_np) ? $class->name_np : $class->name_en) }}
                            </h3>
                        </div>

                        <div class="text-white leading-relaxed">
                            {!! Helper::stripInlineStyle(
                                app()->getLocale() === 'en' ? $class->description_en : $class->description_np ?? $class->description_en,
                            ) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- --------------------Why Section---------------------------- -->

    <!-- CTA -->
    @include('frontend.partials.apply-now', [
        'data' => $academicLevel,
    ])

    <!-- ---------------------------------Why choose us---------------------------------------- -->
    <div id="whyChooseUs-section" class="h-auto w-full">
        <div class="py-10">
            <div class="flex flex-col space-y-5 items-center">
                <div class="w-auto h-11 rounded-[100px] text-center items-center content-center p-3 bg-[#205246]">
                    <p class="text-white font-semibold text-base tracking-wider">{{ __('pages.why_choose_us') }}</p>
                </div>

                <div class="w-full lg:w-[1023px]">
                    <p class="font-medium text-base lg:text-xl text-gray-600 text-center leading-[50px] px-6">
                        {{ __('pages.why_choose_us_description') }}
                    </p>
                </div>

                <!-- ------------------------- Cards Grid Section --------------------------- -->
                <div id="WhyChooseUs-cards" class="w-full px-6 md:px-10 xl:px-20 ">
                    <div class="swiper w-full bg-transparent pt-0">
                        <div class="swiper-wrapper bg-transparent py-6">
                            @foreach ($usps as $usp)
                                <div
                                    class="w-full justify-between swiper-slide relative lg:max-w-[303px] flex flex-col border-none h-[412px] rounded-xl shadow-lg bg-white transition-all duration-300 ease-in-out">
                                    <div class="w-full h-40 relative">
                                        <img class="w-full h-full object-cover rounded-tl-xl rounded-tr-xl"
                                            src="{{ asset($usp->thumbnail_image) }}" alt="WPHS" />
                                        <div
                                            class="bg-secondary absolute bottom-[-1.5rem] left-6 flex items-center justify-center w-12 h-12 rounded-full">
                                            <i class="fa fa-quote-left text-accent fa-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col px-4 pt-5 pb-6 space-y-6 text-sm">
                                        {!! Helper::stripInlineStyle(
                                            app()->getLocale() === 'en' ? $usp->short_description_en : $usp->short_description_np ?? $usp->short_description_en,
                                        ) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- ------------------------- Navigation Buttons ----------------------------->
                        <div id="testa-button" class="flex flex-row items-center justify-center space-x-4">
                            <span
                                class="swiper-button-prev-custom flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                            <span
                                class="swiper-button-next-custom flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------------------Why choose us---------------------------------------- -->
@endsection

@push('scripts')
    <script>
        var swiper = new Swiper("#WhyChooseUs-cards .swiper", {
            loop: true,
            grabCursor: true,
            pagination: {
                el: "#WhyChooseUs-cards .swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: "#WhyChooseUs-cards .swiper-button-next-custom",
                prevEl: "#WhyChooseUs-cards .swiper-button-prev-custom"
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                360: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1536: {
                    slidesPerView: 6,
                    spaceBetween: 20,
                },
            }
        });
    </script>
@endpush
