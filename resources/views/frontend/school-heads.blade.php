@extends('frontend.layouts.app')

@php
    use App\Helpers\Helper;

    $name =
        app()->getLocale() == 'en'
            ? $vicePrincipal->name_en ?? ''
            : $vicePrincipal->name_np ?? ($vicePrincipal->name_en ?? '');
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
            'route' => null,
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <div class="px-4 sm:px-8 md:px-16 lg:px-28 py-10">
        <img src="{{ asset($vicePrincipal->image ?? '') }}" alt="{{ $name }}"
            class="w-full sm:w-72 lg:w-[450px] rounded-lg object-cover mb-2 lg:float-left lg:mr-6 lg:mb-2" />

        <span class="font-normal text-2xl text-primary">
            {{ app()->getLocale() == 'en'
                ? $vicePrincipal->designation->name_en ?? ''
                : $vicePrincipal->designation->name_np ?? ($vicePrincipal->designation->name_en ?? '') }}
        </span>

        <h3 class="font-semibold text-xl leading-10 text-secondary text-justify">
            {{ $name }}
        </h3>

        <div class='space-y-2 leading-7 mt-2'>
            @if (isset($vicePrincipal->phone_number))
                <div class='flex'>
                    <label class='font-semibold text-base text-secondary'>
                        {{ __('pages.phone_no') }}:&nbsp;
                    </label>
                    <p class='text-black font-normal text-base'>
                        {{ $vicePrincipal->phone_number }}
                    </p>
                </div>
            @endif

            @if (isset($vicePrincipal->email))
                <div class='flex'>
                    <label class='font-semibold text-base text-secondary'>
                        {{ __('pages.email') }}:&nbsp;
                    </label>
                    <p class='text-black font-normal text-base'>
                        {{ $vicePrincipal->email }}
                    </p>
                </div>
            @endif
        </div>

        <div class="font-normal text-base text-black text-justify mt-4">
            {!! Helper::stripInlineStyle(
                app()->getLocale() == 'en'
                    ? $vicePrincipal->description_en ?? ''
                    : $vicePrincipal->description_np ?? ($vicePrincipal->description_en ?? ''),
            ) !!}
        </div>

        <div class="clear-both"></div>
    </div>
@endsection
