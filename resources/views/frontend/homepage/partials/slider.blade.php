<div class="slider-swiper relative w-full z-0">
    <div class="swiper-wrapper">
        @if ($sliders && $sliders->count() > 0)

            @foreach ($sliders as $slider)
                <div class="swiper-slide relative w-full  h-[30vh] sm:h-[30vh] md:h-[50vh] lg:h-[60vh] xl:h-[70vh]">
                    <img src="{{ asset($slider->image) }}" alt="Gyanodaya School Homepage"
                        class="w-full h-full object-cover object-center" loading="lazy" />

                    <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
                </div>
            @endforeach
        @else
            <div class="swiper-slide flex items-center justify-center h-[200px] lg:h-[250px] bg-gray-100 text-gray-700">
                {{ __('pages.no_details') }}
            </div>
        @endif

    </div>

    <!-- Pagination & Navigation -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

@push('scripts')
    <script>
        new Swiper('.slider-swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.slider-swiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.slider-swiper .swiper-button-next',
                prevEl: '.slider-swiper .swiper-button-prev',
            },
            effect: 'fade',
            speed: 800,
        });
    </script>
@endpush
