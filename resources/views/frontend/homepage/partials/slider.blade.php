@php
use App\Models\Slider;

// Prepare slider data
$slidesData = $sliders->map(function($slide) {
    return [
        'img' => $slide->image ? asset($slide->image) : '',
        'title' => $slide->name_en,
        'btn' => $slide->link ?? '#',
        'rightTitle' => $slide->name_en,
        'desc1' => $slide->name_en,
        'desc2' => $slide->name_en
    ];
});
@endphp

<section class="relative w-full h-[100vh] overflow-hidden">
    <div class="grid grid-cols-12 h-full">
        <!-- Left slider -->
        <div class="col-span-12 lg:col-span-9 relative overflow-hidden">
            <div class="swiper leftSwiper h-full">
                <div class="swiper-wrapper">
                    <!-- Slides injected by JS -->
                </div>
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
            </div>

            <!-- Left text -->
            <div class="absolute left-10 lg:left-20 top-1/2 -translate-y-1/2 text-white max-w-xl lg:max-w-2xl z-10">
                <h1 id="heroTitle"
                    class="text-3xl sm:text-4xl md:text-5xl lg:text-[64px] font-bold leading-snug sm:leading-tight"></h1>
                <a id="heroBtn" href="#"
                    class="inline-block mt-6 sm:mt-8 lg:mt-10 bg-red-600 px-6 py-3 sm:px-8 sm:py-4 text-xs sm:text-sm font-semibold tracking-wide rounded-md"></a>
            </div>

            <!-- Slide counter -->
            <div
                class="absolute bottom-6 sm:bottom-8 lg:bottom-12 left-10 lg:left-20 text-white text-xs sm:text-sm tracking-widest z-10">
                <span id="currentSlide">01</span>
                <span class="opacity-50"> / {{ $sliders->count() }}</span>
            </div>
        </div>

        <!-- Right content -->
        <div
            class="col-span-12 lg:col-span-3 relative bg-gradient-to-br from-[#0b0f2b] via-[#0e153a] to-[#090c24] text-white flex items-center justify-center sm:justify-start overflow-visible">
            <div class="relative w-full px-6 sm:px-10 py-8 sm:py-14">
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <span class="w-8 sm:w-10 h-[2px] bg-red-500"></span>
                        <p id="rightTitle"
                            class="uppercase text-[10px] sm:text-xs tracking-[0.15em] sm:tracking-[0.25em] text-gray-300"></p>
                    </div>

                    <h3 class="text-lg sm:text-xl md:text-2xl font-semibold leading-snug"></h3>
                    <p id="rightDesc1" class="text-xs sm:text-sm leading-relaxed text-gray-300"></p>
                    <p id="rightDesc2" class="text-xs sm:text-sm leading-relaxed text-gray-400"></p>
                </div>

                <div class="relative -mr-4 sm:-mr-10 mt-4 sm:mt-8">
                    <p class="mb-2 text-[10px] sm:text-xs uppercase tracking-widest text-gray-400">
                        Explore Highlights
                    </p>
                    <div class="swiper rightSwiper">
                        <div class="swiper-wrapper">
                            <!-- Thumbnails injected via JS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Swiper JS & CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
const slidesData = @json($slidesData);

// Inject slides for left swiper
const leftWrapper = document.querySelector('.leftSwiper .swiper-wrapper');
slidesData.forEach(slide => {
    const div = document.createElement('div');
    div.className = 'swiper-slide relative';
    div.innerHTML = `<img src="${slide.img}" class="w-full h-full object-cover">
                     <div class="absolute inset-0 bg-black/30"></div>`;
    leftWrapper.appendChild(div);
});

// Inject thumbnails for right swiper
const rightWrapper = document.querySelector('.rightSwiper .swiper-wrapper');
slidesData.forEach(slide => {
    const div = document.createElement('div');
    div.className = 'swiper-slide w-16 h-16 sm:w-24 sm:h-24 cursor-pointer';
    div.innerHTML =
        `<img src="${slide.img}" class="w-full h-full object-cover rounded-md border-2 border-transparent">`;
    rightWrapper.appendChild(div);
});

// Initialize Swipers
const rightSwiper = new Swiper(".rightSwiper", {
    spaceBetween: 10,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
        640: { slidesPerView: 4 },
        768: { slidesPerView: 3 },
    }
});

const leftSwiper = new Swiper(".leftSwiper", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: { swiper: rightSwiper },
    on: {
        slideChange: function() {
            const idx = this.activeIndex;
            const data = slidesData[idx];
            document.getElementById('heroTitle').innerHTML = data.title;
            document.getElementById('heroBtn').textContent = data.btn;
            document.getElementById('heroBtn').href = data.btn ?? '#';
            document.getElementById('rightTitle').textContent = data.rightTitle;
            document.getElementById('rightDesc1').textContent = data.desc1;
            document.getElementById('rightDesc2').textContent = data.desc2;
            document.getElementById('currentSlide').textContent = String(idx + 1).padStart(2, '0');
        }
    }
});

// Set initial content
const initial = slidesData[0];
document.getElementById('heroTitle').innerHTML = initial.title;
document.getElementById('heroBtn').textContent = initial.btn;
document.getElementById('heroBtn').href = initial.btn ?? '#';
document.getElementById('rightTitle').textContent = initial.rightTitle;
document.getElementById('rightDesc1').textContent = initial.desc1;
document.getElementById('rightDesc2').textContent = initial.desc2;
</script>
