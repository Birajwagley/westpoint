@php
    use App\Enum\AwardTypeEnum;
@endphp

<div id="award-achivement-section" class="h-auto bg-[#ffffff] w-full justify-items-center font-poppins pt-10">
    <div class="flex flex-col w-full">
        <!-- Title -->
        <div id="achivement-title" class="h-16 flex items-center justify-center text-white font-semibold">
            <div class="flex items-center justify-center space-x-3 my-6">
                <span class="w-3 h-3 bg-primary rounded-full"></span>
                <span class="w-3 h-3 bg-primary rounded-full"></span>
                <span class="text-primary font-bold text-xl opacity-70 font-poppins">
                    {{ __('homepage.highlights_of_excellence') }}
                </span>
                <span class="w-3 h-3 bg-primary rounded-full"></span>
                <span class="w-3 h-3 bg-primary rounded-full"></span>
            </div>
        </div>

        <!-- Toggle Buttons / Tabs -->
        <div class="flex flex-col w-full h-auto px-6 md:px-28 space-y-14 py-10">
            <div id="achivement-buton" class="flex flex-row space-x-12">
                <div class="bg-transparent relative">
                    <button id="achievements-btn"
                        class="text-primary border-none mb-1 bg-transparent font-semibold text-base">
                        {{ __('homepage.achivements') }}
                    </button>
                    <div id="hover-achievement" class="bg-primary w-[60%] h-[2px] left-0 absolute bottom-0"></div>
                </div>
                <div class="bg-transparent relative">
                    <button id="awards-btn"
                        class="text-primary border-none opacity-70 mb-1 bg-transparent font-semibold text-base">
                        {{ __('homepage.awards') }}
                    </button>
                    <div id="hover-award" class="bg-primary w-[60%] h-[2px] left-0 absolute bottom-0"></div>
                </div>
            </div>

            <!-- Achievements Section -->
            <div id="achivement-section" class="flex-col">
                <div id="achivement-desc" class="items-center self-center">
                    <p class="text-[#000000] lg:w-[902px] font-medium text-base text-center">
                        {{ __('homepage.achivement_description') }}
                    </p>
                </div>
                <div class="flex items-center flex-col justify-between w-full lg:w-auto space-x-4">
                    <div class="swiper w-full">
                        <div class="swiper-wrapper">
                            @foreach ($achivements as $achivement)
                                <div class="swiper-slide w-48 rounded-xl h-96 bg-[#FFFFFF] shadow-lg">
                                    <div class="relative flex flex-col w-full h-full justify-between">
                                        <div class="bg-primary justify-items-center w-full rounded-tl-xl p-2 rounded-tr-xl">
                                            <img src="{{ $setting->primary_logo }}" alt="card-image"
                                                class="w-36 opacity-75 h-40 mx-auto" />
                                        </div>
                                        <div class="absolute top-1/2 left-1/2 bg-white p-1 rounded-full transform -translate-x-1/2 -translate-y-1/2">
                                            <img src="{{ asset($achivement->image) }}" alt="card-image"
                                                class="w-32 h-32 rounded-full bg-primary border-4 border-white" />
                                        </div>
                                        <div class="text-[#000000] flex flex-col items-center py-10 px-5 space-y-2">
                                            <p class="font-semibold text-xl">
                                                {{ app()->getLocale() == 'en' ? $achivement['title_en'] ?? '' : $achivement['title_np'] ?? ($achivement['title_en'] ?? '') }}
                                            </p>
                                            <span class="font-medium text-sm text-center">
                                                {{ app()->getLocale() == 'en' ? $achivement['short_description_en'] ?? '' : $achivement['short_description_np'] ?? ($achivement['short_description_en'] ?? '') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Achievements Navigation -->
                    <div class="flex flex-row items-center justify-center w-full lg:w-auto space-x-4 mt-4">
                        <span class="swiper-button-prev-achievement flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                            <i class="fa-solid fa-chevron-left"></i>
                        </span>
                        <span class="swiper-button-next-achievement flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Awards Section -->
            <div id="award-section" class="flex-col" style="display:none">
                <div class="items-center self-center">
                    <p class="text-[#000000] lg:w-[902px] font-medium text-base text-center">
                        {{ __('homepage.award_description') }}
                    </p>
                </div>
                <div class="flex items-center flex-col justify-between w-full lg:w-auto space-x-4">
                    <div class="swiper w-full">
                        <div class="swiper-wrapper">
                            @foreach ($awards as $award)
                                <div class="swiper-slide w-full md:w-72 rounded-xl h-96 bg-primary shadow-lg">
                                    <div class="relative flex flex-col w-full h-full justify-between">
                                        <div class="bg-primary absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 justify-items-center w-full rounded-tl-xl p-2 rounded-tr-xl">
                                            <img src="{{ $setting->primary_logo }}" alt="card-image" class="w-56 md:w-56 opacity-10 h-60 mx-auto" />
                                        </div>
                                        <div class="bg-transparent absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 justify-items-center w-full rounded-tl-xl p-2 rounded-tr-xl">
                                            <img src="{{ asset('assets/frontend/images/homepage/malatrans.png') }}" alt="card-image" class="w-64 md:w-64 h-64 mx-auto" />
                                        </div>

                                        @php
                                            $color = $award->award_type == AwardTypeEnum::GOLD->value
                                                ? 'bg-[#FFD700]/60'
                                                : ($award->award_type == AwardTypeEnum::SILVER->value
                                                    ? 'bg-[#C0C0C0]/60'
                                                    : 'bg-[#CD7F32]/60');
                                        @endphp

                                        <div class="bg-transparent absolute inset-0 flex items-center justify-center">
                                            <div class="flex flex-col items-center space-y-3">
                                                <span class="{{ $color }} px-5 py-2 text-center w-20 h-8 rounded-xl text-[#FFFFFF] font-bold text-sm">
                                                    {{ AwardTypeEnum::map($award->award_type) }}
                                                </span>
                                                <h3 class="text-[#FFFFFF] text-center font-semibold text-xl">
                                                    {{ __('homepage.winner') }}
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="bg-transparent absolute bottom-0 left-0 right-0 p-4">
                                            <div class="mom flex flex-col items-center space-y-1">
                                                <p class="text-[#FFFFFF] text-center font-semibold opacity-60 text-sm">
                                                    {{ app()->getLocale() == 'en' ? $award['title_en'] ?? '' : $award['title_np'] ?? ($award['title_en'] ?? '') }}
                                                </p>
                                                <p class="text-[#FFFFFF] text-center font-semibold text-sm">
                                                    {{ app()->getLocale() == 'en' ? $award['short_description_en'] ?? '' : $award['short_description_np'] ?? ($award['short_description_en'] ?? '') }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Awards Navigation -->
                    <div class="flex flex-row items-center justify-center w-full lg:w-auto space-x-4 mt-4">
                        <span class="swiper-button-prev-award flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                            <i class="fa-solid fa-chevron-left"></i>
                        </span>
                        <span class="swiper-button-next-award flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full bg-secondary text-white cursor-pointer">
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
window.addEventListener('DOMContentLoaded', () => {

    // ------------------- Tab Logic -------------------
    const achievementSection = document.getElementById("achivement-section");
    const awardSection = document.getElementById("award-section");
    const achievementBtn = document.getElementById("achievements-btn");
    const awardBtn = document.getElementById("awards-btn");
    const achievementHover = document.getElementById("hover-achievement");
    const awardHover = document.getElementById("hover-award");

    function showTab(tab) {
        if(tab === 'achievements') {
            achievementSection.style.display = 'flex';
            awardSection.style.display = 'none';
            achievementBtn.classList.add('font-semibold');
            awardBtn.classList.remove('font-semibold');
            achievementHover.style.opacity = '1';
            awardHover.style.opacity = '0';
        } else {
            achievementSection.style.display = 'none';
            awardSection.style.display = 'flex';
            achievementBtn.classList.remove('font-semibold');
            awardBtn.classList.add('font-semibold');
            achievementHover.style.opacity = '0';
            awardHover.style.opacity = '1';
        }
    }

    showTab('achievements');

    achievementBtn.addEventListener('click', () => showTab('achievements'));
    awardBtn.addEventListener('click', () => showTab('awards'));

    // ------------------- GSAP Animations -------------------
    const gsapTargets = ["#achivement-buton", "#achivement-title", "#achivement-desc"];
    gsapTargets.forEach(id => {
        gsap.from(id, {
            y: -200,
            opacity: 0,
            duration: 2,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#award-achivement-section",
                start: "top 80%"
            }
        });
    });

    // Animate slides dynamically
    document.querySelectorAll("#award-achivement-section .swiper-slide").forEach((slide, index) => {
        gsap.from(slide, {
            x: index % 2 === 0 ? -400 : 400,
            opacity: 0,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#award-achivement-section",
                start: "top 80%"
            }
        });
    });

    // ------------------- Swiper Initialization -------------------
    new Swiper("#achivement-section .swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: ".swiper-button-next-achievement",
            prevEl: ".swiper-button-prev-achievement"
        },
        breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 20 },
            1280: { slidesPerView: 3, spaceBetween: 20 },
            1440: { slidesPerView: 4, spaceBetween: 20 }
        }
    });

    new Swiper("#award-section .swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: ".swiper-button-next-award",
            prevEl: ".swiper-button-prev-award"
        },
        breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 20 },
            1280: { slidesPerView: 3, spaceBetween: 20 },
            1440: { slidesPerView: 4, spaceBetween: 20 }
        }
    });

});
</script>
@endpush
