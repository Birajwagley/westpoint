@extends('frontend.layouts.app')

@section('title', 'Teams')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.meet_our_team'),
        'subHeading' => __('pages.dedicated_leaders'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.team'),
            'route' => route('team'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Team Section --}}
    <section class="relative my-6 lg:my-12 xl:my-16">
        <div class="container mx-auto px-4">

            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl font-semibold text-primary">{{ __('pages.founder_and_principal') }}</h2>
            </div>

            <div class="flex flex-wrap justify-center gap-8 mb-12">
                <!-- Founder & Principal -->
                <div
                    class="group relative flex flex-col items-center text-center p-6 rounded-3xl bg-white/80 backdrop-blur-md border border-gray-200 shadow-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl max-w-xs w-full">
                    @php
                        $infoEn = $founder->information_en ? json_decode($founder->information_en) : [];
                        $infoNp = $founder->information_np ? json_decode($founder->information_np) : [];

                        $name =
                            app()->getLocale() == 'en' ? $infoEn->name ?? '' : $infoNp->name ?? ($infoEn->name ?? '');
                    @endphp

                    <div class="text-primary font-bold mb-2">
                        {{ __('pages.founder_principal') }}
                    </div>

                    <div
                        class="relative w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 rounded-full overflow-hidden border-4 border-primary shadow-lg">
                        <img src="{{ $founder->image && file_exists(public_path($founder->image))
                            ? asset($founder->image)
                            : asset('assets/frontend/images/default-avatar.png') }}"
                            alt="{{ $founder->name_en }}" class="w-full h-full object-cover">
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold text-primary text-lg">{{ $name }}</h4>
                    </div>
                </div>

                {{-- Principal --}}
                <div
                    class="group relative flex flex-col items-center text-center p-6 rounded-3xl bg-white/80 backdrop-blur-md border border-gray-200 shadow-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl max-w-xs w-full">
                    @php
                        $infoEn = $principal->information_en ? json_decode($principal->information_en) : [];
                        $infoNp = $principal->information_np ? json_decode($principal->information_np) : [];

                        $name =
                            app()->getLocale() == 'en' ? $infoEn->name ?? '' : $infoNp->name ?? ($infoEn->name ?? '');
                    @endphp

                    <div class="text-primary font-bold mb-2">
                        <p class="text-sm text-primary">
                            {{ app()->getLocale() == 'en'
                                ? $infoEn->designation_id ?? ''
                                : $infoNp->designation_id ?? ($infoEn->designation_id ?? '') }}
                        </p>
                    </div>

                    <div
                        class="relative w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 rounded-full overflow-hidden border-4 border-primary shadow-lg">
                        <img src="{{ $principal->image && file_exists(public_path($principal->image))
                            ? asset($principal->image)
                            : asset('assets/frontend/images/default-avatar.png') }}"
                            alt="{{ $principal->name_en }}" class="w-full h-full object-cover">
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold text-primary text-lg">{{ $name }}</h4>
                        <p class="text-sm text-primary">
                            {{ app()->getLocale() == 'en'
                                ? $infoEn->department_id ?? ''
                                : $infoNp->department_id ?? ($infoEn->department_id ?? '') }}
                        </p>
                    </div>
                </div>

                {{-- featured team --}}
                @if ($featuredTeams->isNotEmpty())
                    @foreach ($featuredTeams as $team)
                        @include('frontend.partials.team-card')
                    @endforeach
                @endif
            </div>

            <!-- Other Team Members -->
            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl font-semibold text-primary">{{ __('pages.our_dedicated_team') }}</h2>
            </div>

            @if ($otherTeams->isNotEmpty())
                <div class="flex flex-wrap justify-center gap-8">
                    @foreach ($otherTeams as $team)
                        @include('frontend.partials.team-card')
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">{{ __('pages.no_details') }}</p>
            @endif

        </div>
    </section>

@endsection
