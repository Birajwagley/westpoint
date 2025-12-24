@extends('frontend.layouts.app')

@section('title', 'Academic Levels')

@php
    use App\Helpers\Helper;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.nurturing_futures'),
        'subHeading' => __('pages.nurturing_futures_tagline'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.academic_levels'),
            'route' => route('academics'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <!-- ============================= -->
    <!-- 📘 A Section -->
    <!-- ============================= -->
    <div
        class="container mx-auto px-4 flex flex-col-reverse lg:flex-row items-center justify-between gap-10 lg:gap-16 my-20">
        <!-- Image Section -->
        <div
            class="relative w-full md:w-1/2 flex justify-center items-center h-[350px] sm:h-[400px] md:h-[450px] lg:h-[500px]">
            <img src="{{ asset($academic->banner_image) }}" alt="GBBS"
                class="w-full h-auto object-cover rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300">
        </div>

        <!-- Text Content -->
        <div class="flex flex-col items-center lg:items-start text-center lg:text-left max-w-2xl space-y-5">
            <h3 class="text-primary text-lg sm:text-xl font-bold uppercase tracking-wide">
                {{ app()->getLocale() == 'en' ? $academic->title_en : (isset($academic->title_np) ? $academic->title_np : $academic->title_en) }}
            </h3>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-dark leading-tight">
                @php
                    $text =
                        app()->getLocale() == 'en'
                            ? $academic->short_description_en
                            : $academic->short_description_np ?? $academic->short_description_en;

                    $words = explode(' ', $text);
                    $lastTwo = array_splice($words, -2);
                @endphp


                {{ implode(' ', $words) }} <span class="text-secondary">{{ implode(' ', $lastTwo) }}</span>
            </h2>

            <div class="text-base sm:text-lg text-gray-600 leading-relaxed">
                {!! Helper::stripInlineStyle(
                    app()->getLocale() === 'en' ? $academic->description_en : $academic->description_np ?? $academic->description_en,
                ) !!}
            </div>
        </div>
    </div>

    <section class="m-10 xl:mx-20 pb-10">
        <div
            class="grid grid-cols-1 lg:top-1/2 lg:mb-[20px] sm:grid-cols-2 m lg:grid-cols-3 xl:grid-cols-5 gap-6 px-[20px] md:px-[40px] transform w-full">
            @foreach ($academicLevels as $academicLevel)
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between gap-3">
                    <div class="flex flex-col justify-between space-y-3">

                        <div class="mb-2 text-5xl text-green-600 mx-auto">
                            <i class="fa {{ $academicLevel->icon }}"></i>
                        </div>

                        <h3 class="font-bold text-lg text-center text-primary">
                            {{ app()->getLocale() == 'en' ? $academicLevel->name_en : (isset($academicLevel->name_np) ? $academicLevel->name_np : $academicLevel->name_en) }}
                        </h3>

                        <p class="text-gray-700 text-xs font-bold text-center">
                            {{ app()->getLocale() == 'en' ? $academicLevel->tagline_en : (isset($academicLevel->tagline_np) ? $academicLevel->tagline_np : $academicLevel->tagline_en) }}
                        </p>

                        <div class="text-center border-t border-b border-gray-100 py-2 mb-2 text-gray-600">
                            {!! Helper::stripInlineStyle(
                                app()->getLocale() === 'en'
                                    ? $academicLevel->short_description_en
                                    : $academicLevel->short_description_np ?? $academicLevel->short_description_en,
                            ) !!}
                        </div>

                        <ul class="space-y-2 text-gray-700">
                            @foreach ($academicLevel->classes as $class)
                                <li class="flex items-center">
                                    <span
                                        class="w-7 h-7 flex p-1 items-center justify-center rounded-full bg-primary text-white">
                                        <i class="fa {{ $class->icon ?? 'fa-book-open' }}"></i>
                                    </span>
                                    <span class="font-semibold text-sm pl-2">
                                        {{ app()->getLocale() == 'en' ? $class->name_en : (isset($class->name_np) ? $class->name_np : $class->name_en) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ route('academics-detail', $academicLevel->slug) }}"
                        class="mt-4 block w-full text-center py-2 px-4 rounded-lg text-sm font-semibold text-white bg-primary hover:bg-secondary transition duration-300">
                        {{ __('pages.view_program_details') }}
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section breaker -->
    <div
        class="flex flex-col lg:flex-row bg-primary items-center justify-around gap-10 text-white rounded-lg mx-6 my-10 md:m-10 lg:mx-20 p-10 ">
        <div class="flex flex-col gap-6 text-center">
            <h1 class="text-2xl lg:text-4xl font-extrabold tracking-wide">{{ __('pages.ready_to_start_journey') }}</h1>
            <p class="line-clamp-2 text-lg lg:text-xl">{{ __('pages.comprehensive_academic_programs') }}</p>
        </div>

        <button type="button" id="applyNowButton" data-dropdown-toggle="applyNowDropdownDelay" data-dropdown-delay="500"
            data-dropdown-trigger="hover"
            class="px-6 py-4 bg-white text-primary rounded-full cursor-pointer text-center text-xl w-60 inline-block font-bold hover:opacity-85">{{ __('pages.apply_now') }}</button>

        <div id="applyNowDropdownDelay" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44"
            role="menu">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="applyNowButton">
                <li>
                    <a href="{{ route('online-admission.school-level') }}" class="block px-4 py-2 hover:bg-gray-100"
                        role="menuitem">{{ __('homepage.school_level') }}</a>
                </li>
                <li>
                    <a href="{{ route('online-admission.college-level') }}" class="block px-4 py-2 hover:bg-gray-100"
                        role="menuitem">{{ __('homepage.college_level') }}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Section breaker -->

    @endsection @push('scripts')
@endpush
