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
    <div class="px-4 sm:px-8 md:px-16 lg:px-28 py-10">
        <img src="{{ asset($academicLevel->thumbnail_image) }}" alt="GBBS"
            class="w-full sm:w-72 lg:w-[500px] mb-2 lg:float-left lg:mr-6 lg:mb-2 rounded-2xl shadow-lg object-cover transform transition duration-300">

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

        <div class="clear-both"></div>
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
                                    alt="GBBS">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- -------------------- Faculty List Section ---------------------------- -->
    <section class="relative py-12 z-0 bg-primary">
        <div class="absolute top-8 left-8 w-12 h-12 bg-white/20 rounded-full animate-pulse-slow"></div>
        <div class="absolute top-24 left-16 w-8 h-8 bg-white/20 rounded-full animate-pulse-slow delay-200"></div>
        <div class="absolute bottom-8 right-8 w-16 h-16 bg-white/20 rounded-full animate-pulse-slow delay-400"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-20">
                {{ __('pages.our_faculties') }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 text-left">
                @foreach ($faculties as $index => $faculty)
                    <div class="flex flex-col bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow-xl h-full faculty-card"
                        data-index="{{ $index }}">
                        <div class="flex items-center mb-4 space-x-4">
                            <div class="w-16 h-16 rounded-xl bg-accent flex items-center justify-center shadow">
                                <i class="fa {{ $faculty->icon ?? 'fa-book' }} text-3xl text-primary"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-white">
                                {{ app()->getLocale() == 'en' ? $faculty->name_en : $faculty->name_np ?? $faculty->name_en }}
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Faculty Content Section -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($faculties as $index => $faculty)
            <div class="faculty-content relative {{ $index != 0 ? 'hidden' : '' }}" data-index="{{ $index }}">
                <div class="px-4 sm:px-8 md:px-16 lg:px-28 pt-10">
                    @if ($faculty->thumbnail_image)
                        <img src="{{ asset($faculty->thumbnail_image) }}" alt="Thumbnail"
                            class="h-full w-full md:h-2/5 md:w-2/5 mb-2 lg:float-right lg:ml-6 lg:mb-2 rounded-2xl shadow-lg object-cover transform transition duration-300">
                    @endif

                    <h3 class="text-primary text-lg sm:text-xl font-bold uppercase tracking-wide">
                        {{ app()->getLocale() == 'en' ? $faculty->name_en : $faculty->name_np ?? $faculty->name_en }}
                    </h3>

                    <h2 class="text-3xl sm:text-4xl md:text-3xl font-extrabold text-gray-800 leading-tight">
                        @php
                            $text =
                                app()->getLocale() == 'en'
                                    ? $faculty->short_description_en ?? ''
                                    : $faculty->short_description_np ?? ($faculty->short_description_en ?? '');
                            $words = explode(' ', $text);
                            $lastTwo = array_splice($words, -2);
                        @endphp

                        {{ implode(' ', $words) }} <span class="text-secondary">{{ implode(' ', $lastTwo) }}</span>
                    </h2>

                    <div class="text-base sm:text-lg text-gray-600 leading-relaxed text-justify">
                        {!! Helper::stripInlineStyle(
                            app()->getLocale() == 'en' ? $faculty->description_en : $faculty->description_np ?? $faculty->description_en,
                        ) !!}
                    </div>

                    <div class="clear-both"></div>

                    {{-- New image below this section --}}
                    @php
                        $images = json_decode($faculty->images, true); // decode JSON into array
                    @endphp

                    @if (count($images) > 0)
                        <div class="flex flex-row gap-4 mt-4 ">
                            @foreach ($images as $image)
                                <img src="{{ asset($image) }}" alt="Additional Image"
                                    class="h-48 rounded-2xl shadow-lg object-cover flex-shrink-0 transform transition duration-300 hover:scale-105">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- CTA -->
    @include('frontend.partials.apply-now', [
        'data' => $academicLevel,
    ])
@endsection

@push('scripts')
    <script>
        const cards = document.querySelectorAll('.faculty-card');
        const contents = document.querySelectorAll('.faculty-content');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                const index = card.getAttribute('data-index');

                // Hide all contents
                contents.forEach(content => content.style.display = 'none');

                // Show selected content
                const activeContent = document.querySelector(`.faculty-content[data-index='${index}']`);
                activeContent.style.display = 'flex';

                // Smooth scroll to content
                activeContent.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            });
        });

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
