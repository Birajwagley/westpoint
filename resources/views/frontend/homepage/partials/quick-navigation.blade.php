@php
    use App\Enum\MenuTypeEnum;
@endphp

<section class="w-full py-8 relative z-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">
        <!-- Sticky Navigation Bar -->
        <div id="yourGateway-carousel"
            class="relative  flex flex-col lg:flex-row items-center justify-center w-full max-w-[1070px] mx-auto bg-primary rounded-2xl shadow-xl p-4 sm:p-6 lg:p-8 z-10">
            <!-- Title -->
            <div class="w-full lg:w-[380px] mb-4 lg:mb-0 flex items-center justify-center lg:justify-start">
                <h2 class="text-white font-heading font-semibold text-xl sm:text-base lg:text-4xl text-center">
                    {{ __('homepage.your_gateway_to_growth') }}
                </h2>
            </div>

            <div class="flex slider-container items-center justify-between w-full lg:w-auto space-x-4">
                <span id="wrapper-first"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-secondary text-accent cursor-pointer text-sm sm:text-base">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>

                <div
                    class="flex slides-wrapper scroll-smooth overflow-x-auto no-scrollbar w-full sm:w-[calc(2*128px+1rem)] md:w-[600px] bg-primary px-2 gap-4 sm:gap-6 md:gap-10 py-2 rounded-lg">
                    @foreach ($quickNavs as $quickNav)
                        <a href="{{ $quickNav->type == MenuTypeEnum::SLUG->value ? url($quickNav->slug) : $quickNav->external_link }}"
                            id="slideItem"
                            class="w-28 sm:w-1/2 min-w-[128px] h-28 sm:h-32 rounded-[10px] bg-accent flex flex-col items-center justify-center space-y-2 p-2">

                            <i class="{{ $quickNav->icon }} fa-3x text-primary"></i>

                            <p class="font-semibold text-sm sm:text-base text-primary text-center">
                                {{ app()->getLocale() == 'en' ? $quickNav->name_en : (isset($quickNav->name_np) ? $quickNav->name_np : $quickNav->name_en) }}
                            </p>
                        </a>
                    @endforeach
                </div>

                <span id="wrapper-second"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-secondary text-accent cursor-pointer text-sm sm:text-base">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</section>
