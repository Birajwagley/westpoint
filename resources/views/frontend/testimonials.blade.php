@extends('frontend.layouts.app')

@section('title', 'Testimonials')

@php
    use App\Helpers\Helper;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.testimonials'),
        'subHeading' => __('pages.testimonials_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('pages.testimonials'),
            'route' => route('testimonials'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Testimonials Section --}}
    <section class="w-full">
        @php
            $testimonialSections = [
                [
                    'type' => 'alumni',
                    'data' => $alumniTestimonials,
                    'title' => __('pages.alumni_testimonial_title'),
                    'subtitle' => __('pages.alumni_testimonial_subtitle'),
                    'bg' => 'bg-[#F2F5FA]',
                    'bg_image' => 'assets/frontend/images/about-us/white-bg.avif',
                    'gradient' => 'bg-gradient-to-b from-white/60 to-white/40',
                ],
                [
                    'type' => 'guardian',
                    'data' => $guardianTestimonials,
                    'title' => __('pages.guardian_testimonial_title'),
                    'subtitle' => __('pages.guardian_testimonial_subtitle'),
                    'bg' => 'bg-primary text-[#F2F5FA]',
                    'bg_image' => 'assets/frontend/images/about-us/hero-section.jpg',
                    'gradient' => 'bg-gradient-to-b from-black/60 to-black/40',
                ],
                [
                    'type' => 'faculty',
                    'data' => $facultyTestimonials,
                    'title' => __('pages.faculty_testimonial_title'),
                    'subtitle' => __('pages.faculty_testimonial_subtitle'),
                    'bg' => 'bg-[#F2F5FA]',
                    'bg_image' => 'assets/frontend/images/about-us/white-bg.avif',
                    'gradient' => 'bg-gradient-to-b from-white/60 to-white/40',
                ],
            ];

        @endphp

        @foreach ($testimonialSections as $section)
            @if ($section['data']->isNotEmpty())
                <section id="testimonials-{{ $section['type'] }}" class="relative w-full bg-cover bg-center"
                    style="background-image: url('{{ asset($section['bg_image']) }}');">
                    <div class="absolute inset-0 {{ $section['gradient'] }}"></div>

                    <div class="relative px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-16">
                        {{-- Section Header --}}
                        <div
                            class="text-center mb-10 {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'text-white' : 'text-gray-800' }}">
                            <div class="flex items-center justify-center gap-3 mb-4">
                                @for ($i = 0; $i < 2; $i++)
                                    <span
                                        class="w-3 h-3 rounded-full {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'bg-[#F2F5FA]' : 'bg-primary' }}"></span>
                                @endfor
                                <span
                                    class="text-xl font-bold {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'text-[#F2F5FA]' : 'text-primary' }}">{{ ucfirst($section['type']) }}</span>
                                @for ($i = 0; $i < 2; $i++)
                                    <span
                                        class="w-3 h-3 rounded-full {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'bg-[#F2F5FA]' : 'bg-primary' }}"></span>
                                @endfor
                            </div>
                            <h2
                                class="font-bold text-3xl md:text-4xl {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'text-[#F2F5FA]' : 'text-gray-700' }}">
                                {{ $section['title'] }}
                            </h2>
                            <p
                                class="mt-3 text-base md:text-lg font-medium {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'text-[#F2F5FA]' : 'text-gray-700' }}">
                                {{ $section['subtitle'] }}
                            </p>
                        </div>

                        {{-- Swiper Section --}}
                        <div class="flex justify-center items-center">
                            <div class="swiper w-full max-w-[1280px] px-4 sm:px-6 lg:px-8 mx-auto">
                                <div class="swiper-wrapper py-6 flex justify-center">
                                    @foreach ($section['data'] as $testimonial)
                                        <div
                                            class="swiper-slide max-w-[320px] sm:max-w-sm md:max-w-md bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden mx-auto">
                                            <div class="relative w-full h-40 bg-gray-50">
                                                <img src="{{ asset($testimonial->image) }}"
                                                    alt="{{ $section['type'] }} Image"
                                                    class="w-full h-full object-contain rounded-t-2xl">
                                                <div
                                                    class="absolute -bottom-5 left-6 flex items-center justify-center w-12 h-12 rounded-full bg-primary">
                                                    <i class="fa-solid fa-quote-left text-yellow-400"></i>
                                                </div>
                                            </div>
                                            <div class="p-6 flex flex-col justify-between h-full text-center">
                                                <p
                                                    class="text-gray-700 text-sm md:text-base leading-relaxed line-clamp-6 flex-grow">
                                                    {!! Helper::stripInlineStyle($testimonial->testimonial_text) !!}
                                                </p>
                                                <div class="mt-6">
                                                    <p class="font-semibold text-sm text-primary">
                                                        {{ $testimonial->full_name }}</p>
                                                    <span class="text-gray-600 text-xs font-medium">
                                                        @if ($section['type'] === 'alumni')
                                                            {{ __('pages.batch_of') }}
                                                            {{ optional($testimonial->alumni)->batch }}
                                                        @elseif($section['type'] === 'guardian')
                                                            {{ __('pages.guardian') }}
                                                        @else
                                                            {{ __('pages.faculty') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Swiper Navigation --}}
                                <div class="flex justify-center gap-4 mt-6">
                                    <button
                                        class="swiper-button-prev-{{ $section['type'] }} w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'text-primary bg-[#F2F5FA]' : 'bg-primary text-[#F2F5FA]' }}">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button
                                        class="swiper-button-next-{{ $section['type'] }} w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center {{ $section['bg'] === 'bg-primary text-[#F2F5FA]' ? 'text-primary bg-[#F2F5FA]' : 'bg-primary text-[#F2F5FA]' }}">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    </section>
@endsection

@push('scripts')
    <script>
        function setEqualHeight(swiperSelector) {
            const slides = document.querySelectorAll(`${swiperSelector} .swiper-slide`);
            let maxHeight = 0;

            slides.forEach(slide => slide.style.height = 'auto'); // reset
            slides.forEach(slide => {
                const h = slide.offsetHeight;
                if (h > maxHeight) maxHeight = h;
            });
            slides.forEach(slide => slide.style.height = maxHeight + 'px');
        }

        ['alumni', 'guardian', 'faculty'].forEach(type => {
            const swiperSelector = `#testimonials-${type} .swiper`;

            // GSAP animation
            gsap.from(`#testimonials-${type}`, {
                opacity: 0,
                y: 80,
                duration: 1,
                scrollTrigger: {
                    trigger: `#testimonials-${type}`,
                    start: "top 85%"
                }
            });

            // Initialize Swiper
            new Swiper(swiperSelector, {
                loop: false,
                slidesPerView: 1, // show 1 card by default
                spaceBetween: 24,
                centeredSlides: false, // stop on each card
                navigation: {
                    nextEl: `#testimonials-${type} .swiper-button-next-${type}`,
                    prevEl: `#testimonials-${type} .swiper-button-prev-${type}`,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 24
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 32
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 40
                    },
                },
                on: {
                    init: function() {
                        setEqualHeight(swiperSelector);
                    },
                    resize: function() {
                        setEqualHeight(swiperSelector);
                    },
                    slideChange: function() {
                        setEqualHeight(swiperSelector);
                    },
                }
            });
        });
    </script>
@endpush
