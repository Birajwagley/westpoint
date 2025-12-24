@php
    use App\Enum\GalleryTypeEnum;
@endphp

@push('styles')
    <style>
        /* Swiper fade-in effect */
        #section-gallary .swiper {
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        #section-gallary .swiper.ready {
            opacity: 1;
        }

        #section-gallary .swiper-slide {
            transition: transform 0.5s ease;
        }

        /* Video wrapper for responsive iframe */
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 */
            height: 0;
            overflow: hidden;
            border-radius: 10px;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Modal responsiveness */
        @media (max-width: 640px) {
            #videoGalleryModal>div {
                max-height: 90vh;
            }
        }
    </style>
@endpush

<div id="gallary-section" class="bg-primary w-full font-poppins overflow-hidden">
    <div class="flex flex-col py-6 lg:py-12">
        <!-- Gallery Title -->
        <div id="galary-title" class="flex items-center justify-center mb-6">
            <div class="bg-[#205246] rounded-full px-6 py-2 flex items-center justify-center">
                <p class="text-white font-semibold text-base">{{ __('homepage.image_video_gallery') }}</p>
            </div>
        </div>

        <!-- Swiper Gallery -->
        <div id="section-gallary"
            class="flex flex-col relative w-full justify-center items-center px-4 sm:px-8 md:px-[9%] overflow-hidden">
            <div class="swiper w-full max-w-7xl mx-auto px-6">
                <div class="swiper-wrapper">
                    @foreach ($galleries as $gallery)
                        <div
                            class="swiper-slide rounded-xl w-64 sm:w-72 md:w-80 lg:w-[315px] h-64 sm:h-80 md:h-96 lg:h-[422px] relative">

                            @if ($gallery->type == GalleryTypeEnum::IMAGE->value)
                                <!-- IMAGE → Redirect to detail page -->
                                <a href="{{ route('gallery-detail', $gallery->slug) }}" class="block w-full h-full">
                                    <img src="{{ asset($gallery->cover_image) }}"
                                        class="w-full h-full object-cover rounded-xl shadow-lg">
                                </a>
                            @else
                                <!-- VIDEO Thumbnail -->
                                <img src="{{ asset($gallery->cover_image) }}"
                                    class="w-full h-full object-cover rounded-xl shadow-lg">

                                <!-- Play Button (Open Video Modal) -->
                                <button
                                    class="absolute inset-0 flex items-center justify-center bg-black/40 hover:bg-black/50 rounded-xl transition"
                                    data-video-url="{{ $gallery->value }}" onclick="openVideoModal(this)">
                                    <span
                                        class="flex items-center gap-2 text-white font-semibold text-lg py-2 rounded-full shadow-md">
                                        <i class="fa-solid fa-circle-play fa-2xl"></i>
                                    </span>
                                </button>
                            @endif

                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- Swiper Navigation -->
            <div id="galary-button" class="flex items-center justify-center space-x-4 mt-6">
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

<!-- Video Modal -->
<div id="videoGalleryModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
    <div
        class="relative w-full max-w-4xl sm:max-w-3xl md:max-w-4xl lg:max-w-5xl bg-black rounded-xl overflow-hidden shadow-lg
                flex items-center justify-center max-h-[90vh]">
        <!-- Close Button -->
        <button id="closeVideoGalleryModal"
            class="absolute top-3 right-3 text-white text-2xl font-bold hover:text-gray-300 transition z-50">
            &times;
        </button>

        <!-- Video Frame Wrapper -->
        <div class="w-full h-full relative aspect-video">
            <iframe id="videoGalleryFrame" src="" title="Video Player" allowfullscreen
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                class="absolute top-0 left-0 w-full h-full rounded-xl">
            </iframe>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        gsap.from("#gallary-section #galary-title", {
            y: -200,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#gallary-section",
                start: "top 80%",
            }
        });

        gsap.from("#gallary-section #galary-button", {
            y: 200,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#gallary-section",
                start: "top 80%",
            }
        });

        var swiper = new Swiper("#gallary-section .swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            initialSlide: 1,
            spaceBetween: -80,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 80,
                modifier: 1,
                slideShadows: true
            },
            loop: true,
            pagination: {
                el: "#gallary-section .swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: "#gallary-section .swiper-button-next-custom",
                prevEl: "#gallary-section .swiper-button-prev-custom"
            },
            on: {
                init: function() {
                    // ✅ Force the transforms to render as if a slide change happened
                    this.update();
                    this.slideTo(this.activeIndex, 0, false);
                    this.setTranslate(); // <— this line is key!
                    this.setTransition(0);

                    document.querySelector("#section-gallary .swiper").classList.add("ready");
                }
            }
        });

        const videoModal = document.getElementById('videoGalleryModal');
        const videoFrame = document.getElementById('videoGalleryFrame');
        const closeModal = document.getElementById('closeVideoGalleryModal');

        function openVideoModal(button) {
            const url = button.dataset.videoUrl;
            if (!url) return;
            videoFrame.src = url + '?autoplay=1';
            videoModal.classList.remove('hidden');
        }

        closeModal.addEventListener('click', () => {
            videoModal.classList.add('hidden');
            videoFrame.src = '';
        });

        videoModal.addEventListener('click', (e) => {
            if (e.target === videoModal) {
                videoModal.classList.add('hidden');
                videoFrame.src = '';
            }
        });
    </script>
@endpush
