@php
    use App\Helpers\Helper;
    use App\Enum\PerspectiveFromEnum;
@endphp

<div id="Testimonials-section"
    class="overflow-hidden lg:p-10 px-5 py-5 flex flex-col lg:flex-row lg:gap-12 mx-6 md:ml-20">
    <!-- ------------------------- Testimonials Description Section --------------------------- -->
    <div id="Testimonials-desc" class="w-full h-auto self-start lg:w-1/2">
        <div class="flex flex-col space-y-4">
            <div class="justify-items-start">
                <div class="flex items-center justify-center space-x-3 my-6">
                    <span class="w-3 h-3 bg-primary rounded-full"></span>
                    <span class="w-3 h-3 bg-primary rounded-full"></span>
                    <span class="text-primary font-bold text-xl">{{ __('homepage.testimonials') }}</span>
                    <span class="w-3 h-3 bg-primary rounded-full"></span>
                    <span class="w-3 h-3 bg-primary rounded-full"></span>
                </div>
            </div>
            <div class="justify-items-start">
                <h2 class="text-primary font-bold text-2xl lg:text-[40px]">
                    {{ __('homepage.hear_it_from_our_family') }}</h2>
            </div>
            <div class="justify-items-start">
                <p class="text-[#000000] font-medium text-base">“{{ __('homepage.testimonial_description') }}”</p>
            </div>
        </div>
    </div>

    <!-- ------------------------- Testimonials Cards Section --------------------------- -->
    <div id="Testimonials-cards" class="w-full lg:w-1/2 ">
        <div class="swiper w-full flex flex-col space-y-3 bg-transparent">
            <div class="swiper-wrapper bg-transparent py-6">
                @foreach ($testimonials as $testimonial)
                    <div
                        class="w-full justify-between swiper-slide max-w-xs sm:max-w-sm md:max-w-md lg:max-w-[303px] relative flex flex-col border-none h-[412px] rounded-xl shadow-lg transition-all duration-300 ease-in-out">
                        <div class="w-full h-40 sm:h-44 md:h-48 lg:h-[166px] relative">
                            <img class="w-full h-full object-contain rounded-tl-xl rounded-tr-xl"
                                src="{{ asset($testimonial->image) }}" alt="Testimonial Image" />
                            <div
                                class="bg-secondary absolute bottom-[-1.5rem] left-6 flex items-center justify-center w-12 h-12 rounded-full">
                                <i class="fa-solid fa-quote-left text-accent"></i>
                            </div>
                        </div>

                        <div class="flex flex-col px-4 pt-5 pb-6 space-y-6">
                            <div
                                class="font-medium text-[#000000] text-xs sm:text-xs leading-relaxed break-words line-clamp-[8] ">
                                {!! Helper::stripInlineStyle($testimonial->testimonial_text) !!}
                            </div>

                            <div class="flex flex-col space-y-1">
                                <p class="font-semibold text-xs sm:text-xs text-primary">{{ $testimonial->full_name }}
                                </p>
                                <span
                                    class="text-[#000000] font-medium text-xs sm:text-xs">{{ $testimonial->perspective_from == PerspectiveFromEnum::ALUMNI->value
                                        ? 'Batch of ' . $testimonial->alumni->batch
                                        : PerspectiveFromEnum::map($testimonial->perspective_from) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ------------------------- Navigation Buttons ----------------------------->
            <div id="testa-button"
                class="flex flex-row items-center justify-center  lg:justify-start lg:ml-12 w-full lg:w-auto space-x-4">
                <span
                    class="swiper-button-prev-custom flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
                <span
                    class="swiper-button-next-custom flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        gsap.from("#Testimonials-desc", {
            x: -300,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#Testimonials-section",
                start: "top 80%",
            }
        });

        gsap.from("#Testimonials-cards", {
            x: 300,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#Testimonials-section",
                start: "top 80%",
            }
        });

        var swiper = new Swiper("#Testimonials-cards .swiper", {
            loop: true,
            pagination: {
                el: "#Testimonials-cards .swiper-pagination",
                clickable: true
            },
            watchOverflow: true,
            navigation: {
                nextEl: "#Testimonials-cards .swiper-button-next-custom",
                prevEl: "#Testimonials-cards .swiper-button-prev-custom"
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                360: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1536: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            }
        });
    </script>
@endpush
