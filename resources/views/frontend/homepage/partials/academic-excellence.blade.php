@php
    use App\Helpers\Helper;
@endphp

<div id="blackbox-section" class=" w-full h-auto relative p-4 md:p-8 font-poppins">
    <div class="max-w-7xl my-10 mx-auto">
        <!-- ------------------------- Top Box Section --------------------------- -->
        <div id="blackbox-top" class="blackbox-top max-w-8xl mx-auto">
            <div class="relative rounded-3xl overflow-hidden text-white p-8 md:p-12">
                <!-- Background image -->
                <img src="{{ asset('assets/frontend/images/homepage/homepg.jpg') }}"
                    class="absolute inset-0 w-full h-full object-cover object-top opacity-90">

                <!-- Strong color overlay -->
                <div class="absolute inset-0 bg-primary/70"></div>

                <!-- Content -->
                <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-8 text-center">
                    @foreach ($statistics as $statistic)
                        <div class="flex flex-col items-center">
                            <i class="{{ $statistic->icon }} fa-3x mb-3"></i>
                            <p class="text-3xl font-bold text-white">{{ $statistic->count }}+</p>
                            <p class="mt-2 text-lg">
                                {{ app()->getLocale() == 'en' ? $statistic->name_en : (isset($statistic->name_np) ? $statistic->name_np : $statistic->name_en) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- ------------------------- Bottom Box Section --------------------------- -->
        {{-- <div id="blackbox-bottom"
            class="blackbox-bottom bg-transparent lg:relative lg:top-1/2 w-full h-auto p-4 md:p-5 mt-8">
            <div
                class="relative flex flex-col md:h-[273px] py-[40px] px-[20px] md:px-[40px] items-start rounded-3xl bg-primary md:flex-row justify-between mb-4 overflow-hidden">

                <!-- Background image -->
                <img src="{{ asset('assets/frontend/images/homepage/academic-excellence.jpg') }}"
                    class="absolute inset-0 w-full h-full object-cover object-top opacity-90">

                <!-- Strong color overlay -->
                <div class="absolute inset-0 bg-primary opacity-90"></div>

                <div class="relative z-10 flex flex-col md:flex-row w-full justify-between items-start">
                    <div class="flex-shrink-0">
                        <h2 class="text-3xl md:text-4xl font-bold text-custom-yellow">{!! __('homepage.academic_excellence') !!}</h2>
                    </div>

                    <div class="flex-1 mx-0 md:mx-8 mt-4 md:mt-0">
                        <p class="text-white text-base">{!! __('homepage.academic_excellence_description') !!}</p>
                    </div>

                    <div class="flex-shrink-0 mt-6 md:mt-0">
                        <a href="{{ route('academics') }}"
                            class="bg-white hover:bg-secondary text-primary font-semibold py-3 px-6 rounded-lg transition duration-300">
                            {!! __('homepage.learn_more') !!}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Changed absolute positioning to a grid layout -->
            <div
                class="grid grid-cols-1 lg:absolute lg:top-1/2 lg:mb-[20px] sm:grid-cols-2 lg:grid-cols-5 gap-6 px-[20px] md:px-[40px]">
                @foreach ($academicLevels as $academicLevel)
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h3 class="font-bold text-lg text-center text-primary">
                            {{ app()->getLocale() == 'en' ? $academicLevel->name_en : $academicLevel->name_np ?? $academicLevel->name_en }}
                        </h3>

                        <div class="text-gray-700 text-sm my-4 font-semibold text-center">
                            {!! Helper::stripInlineStyle(
                                app()->getLocale() == 'en'
                                    ? $academicLevel->short_description_en
                                    : $academicLevel->short_description_np ?? $academicLevel->short_description_en,
                            ) !!}
                        </div>

                        <ul class="space-y-2 text-gray-700">
                            @foreach ($academicLevel->classes as $class)
                                <li class="flex items-center">
                                    <span
                                        class="w-6 h-6 flex p-1 items-center justify-center rounded-full bg-primary text-white">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span
                                        class="font-semibold text-sm pl-2">{{ app()->getLocale() == 'en' ? $class->name_en : $class->name_np ?? $class->name_en }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>
</div>

@push('scripts')
    <script>
        gsap.from("#blackbox-top", {
            y: 300,
            opacity: 0,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#blackbox-section",
                start: "top 70%",
            }
        });

        gsap.from("#blackbox-bottom", {
            y: -100,
            opacity: 0,
            delay: 1,
            duration: 2,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#blackbox-section",
                start: "top 50%",
            }
        });
    </script>
@endpush
