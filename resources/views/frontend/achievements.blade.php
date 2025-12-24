@extends('frontend.layouts.app')

@section('title', 'Achievements')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.achievements'),
        'subHeading' => __('pages.achievements_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('pages.achievements'),
            'route' => route('achievements'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Achievements Cards --}}
    <section class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-16">
        @php
            use App\Enum\AwardTypeEnum;
        @endphp

        <div id="achievement-section" class="h-auto w-full justify-items-center font-poppins pt-10 pb-10">
            <div class="flex flex-col w-full items-center">
                <div id="achivement-title" class="h-16 flex items-center justify-center text-white font-semibold">
                    <div class="flex items-center justify-center space-x-3 my-6">
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                        <span
                            class="text-primary font-bold text-xl opacity-70 font-poppins">{{ __('homepage.highlights_of_excellence') }}</span>
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                    </div>
                </div>

                <div id="achivement-desc" class="items-center self-center mb-10">
                    <p class="text-[#000000] lg:w-[902px] font-medium text-base text-center">
                        {{ __('homepage.achivement_description') }}
                    </p>
                </div>

                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 w-full">
                    @foreach ($achivements as $achivement)
                        <div class="w-full rounded-xl h-96 bg-[#FFFFFF] shadow-lg relative flex flex-col justify-between">
                            <div class="bg-primary w-full rounded-tl-xl p-2 rounded-tr-xl flex justify-center">
                                <img src="{{ $setting->primary_logo }}" alt="card-image"
                                    class="w-36 opacity-75 h-40 mx-auto" />
                            </div>

                            <div
                                class="absolute top-1/2 left-1/2 bg-white p-1 rounded-full transform -translate-x-1/2 -translate-y-1/2">
                                <img src="{{ asset($achivement->image) }}" alt="card-image"
                                    class="w-32 h-32 rounded-full bg-primary border-4 border-white" />
                            </div>

                            <div class="text-[#000000] flex flex-col items-center py-10 px-5 space-y-2">
                                <p class="font-semibold text-xl">
                                    {{ app()->getLocale() == 'en' ? $achivement['title_en'] ?? '' : $achivement['title_np'] ?? ($achivement['title_en'] ?? '') }}
                                </p>
                                <span class="font-medium text-sm text-center">
                                    {{ app()->getLocale() == 'en' ? $achivement['short_description_en'] ?? '' : $achivement['short_description_np'] ?? ($achivement['short_description_en'] ?? '') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection
