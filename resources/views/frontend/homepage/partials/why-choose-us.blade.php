<div id="whyChooseUs-section" class="relative w-full font-poppins overflow-hidden
           ">
    <!-- Background image -->
    <img src="{{ asset('assets/frontend/images/homepage/homepg.jpg') }}"
        class="absolute inset-0 w-full h-full object-cover object-top opacity-90">

    <!-- Strong color overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0B0F2E] via-[#12163A] to-[#090B1F] opacity-85"></div>
    <!-- Academic Red Glow -->
    <div
        class="absolute -top-32 -right-32 w-[420px] h-[420px]
                bg-[#990400]/20 blur-[120px] rounded-full">
    </div>

    <div
        class="absolute bottom-0 -left-32 w-[360px] h-[360px]
                bg-[#990400]/20 blur-[120px] rounded-full">
    </div>

    <div class="relative py-16">
        <div class="flex flex-col space-y-12 items-center">
            <div class="mx-auto max-w-4xl text-center">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <h2 class="uppercase tracking-[0.3em] font-semibold text-white text-sm md:text-base">
                        {{ __('homepage.why_choose_us') }}
                    </h2>
                    <div class="flex gap-1.5">
                        <span class="w-8 h-3 bg-white"></span>
                        <span class="w-4 h-3 bg-white"></span>
                    </div>
                </div>

                <h1 class="font-bold text-3xl sm:text-4xl lg:text-5xl text-white mb-6 leading-tight">
                    What Sets Us Apart

                </h1>

                <p class="text-white text-base md:text-lg leading-relaxed">
                    Discover why thousands of parents trust us with their children's education and future.

                </p>
            </div>

            <!-- Cards Grid -->
            <div id="all323-box"
                class="grid px-5 xl:mx-20
                       grid-cols-1 sm:grid-cols-2 lg:grid-cols-3
                       justify-items-center gap-14 mb-4">

                @foreach ($usps as $key => $usp)
                    <div id="para323-box{{ $key }}"
                        class="para232box group relative w-full sm:w-[300px] md:w-80 h-[360px]
                               rounded-2xl
                               bg-white/5 backdrop-blur-xl
                               border border-white/10
                               shadow-lg shadow-black/20
                               hover:border-[#990400]/50
                               hover:shadow-[#990400]/30
                               hover:-translate-y-2
                               transition-all duration-500 cursor-pointer">

                        <div class="px-5 py-5 flex flex-col space-y-5">

                            <!-- Card Title -->
                            <h3 class="font-semibold text-base text-white flex items-center gap-3">
                                <span class="text-[#990400] text-lg">
                                    <i class="{{ $usp->icon ?? '' }}"></i>
                                </span>
                                {{ app()->getLocale() == 'en' ? $usp->name_en : $usp->name_np ?? $usp->name_en }}
                            </h3>

                            <!-- Card Description -->
                            <p
                                class='font-poppins font-normal text-[#FFFFFF] text-base leading-6 tracking-normal line-clamp-2'>
                                {{ app()->getLocale() == 'en' ? $usp->short_description_en : (isset($usp->short_description_np) ? $usp->short_description_np : $usp->short_description_en) }}
                            </p>

                            <!-- Image -->
                            <div class="relative w-full h-52 rounded-xl overflow-hidden">

                                <img class="w-full h-full object-cover
                                           transition-transform duration-700
                                           group-hover:scale-110"
                                    src="{{ asset('assets/frontend/images/about-us/trademark-logo.jpg') }}"
                                    alt="WPHS" />

                                <!-- Hover Overlay -->
                                <div
                                    class="absolute inset-0
                                            bg-gradient-to-t
                                            from-[#990400]/40
                                            via-transparent
                                            to-transparent
                                            opacity-0 group-hover:opacity-100
                                            transition">
                                </div>

                                <!-- CTA Button -->
                                <button
                                    class="absolute bottom-3 right-3 w-9 h-9
                                           flex items-center justify-center
                                           rounded-full
                                           bg-[#990400]/90 text-white
                                           backdrop-blur
                                           shadow-lg shadow-black/30
                                           group-hover:scale-110
                                           transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-[-45deg]"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

            gsap.set(boxes, {
                opacity: 0
            });

            boxes.forEach((box, index) => {
                const angle = (index / boxes.length) * Math.PI * 2;
                const offsetX = Math.cos(angle) * OFFSET;
                const offsetY = Math.sin(angle) * OFFSET;

                gsap.fromTo(
                    box, {
                        x: offsetX,
                        y: offsetY,
                        opacity: 0
                    }, {
                        x: 0,
                        y: 0,
                        opacity: 1,
                        duration: 0.8, // FASTER
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
                duration: 0.7, // faster
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
                duration: 0.7, // faster
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
                duration: 0.7, // faster
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
                    gsap.to(btn, {
                        scale: 1.3,
                        duration: 0.1
                    });
                });

                box.addEventListener("mouseleave", () => {
                    gsap.to(btn, {
                        scale: 1,
                        duration: 0.1
                    });
                });
            });

        });
    </script>
@endpush
