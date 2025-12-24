@extends('frontend.layouts.app')

@php
    use App\Helpers\Helper;

    $infoEn = $messageFrom->information_en ? json_decode($messageFrom->information_en) : [];
    $infoNp = $messageFrom->information_np ? json_decode($messageFrom->information_np) : [];

    $name = app()->getLocale() == 'en' ? $infoEn->name ?? '' : $infoNp->name ?? ($infoEn->name ?? '');
@endphp

@section('title', $name)

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
            'name' => $name,
            'route' => route('late-gyan-bahadur-yakthumba'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <div class="px-4 sm:px-8 md:px-16 lg:px-28 py-10">
        <img src="{{ asset($messageFrom->image) }}" alt="{{ $name }}"
            class="w-full sm:w-72 lg:w-[450px] rounded-lg object-cover mb-4 lg:float-left lg:mr-6 lg:mb-2" />

        <span class="font-normal text-2xl text-primary">
            {{ __('pages.founder_principal') }}
        </span>

        <h3 class="font-semibold text-xl leading-10 text-secondary text-justify">
            {{ $name }}
        </h3>

        <div class='space-y-2 leading-7 mt-2'>
            @if (isset($messageFrom->phone_number))
                <div class='flex'>
                    <label class='font-semibold text-base text-secondary'>
                        {{ __('pages.phone_no') }}:&nbsp;
                    </label>
                    <p class='text-black font-normal text-base'>
                        {{ $messageFrom->phone_number }}
                    </p>
                </div>
            @endif

            @if (isset($messageFrom->email))
                <div class='flex'>
                    <label class='font-semibold text-base text-secondary'>
                        {{ __('pages.email') }}:&nbsp;
                    </label>
                    <p class='text-black font-normal text-base'>
                        {{ $messageFrom->email }}
                    </p>
                </div>
            @endif
        </div>

        <div class="font-normal text-base text-black text-justify mt-4">
            {!! Helper::stripInlineStyle(
                app()->getLocale() == 'en' ? $infoEn->description ?? '' : $infoNp->description ?? ($infoEn->description ?? ''),
            ) !!}
        </div>

        <div class="clear-both"></div>

        <div class="w-full flex">
            <a href="{{ app()->getLocale() == 'en' ? $infoEn->external_link ?? 'void:;' : $infoNp->external_link ?? ($infoEn->external_link ?? 'void:;') }}"
                target="_blank"
                class="flex items-center gap-2 shadow-xl text-base bg-secondary backdrop-blur-md lg:font-semibold relative px-4 py-2 overflow-hidden rounded-full group text-white before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-primary hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700">
                {{ app()->getLocale() == 'en' ? ($name ? 'Biography of ' . $name : 'Biography') : ($name ? $name . ' को जीवनी' : 'जीवनी') }}
                <svg class="w-8 h-8 justify-end group-hover:rotate-90 bg-white text-white ease-linear duration-300 rounded-full border border-white group-hover:border-none p-2 rotate-45"
                    viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                        class="fill-gray-800 text-white"> </path>
                </svg>
            </a>
        </div>
    </div>

@endsection
