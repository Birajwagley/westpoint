@php
    use App\Helpers\Helper;
@endphp

@push('styles')
    <style>
        /* Hide default scrollbar */
        .scrollable-content {
            overflow-y: auto;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE 10+ */
        }

        .scrollable-content::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Edge */
        }

        /* Optional: Add custom pointer on hover */
        .scrollable-content:hover {
            cursor: grab;
            /* Shows grab hand cursor */
        }

        /* Optional: Change to grabbing when user clicks and drags */
        .scrollable-content:active {
            cursor: grabbing;
        }
    </style>
@endpush

<div id="introduction-section" class="bg-transparent overflow-hidden w-full pt-12 mb-8">
    <div class="flex overflow-hidden flex-col">
        <div id="introduction-head" overflow-hidden
            class="h-16 flex items-center justify-center text-white font-semibold">
            <div class="w-44 bg-primary h-11 rounded-[100px] flex items-center justify-center">
                <p class="text-white font-semibold text-base">{{ __('homepage.introduction') }}</p>
            </div>
        </div>

        <div class="flex flex-col overflow-hidden lg:flex-row justify-center gap-6 px-4 sm:px-6 lg:px-8 py-6">
            @php
                $principalEn = $principal->information_en ?? [];
                $principalNp = $principal->information_np ?? [];
            @endphp
            <!-- ------------------------- Principal Image Box Section --------------------------- -->
            <a href="{{ route('founder-principal') }}" target="_blank" rel="noopener noreferrer">
                <div id="introduction-left-box"
                    class="flex-1 w-full lg:h-[540px] lg:basis-1/3 h-auto rounded-lg flex items-center justify-center text-white">
                    <div
                        class="w-full sm:w-[350px] md:w-[400px] h-full lg:h-[540px] space-y-5 shadow-[0_10px_10px_rgba(0,0,0,0.1)] rounded-[40px]">
                        <div class="w-full h-52 rounded-t-[40px] overflow-hidden">
                            <img class="w-full h-full object-top object-cover"
                                src="{{ asset($principal->image ?? '') }}" alt="image" />
                        </div>

                        <div class="w-full bg-transparent flex flex-col items-center">
                            <h3 class="font-semibold text-xl text-[#000000]">
                                {{ app()->getLocale() == 'en' ? $principalEn['name'] ?? '' : $principalNp['name'] ?? ($principalEn['name'] ?? '') }}

                            </h3>
                            <p class="font-semibold text-base text-primary">
                                {{ app()->getLocale() == 'en'
                                    ? $principalEn['designation'] ?? ''
                                    : $principalNp['designation'] ?? ($principalEn['designation'] ?? '') }}
                            </p>
                        </div>

                        <div class="flex items-start px-2 sm:px-4 space-x-2">
                            <!-- Quote Icon -->
                            <i class="fa-solid fa-quote-left text-primary fa-xl flex-shrink-0 mt-1"></i>

                            <!-- Editor Content -->
                            <div
                                class="flex-1 font-semibold text-xs text-black leading-6 text-justify line-clamp-[9] mb-2 pr-3">
                                {!! Helper::stripInlineStyle(
                                    app()->getLocale() === 'en'
                                        ? $principalEn['description'] ?? ''
                                        : $principalNp['description'] ?? $principalEn['description'] ?? '' ,
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- ------------------------- Introduction Description Section --------------------------- -->
            <div
                class="flex-1 w-full lg:h-[540px] lg:basis-[50%] self-start h-auto rounded-lg flex items-center justify-center text-white">
                <div class="w-full px-4 sm:px-6 lg:px-6 h-full">
                    <div class="h-full space-y-5">

                        <div id="step11">
                            <h2 class="w-full font-bold text-3xl sm:text-4xl lg:text-5xl text-primary bg-clip-text">
                                {!! __('homepage.welcome_to_gbbs') !!}
                            </h2>
                        </div>

                        <div id="step22">
                            <div class="font-medium leading-6 font-poppins text-md text-gray-600">
                                {!! Helper::stripInlineStyle(
                                    app()->getLocale() === 'en' ? $setting['description_en'] : $setting['description_np'] ?? $setting['description_en'],
                                ) !!}
                            </div>
                        </div>

                        <div id="step22">
                            <a href="{{ route('about-us') }}" target="_blank"
                                class="w-[230px] tracking-wide flex items-center gap-2 shadow-xl text-base bg-secondary backdrop-blur-md lg:font-semibold relative px-4 py-2 overflow-hidden rounded-full group text-white
                                        before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0
                                        before:rounded-full before:bg-primary hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700">
                                {{ __('homepage.discover_our_story') }}
                                <svg class="w-8 h-8 justify-end group-hover:rotate-90 bg-white text-white ease-linear duration-300 rounded-full border border-white group-hover:border-none p-2 rotate-45"
                                    viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054
                                            0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711
                                            6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                                        class="fill-gray-800 text-white">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------- School Hours Box Section --------------------------- -->
            <div id="introduction-right-box"
                class="flex-1 w-full lg:h-[540px] lg:basis-[22%] h-auto rounded-lg flex justify-center text-white items-start">
                <div class="w-full h-full bg-primary rounded-[20px] flex flex-col justify-between">
                    <div class="py-5 px-3 flex flex-col h-full">
                        <button
                            class="bg-white text-primary font-semibold text-sm leading-6 w-auto h-[44px] rounded-[100px] px-2 py-3 mb-3">
                            {{ __('homepage.school_hrs') }}
                        </button>

                        <!-- Scrollable section -->
                        <div class="flex-1 scrollable-content text-sm font-semibold space-y-1 py-3">
                            {!! Helper::stripInlineStyle(
                                app()->getLocale() == 'en'
                                    ? $setting->school_hour_en ?? ''
                                    : $setting->school_hour_np ?? ($setting->school_hour_en ?? ''),
                            ) !!}
                        </div>

                        <hr class="border-t border-white border-1 w-full mb-2">

                        <div class="flex flex-col justify-center text-center">
                            <p class="font-semibold text-sm leading-6">{{ __('homepage.school_contact_service') }}</p>
                            <p class="font-semibold text-sm leading-6">
                                {{ json_decode($setting->contact1)->contact ?? '' }}</p>
                            <p class="font-semibold text-sm leading-6">
                                {{ json_decode($setting->contact2)->contact ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        gsap.from("#introduction-head", {
            y: -200,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#introduction-section",
                start: "top 80%",
            }
        });

        gsap.from("#step22", {
            y: 200,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#introduction-section",
                start: "top 80%",
            }
        });

        gsap.from("#step11", {
            y: -200,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#introduction-section",
                start: "top 80%",
            }
        });

        gsap.from("#introduction-left-box", {
            x: -400,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#introduction-section",
                start: "top 80%",
            }
        });

        gsap.from("#introduction-right-box", {
            x: 400,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#introduction-section",
                start: "top 80%",
            }
        });
    </script>
@endpush
