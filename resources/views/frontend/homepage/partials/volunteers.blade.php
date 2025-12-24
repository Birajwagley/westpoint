@php
    use App\Helpers\Helper;
@endphp

<div id="registerYourself-section"
    class="h-auto bg-white flex flex-col lg:flex-row space-y-3 lg:space-y-0 lg:space-x-10 w-full px-6 md:px-28 py-10 overflow-x-hidden relative">
    <!-- ------------------------- Left Section --------------------------- -->
    <div class="flex-1 w-full lg:h-1/2 lg:basis-1/2 h-auto">
        <div class="ds justify-between space-y-6">
            <div id="registeryourself-upper" class="flex space-x-4">
                <h2 class="text-primary opacity-70 font-semibold text-base">
                    {{ __('homepage.register_yourself_with_us') }}
                </h2>
                <span class="w-[44.5px] border-b-2 border-b-secondary mb-2"></span>
            </div>

            <div id="registeryourself-upper" class="flex flex-col justify-between space-y-5">
                <div class="flex flex-row">
                    <h2 class="w-full font-bold text-3xl sm:text-4xl lg:text-5xl text-[#00000]">
                        {!! __('homepage.become_a_volunteer') !!}
                    </h2>
                </div>

                <div id="registeryourself-slide1" class="flex flex-row space-x-2">
                    @php
                        $images = $volunteer->images == '' ? [] : json_decode($volunteer->images);
                    @endphp

                    @foreach ($images as $image)
                        <img src="{{ asset($image) }}" alt="Register Image"
                            class="w-40 object-contain sm:w-60 h-40 sm:h-60 rounded border-2 border-white" />
                    @endforeach
                </div>

                <div id="registeryourself-slide1" class="flex font-normal text-base leading-8 w-full">
                    {!! Helper::stripInlineStyle(
                        app()->getLocale() == 'en'
                            ? $volunteer->description_en ?? ''
                            : $volunteer->description_np ?? ($volunteer->description_en ?? ''),
                    ) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- ------------------------- Right Section --------------------------- -->
    <div class="flex-1  w-full lg:h-1/2 xl:basis-1/3 lg:basis-1/3 2xl:basis-1/2 h-auto">
        <div id="registeryourself-slide2" class="flex flex-col justify-between space-y-4">
            <div>
                <img src="{{ asset('assets/frontend/images/homepage/volunteer-hands.png') }}"
                    alt="Volunteer Hands Image"
                    class="w-full lg:w-[541px] h-auto lg:h-96 rounded-xl border-2 border-white" />
            </div>
            <div class="flex">
                <p class="text-[#000000CC] flex flex-col font-semibold   text-xl leading-8">
                    <span class="font-extrabold">
                        {!! __('homepage.what_we_look_in_volunteers') !!}
                    </span>
                </p>
            </div>
            <div>
                {!! Helper::stripInlineStyle(
                    app()->getLocale() == 'en'
                        ? $volunteer->qualification_en ?? ''
                        : $volunteer->qualification_np ?? ($volunteer->qualification_en ?? ''),
                ) !!}
            </div>

            <div>
                <a href="{{ route('volunteer-page.show') }}"
                    class="w-full sm:w-[183px] text-white text-base font-semibold px-6 py-3 h-12 bg-primary rounded-[100px]">
                    {{ __('pages.register') }}
                </a>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        gsap.from("#registeryourself-slide1", {
            x: -300,
            duration: 1,
            opacity: 0,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#registerYourself-section",
                start: "top bottom",
            }
        });

        gsap.from("#registeryourself-slide2", {
            x: 300,
            autoAlpha: 0, // handles both opacity and visibility
            duration: 1,
            opacity: 0,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#registerYourself-section",
                start: "top bottom",
            }
        });

        gsap.from("#registeryourself-upper", {
            y: 20,
            opacity: 0,
            duration: 0.6,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#registerYourself-section",
                start: "top bottom",
            }
        });
    </script>
@endpush
