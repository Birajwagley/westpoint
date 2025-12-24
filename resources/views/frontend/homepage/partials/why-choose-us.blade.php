<div id="whyChooseUs-section" class='h-auto bg-primary w-full font-poppins'>
    <div class='py-10'>
        <div class='flex flex-col space-y-12 items-center'>
            <div id="para343-title"
                class='w-auto h-11 rounded-[100px] text-center items-center content-center p-3 bg-[#205246]'>
                <p class='text-[#FFFFFF] font-semibold text-base'>{{ __('homepage.why_choose_us') }}</p>
            </div>
            <div id="para343-desc" class='w-full lg:w-[1023px]'>
                <p class='font-medium text-base lg:text-xl text-[#FFFFFF] text-center leading-[50px] px-6'>
                    {{ __('homepage.why_choose_us_description') }}
                </p>
            </div>
            <!-- ------------------------- Cards Grid Section --------------------------- -->
            <div id="all323-box"
                class="grid px-5 xl:mx-20 grid-cols-1 justify-items-center sm:grid-cols-2 lg:grid-cols-3 justify-center mb-4 overflow-hidden gap-14 md:gap-14 lg:gap-14">
                @foreach ($usps as $key => $usp)
                    <div id="para323-box{{ $key }}"
                        class="w-full para232box sm:w-[300px] cursor-pointer md:w-80 h-[360px] flex-[1 1 300px] rounded-[20px] bg-[#4B6860] bg-opacity-[40%] border border-transparent border-opacity-75 hover:border-accent transition-all duration-300">
                        <div class='opacity-[100%] px-3 py-4 flex flex-col space-y-6 items-left'>
                            <h3 class='font-semibold text-base text-accent'>
                                <i class="{{ isset($usp->icon) ? $usp->icon : '' }}"></i>
                                {{ app()->getLocale() == 'en' ? $usp->name_en : (isset($usp->name_np) ? $usp->name_np : $usp->name_en) }}
                            </h3>
                            <p
                                class='font-poppins font-normal text-[#FFFFFF] text-base leading-6 tracking-normal line-clamp-2'>
                                {{ app()->getLocale() == 'en' ? $usp->short_description_en : (isset($usp->short_description_np) ? $usp->short_description_np : $usp->short_description_en) }}
                            </p>

                            <div class="w-full lg: lg:w-72 h-52 relative">
                                <img class="w-full h-full object-cover rounded-xl"
                                    src="{{ asset($usp->thumbnail_image) }}" alt="GBBS" />

                                <div
                                    class="absolute bottom-0 right-0 w-0 h-0 border-l-[70px] border-l-[#4B6860] border-t-[70px] border-t-transparent [transform:rotateY(541deg)] rounded-b-xl">
                                </div>

                                <button
                                    class="absolute bottom-2 right-2 w-8 h-8 flex items-center justify-center bg-accent rounded-full shadow-md hover:scale-110 transition hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-[#1F413B] transform rotate-[-45deg]" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        gsap.registerPlugin(ScrollTrigger);

        const boxes = gsap.utils.toArray(".para232box");

        /* ---------------------------------------------------------
           FASTER & SMOOTH ENTRY ANIMATION
        --------------------------------------------------------- */
        const OFFSET = 160; // slightly lower offset for faster impact

        gsap.set(boxes, { opacity: 0 });

        boxes.forEach((box, index) => {
            const angle = (index / boxes.length) * Math.PI * 2;
            const offsetX = Math.cos(angle) * OFFSET;
            const offsetY = Math.sin(angle) * OFFSET;

            gsap.fromTo(
                box,
                { x: offsetX, y: offsetY, opacity: 0 },
                {
                    x: 0,
                    y: 0,
                    opacity: 1,
                    duration: 0.8,     // FASTER
                    ease: "power3.out",
                    delay: index * 0.03, // FASTER STAGGER
                    scrollTrigger: {
                        trigger: "#all323-box",
                        start: "top 85%",
                        toggleActions: "play none none none",
                    }
                }
            );
        });

        /* ---------------------------------------------------------
           TITLE ANIMATION (FASTER)
        --------------------------------------------------------- */
        gsap.from("#para343-title", {
            y: -50,
            opacity: 0,
            duration: 0.7,   // faster
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#whyChooseUs-section",
                start: "top 85%",
            }
        });

        /* ---------------------------------------------------------
           DESCRIPTION ANIMATION (FASTER)
        --------------------------------------------------------- */
        gsap.from("#para343-desc", {
            y: -50,
            opacity: 0,
            duration: 0.7,   // faster
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#whyChooseUs-section",
                start: "top 85%",
            }
        });

        /* ---------------------------------------------------------
           GRID WRAPPER ANIMATION (FASTER)
        --------------------------------------------------------- */
        gsap.from("#all323-box", {
            x: -50,
            opacity: 0,
            duration: 0.7,   // faster
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#whyChooseUs-section",
                start: "top 85%",
            }
        });

        /* ---------------------------------------------------------
           HOVER ANIMATION
        --------------------------------------------------------- */
        boxes.forEach((box) => {
            const btn = box.querySelector("button");

            box.addEventListener("mouseenter", () => {
                gsap.to(btn, { scale: 1.3, duration: 0.1 });
            });

            box.addEventListener("mouseleave", () => {
                gsap.to(btn, { scale: 1, duration: 0.1 });
            });
        });

    });
</script>
@endpush
