@extends('frontend.layouts.app')

@section('title', 'Career')

@php
    use Carbon\Carbon;
    use App\Helpers\Helper;
    use App\Enum\TimingTypeEnum;
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.career'),
        'subHeading' => __('pages.career_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.career'),
            'route' => route('career'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <section class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 space-y-4">
            <!-- Job Card -->
            @foreach ($careers as $career)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-primary mt-2">
                            {{ app()->getLocale() == 'en' ? $career->name_en ?? '' : $career->name_np ?? ($career->name_en ?? '') }}
                        </h3>

                        <div class="text-gray-600 mt-1 text-sm text-justify line-clamp-5">
                            {!! Helper::stripInlineStyle(
                                app()->getLocale() == 'en'
                                    ? $career->requirement_en ?? ''
                                    : $career->requirement_np ?? ($career->requirement_en ?? ''),
                            ) !!}
                        </div>

                        <div class="flex flex-wrap justify-between text-gray-500 text-sm mt-2 space-x-4">
                            <span><span class="text-2xl">📅</span>
                                {{ app()->getLocale() == 'en'
                                    ? $career->valid_date
                                    : LaravelNepaliDate::from($career->valid_date)->toNepaliDate(format: 'j F Y', locale: 'np') }}</span>

                            <span><span class="text-2xl">⏰</span>
                                {{ app()->getLocale() == 'en'
                                    ? TimingTypeEnum::map($career->timing) ?? ''
                                    : TimingTypeEnum::mapNp($career->timing) ?? (TimingTypeEnum::map($career->timing) ?? '') }}</span>

                            <span><span class="text-2xl">📬</span>
                                {{ app()->getLocale() == 'en'
                                    ? $career->number_of_post ?? ''
                                    : Helper::convertEnglishToNepaliNumbers($career->number_of_post) ?? ($career->number_of_post ?? '') }}</span>

                            <a href="{{ route('career-details.show', $career->slug) }}"
                                class="block text-center text-sm font-semibold text-primary border border-primary rounded hover:bg-primary hover:text-white transition-all px-4 py-2">
                                {{ __('pages.career_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
