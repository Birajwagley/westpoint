@extends('frontend.layouts.app')

@section('title', 'Awards')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.awards'),
        'subHeading' => __('pages.awards_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('pages.awards'),
            'route' => route('awards'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Awards Cards --}}
    <section class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-16">
        @php
            use App\Enum\AwardTypeEnum;
        @endphp

        <div id="award-section" class="h-auto w-full justify-items-center font-poppins pt-10 pb-10">
            <div class="flex flex-col w-full items-center">
                <div id="award-title" class="h-16 flex items-center justify-center text-white font-semibold">
                    <div class="flex items-center justify-center space-x-3 my-6">
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                        <span
                            class="text-primary font-bold text-xl opacity-70 font-poppins">{{ __('homepage.highlights_of_excellence') }}</span>
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                        <span class="w-3 h-3 bg-primary rounded-full"></span>
                    </div>
                </div>

                <div class="items-center self-center mb-10">
                    <p class="text-[#000000] lg:w-[902px] font-medium text-base text-center">
                        {{ __('homepage.award_description') }}
                    </p>
                </div>

                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 w-full">
                    @foreach ($awards as $award)
                        @php
                            $color =
                                $award->award_type == AwardTypeEnum::GOLD->value
                                    ? 'bg-[#FFD700]/60'
                                    : ($award->award_type == AwardTypeEnum::SILVER->value
                                        ? 'bg-[#C0C0C0]/60'
                                        : 'bg-[#CD7F32]/60');
                        @endphp

                        <div class="w-full rounded-xl h-96 bg-primary shadow-lg relative flex flex-col justify-between">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-10">
                                <img src="{{ $setting->primary_logo }}" alt="logo" class="w-56 h-60 mx-auto" />
                            </div>

                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <img src="{{ asset('assets/frontend/images/homepage/malatrans.png') }}"
                                    class="w-64 h-64 mx-auto" />
                            </div>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="flex flex-col items-center space-y-3">
                                    <span
                                        class="{{ $color }} px-5 py-2 w-20 h-8 rounded-xl text-white font-bold text-sm text-center">
                                        {{ AwardTypeEnum::map($award->award_type) }}
                                    </span>
                                    <h3 class="text-white text-center font-semibold text-xl">{{ __('homepage.winner') }}
                                    </h3>
                                </div>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                                <p class="text-white text-center font-semibold opacity-60 text-sm">
                                    {{ app()->getLocale() == 'en' ? $award['title_en'] ?? '' : $award['title_np'] ?? ($award['title_en'] ?? '') }}
                                </p>
                                <p class="text-white text-center font-semibold text-sm">
                                    {{ app()->getLocale() == 'en' ? $award['short_description_en'] ?? '' : $award['short_description_np'] ?? ($award['short_description_en'] ?? '') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection
