@extends('frontend.layouts.app')

@php
    use App\Helpers\Helper;

    $infoEn = $messageFrom->information_en ? json_decode($messageFrom->information_en) : [];
    $infoNp = $messageFrom->information_np ? json_decode($messageFrom->information_np) : [];

    $name = app()->getLocale() == 'en' ? $infoEn->name ?? '' : $infoNp->name ?? ($infoEn->name ?? '');
@endphp

@section('title', app()->getLocale() == 'en' ? $infoEn->name ?? '' : $infoNp->name ?? ($infoEn->name ?? ''))

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
            'route' => route('founder-principal'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <div class="flex flex-wrap flex-col lg:flex-row w-full h-auto px-4 sm:px-8 md:px-16 lg:px-28 py-10 gap-6 text-justify">
        {{-- principal image --}}
        <div class="flex-col flex space-y-6 items-center w-full sm:w-4/5 md:w-[100%] lg:w-[48%] p-4 mx-auto">
            <div class="w-full h-96 rounded-lg md:w-[525px] md:h-[400px] object-contain">
                <img src="{{ $messageFrom->image }}" class="w-full rounded-lg h-full" alt="GBBS" />
            </div>
        </div>

        {{-- principal title and description --}}
        <div class="flex-col flex space-y-6 justify-between w-full sm:w-4/5 md:w-[100%] lg:w-[48%] p-4 mx-auto">
            <div class="flex flex-col">
                <span class="font-normal text-2xl text-primary">
                    {{ app()->getLocale() == 'en' ? $infoEn->designation_id ?? '' : $infoNp->designation_id ?? ($infoEn->designation_id ?? '') }}
                </span>
                <h3 class="font-semibold text-xl text-secondary leading-10">
                    {{ $name }}
                </h3>
                <p class="font-normal text-base text-[#000000] text-justify">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en' ? $infoEn->description ?? '' : $infoNp->description ?? ($infoEn->description ?? ''),
                    ) !!}
                </p>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap flex-col lg:flex-row w-full h-auto px-4 sm:px-8 md:px-16 lg:px-28 pb-10 gap-6 text-justify">
        <div class="flex-col flex space-y-6 justify-between w-full sm:w-4/5 md:w-[100%] lg:w-[48%] p-4 mx-auto">
            {{-- principal information --}}
            <div class='w-full space-y-2'>
                <div class='flex flex-row justify-between'>
                    <label class='font-semibold text-base text-secondary'>{{ __('pages.name') }}:</label>
                    <p class='text-[#000000] font-normal text-base text-base text-end pl-1'>
                        {{ app()->getLocale() == 'en' ? $infoEn->name ?? '' : $infoNp->name ?? ($infoEn->name ?? '') }}
                    </p>
                </div>
                <div class='flex flex-row justify-between'>
                    <label class='font-semibold text-base text-secondary'>{{ __('pages.date_of_birth') }}:</label>
                    <p class='text-[#000000] font-normal text-base text-end pl-1'>
                        {{ app()->getLocale() == 'en' ? $infoEn->date_of_birth ?? '' : $infoNp->date_of_birth ?? ($infoEn->date_of_birth ?? '') }}
                    </p>
                </div>
                <div class='flex flex-row  justify-between'>
                    <label class='font-semibold text-base text-secondary'>{{ __('pages.correspondence_address') }}:</label>
                    <p class='text-[#000000] font-normal text-base text-end pl-1'>
                        {{ app()->getLocale() == 'en' ? $infoEn->correspondaence_address ?? '' : $infoNp->correspondaence_address ?? ($infoEn->correspondaence_address ?? '') }}
                    </p>
                </div>
                <div class='flex flex-row justify-between'>
                    <label class='font-semibold text-base text-secondary'>{{ __('pages.permanent_address') }}:</label>
                    <p class='text-[#000000] font-normal text-base text-end pl-1'>
                        {{ app()->getLocale() == 'en' ? $infoEn->permanent_address ?? '' : $infoNp->permanent_address ?? ($infoEn->permanent_address ?? '') }}
                    </p>
                </div>
            </div>

            {{-- education qualification --}}
            <div class='w-full space-y-2'>
                <div class='text-primary font-semibold text-2xl'>{{ __('pages.education_qualification') }}:</div>
                <div class='space-y-2 flex-wrap ml-4'>
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en'
                            ? $infoEn->educational_qualification ?? ''
                            : $infoNp->educational_qualification ?? ($infoEn->educational_qualification ?? ''),
                    ) !!}
                </div>
            </div>

            {{-- seminar --}}
            <div class='w-full space-y-2'>
                <div class='text-primary font-semibold text-2xl'>{{ __('pages.international_seminars_attended') }}:</div>
                <div class='space-y-2 flex-wrap ml-4'>
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en' ? $infoEn->seminar ?? '' : $infoNp->seminar ?? ($infoEn->seminar ?? ''),
                    ) !!}
                </div>
            </div>

            {{-- countries visited --}}
            <div class='w-full space-y-2'>
                <div class='text-primary font-semibold text-2xl'>{{ __('pages.countries_visited') }}:</div>
                <ul class='space-y-2 list-none flex-wrap ml-4 columns-2 md:columns-2 lg:columns-3 2xl:columns-4'>
                    @php
                        $countries =
                            app()->getLocale() == 'en'
                                ? $infoEn->country_visited ?? []
                                : $infoNp->country_visited ?? ($infoEn->country_visited ?? []);
                    @endphp

                    @foreach ($countries as $country)
                        <li class="text-[#000000] text-left text-wrap font-normal text-base">
                            {{ countries()[$country]['emoji'] }}&nbsp;&nbsp;{{ app()->getLocale() == 'en' ? countries()[$country]['name'] : Helper::getNepaliCountryName($country) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- experience --}}
            <div class='w-full space-y-2'>
                <div class='text-primary font-semibold text-2xl'>{{ __('pages.work_experience') }}:</div>
                <div class='space-y-2 flex-wrap ml-4'>
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en' ? $infoEn->experience ?? '' : $infoNp->experience ?? ($infoEn->experience ?? ''),
                    ) !!}
                </div>
            </div>
        </div>

        <div class="flex-col flex space-y-6 justify-between w-full sm:w-4/5 md:w-[100%] lg:w-[48%] p-4 mx-auto">
            {{-- awards --}}
            <div class='w-full space-y-2'>
                <div class='text-primary font-semibold text-2xl'>{{ __('pages.national_awards_received') }}:</div>
                <div class='space-y-2 flex-wrap ml-4'>
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en' ? $infoEn->awards ?? '' : $infoNp->awards ?? ($infoEn->awards ?? ''),
                    ) !!}
                </div>
            </div>
        </div>

        {{-- external link --}}
        @if (isset($infoNp->external_link) || isset($infoEn->external_link))
            <div class="w-full flex">
                <a href="{{ app()->getLocale() == 'en' ? $infoEn->external_link ?? 'void:;' : $infoNp->external_link ?? ($infoEn->external_link ?? 'void:;') }}"
                    target="_blank"
                    class="flex items-center gap-2 shadow-xl text-base bg-secondary backdrop-blur-md lg:font-semibold relative  px-4 py-2 overflow-hidden rounded-full group text-white
                            before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0
                            before:rounded-full before:bg-primary hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700">

                    {{ app()->getLocale() == 'en' ? ($infoEn->name ? 'Know More About' . $infoEn->name : 'Know More About') : ($infoNp->name ? $infoNp->name . ' को बारेमा थप जान्नुहोस्' : 'थप जान्नुहोस्') }}

                    <svg class="w-8 h-8 justify-end group-hover:rotate-90 bg-white text-white ease-linear duration-300 rounded-full border border-white group-hover:border-none p-2 rotate-45"
                        viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                            class="fill-gray-800 text-white">
                        </path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
@endsection
