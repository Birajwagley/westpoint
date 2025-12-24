@extends('frontend.layouts.app')

@section('title', $menu->name_en)

@php
    use Carbon\Carbon;
    use App\Helpers\Helper;
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
@endphp

@section('content')

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

    {{-- Main Content --}}
    <section class="my-12 lg:my-24 px-6 md:px-10 lg:px-20">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Left Section (80%) --}}
            <div class="w-full lg:w-3/5">
                <!-- Article Header -->
                <header class="mb-8 border-b pb-4">
                    <h1 class="text-3xl sm:text-4xl font-bold text-primary leading-snug">
                        {{ app()->getLocale() == 'en' ? $menu->page->title_en ?? '' : $menu->page->title_np ?? ($menu->page->title_en ?? '') }}
                    </h1>
                </header>

                <!-- Short Description -->
                <section class="mb-6">
                    <p class="text-lg text-gray-700 font-medium border-l-4 border-primary pl-4">
                        {!! Helper::stripInlineStyle(
                            app()->getLocale() == 'en'
                                ? $menu->page->short_description_en ?? ''
                                : $menu->page->short_description_np ?? ($menu->page->short_description_en ?? ''),
                        ) !!}
                    </p>
                </section>

                <!-- Featured Image -->
                <div class="mb-8">
                    <img src="{{ asset($menu->page->banner_image ?? '') }}" alt="GBBS"
                        class="w-full h-[350px] md:h-[420px] object-cover rounded-xl shadow-md" />
                </div>

                <!-- Long Description -->
                <article class="space-y-6 text-gray-700 text-justify leading-relaxed">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en'
                            ? $menu->page->description_en ?? ''
                            : $menu->page->description_np ?? ($menu->page->description_en ?? ''),
                    ) !!}
                </article>
            </div>

            {{-- Right Section (20%) --}}
            <div class="w-full lg:w-2/5 flex flex-col gap-6">

                {{-- About Section --}}
                @include('frontend.partials.about-section', ['socials' => $socials])

                {{-- Explore Button --}}
                <a href="{{ route('publication') }}"
                    class="self-end bg-secondary text-white font-semibold text-center px-4 py-2 rounded-full hover:bg-primary transition">
                    {{ __('pages.explore_news') }}
                </a>

                {{-- News List --}}
                <div class="drop-shadow-lg bg-white rounded-lg">
                    <div class="flex items-center gap-3 p-3 border-b">
                        <i class="fa fa-list text-primary"></i>
                        <h2 class="font-bold text-base text-primary">{{ __('pages.all_news') }}</h2>
                    </div>

                    <div class="overflow-y-auto max-h-[430px] p-3 space-y-3">
                        @foreach ($publication as $news)
                            <div class="flex gap-3 p-2 border-l-4 border-primary rounded-md hover:bg-gray-50 transition">
                                <img src="{{ asset($news->thumbnail_image) }}"
                                    alt="{{ app()->getLocale() == 'en' ? $news->name_en ?? '' : $news->name_np ?? ($news->name_en ?? '') }}"
                                    class="w-20 h-16 rounded-md object-cover flex-shrink-0" />

                                <div>
                                    <a href="#"
                                        class="font-semibold text-sm hover:text-primary transition line-clamp-2">
                                        {{ app()->getLocale() == 'en' ? $news->name_en ?? '' : $news->name_np ?? ($news->name_en ?? '') }}
                                    </a>

                                    <div class="text-gray-500 text-xs mt-1">
                                        {!! Helper::stripInlineStyle(
                                            app()->getLocale() == 'en'
                                                ? $news->short_description_en ?? ''
                                                : $news->short_description_np ?? ($news->short_description_en ?? ''),
                                        ) !!}
                                    </div>

                                    <div class="flex items-center gap-1 text-gray-500 text-xs mt-1">
                                        <i class="fa-regular fa-calendar mt-1 fa-md">&nbsp; <span>
                                                {{ app()->getLocale() == 'en'
                                                    ? $news->published_date
                                                    : LaravelNepaliDate::from($news->published_date)->toNepaliDate(format: 'j F Y', locale: 'np') }}</span></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
