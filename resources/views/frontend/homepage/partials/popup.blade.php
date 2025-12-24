@if ($popups->isNotEmpty())
    <div id="popup" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 bg-black/50 items-center justify-center z-50">
        <!-- Popup container -->
        <div class="bg-white rounded-lg shadow-lg relative w-[95%] max-w-3xl max-h-[90vh] overflow-hidden">

            <!-- Close button -->
            <button id="closePopup" class="absolute top-3 right-3 text-primary hover:text-accent text-2xl font-bold z-50">
                <i class="fa fa-times"></i>
            </button>

            <!-- Swiper -->
            <div class="swiper popup-swiper flex-1 relative py-0">
                <div class="swiper-wrapper h-full">

                    @foreach ($popups as $popup)
                        <div class="swiper-slide w-full h-full flex items-center justify-center select-none">
                            <div
                                class="relative w-full h-[60vh] sm:h-[70vh] md:h-[80vh] max-h-[80vh] flex items-center justify-center">

                                <!-- Image -->
                                <img src="{{ asset($popup->image) }}" alt="{{ $popup->name_en }}"
                                    class="max-h-full max-w-full object-contain transition-all duration-300" />

                                <!-- Bottom Center Text -->
                                <div
                                    class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center text-white text-lg font-semibold bg-black/50 px-4 py-1 rounded">
                                    {{ app()->getLocale() == 'en' ? $popup->name_en ?? '' : $popup->name_np ?? ($popup->name_en ?? '') }}
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div
                    class="swiper-button-prev text-primary !hover:text-accent transition absolute top-1/2 -translate-y-1/2 left-2 sm:left-4 text-3xl sm:text-4xl cursor-pointer z-50">
                </div>
                <div
                    class="swiper-button-next text-primary !hover:text-accent transition absolute top-1/2 -translate-y-1/2 right-2 sm:right-4 text-3xl sm:text-4xl cursor-pointer z-50">
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination absolute bottom-2 sm:bottom-3 w-full text-center"></div>
            </div>
        </div>
    </div>
@endif

@push('scripts')
    <script>
        // Close popup on X click
        $('#closePopup').click(function() {
            $('#popup').addClass('hidden').removeClass('flex');
        });

        // Close popup when clicking outside content
        $('#popup').click(function(e) {
            if (e.target.id === 'popup') {
                $(this).addClass('hidden').removeClass('flex');
            }
        });
    </script>
@endpush
