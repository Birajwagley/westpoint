@php
    use App\Helpers\Helper;
@endphp

<section class="relative overflow-hidden bg-background py-20 lg:py-28">
    <div class="container mx-auto px-4">

        <!-- Header -->
        <div class="mx-auto max-w-4xl text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <h2 class="uppercase tracking-[0.3em] font-semibold text-primary text-sm md:text-base">
                    {{ __('homepage.introduction') }}
                </h2>
                <div class="flex gap-1.5">
                    <span class="w-8 h-3 bg-primary"></span>
                    <span class="w-4 h-3 bg-primary"></span>
                </div>
            </div>

            <h1 class="font-bold text-3xl sm:text-4xl lg:text-5xl text-primary mb-6 leading-tight">
                {!! __('homepage.welcome_to_gbbs') !!}
            </h1>

            <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, perferendis.
            </p>
        </div>

        <!-- Main Content -->
        <div class="grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">

            <!-- Image -->
            <div class="relative group">
                <div
                    class="absolute -top-4 -left-4 w-28 h-28 rounded-2xl bg-gradient-to-r from-yellow-400 to-yellow-200 opacity-60">
                </div>
                <div
                    class="absolute -bottom-4 -right-4 w-36 h-36 rounded-2xl bg-gradient-to-r from-indigo-400 to-purple-400 opacity-40">
                </div>

                <img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=800&q=80"
                    alt="Students learning"
                    class="relative rounded-2xl shadow-2xl w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-[1.04]" />

                <!-- Floating Badge -->
                <div
                    class="absolute -bottom-6 right-4 lg:-right-6 bg-white rounded-xl p-4 shadow-xl border opacity-0 translate-y-6 transition-all duration-700 group-hover:opacity-100 group-hover:translate-y-0">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-r from-yellow-400 to-yellow-200">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-bold">A+ Rated</p>
                            <p class="text-sm text-gray-500">District Excellence</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div>
                <span class="inline-block mb-4 px-4 py-2 rounded-full bg-primary/10 text-primary text-sm font-medium">
                    About Our School
                </span>

                <h2 class="text-2xl md:text-4xl font-bold text-foreground mb-6 leading-snug">
                    Nurturing Excellence Since
                    <span class="bg-clip-text text-transparent bg-primary">
                        1985
                    </span>
                </h2>

                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, iste atque nam facere suscipit
                    totam esse! Quis cum eveniet temporibus, culpa voluptatibus aspernatur, qui deleniti quam ea esse
                    corporis voluptate!D Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, in! Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit. Suscipit, nam?
                </p>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, iste atque nam facere suscipit
                    totam esse! Quis cum eveniet temporibus, culpa voluptatibus aspernatur, qui deleniti quam ea esse
                    corporis voluptate!D
                </p>



                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-4">
                    <div class="rounded-xl bg-primary/10 p-5 text-center hover:scale-105 transition">
                        <p class="text-2xl font-bold">2,500+</p>
                        <p class="text-sm text-gray-500">Students</p>
                    </div>

                    <div class="rounded-xl bg-primary/10 p-5 text-center hover:scale-105 transition">
                        <p class="text-2xl font-bold">120+</p>
                        <p class="text-sm text-gray-500">Faculty</p>
                    </div>

                    <div class="rounded-xl bg-primary/10 p-5 text-center hover:scale-105 transition">
                        <p class="text-2xl font-bold">39+</p>
                        <p class="text-sm text-gray-500">Years</p>
                    </div>

                    <div class="rounded-xl bg-primary/10 p-5 text-center hover:scale-105 transition">
                        <p class="text-2xl font-bold">98%</p>
                        <p class="text-sm text-gray-500">Pass Rate</p>
                    </div>
                </div>

                <a href="{{ route('about-us') }}" target="_blank"
                    class="w-[150px] tracking-wide flex items-center gap-2 shadow-xl text-base bg-primary backdrop-blur-md lg:font-semibold relative px-4 py-2 overflow-hidden rounded-full group text-white
                        before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0
                        before:rounded-full before:bg-secondary hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700">

                    {{ __('homepage.about_us') }}

                    <svg class="w-8 h-8 justify-end group-hover:rotate-90 bg-white text-white ease-linear duration-300 rounded-full border border-white group-hover:border-none p-2 rotate-45"
                        viewBox="0 0 16 19">
                        <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054
                                            0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711
                                            6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                            class="fill-gray-800 text-white">
                        </path>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>



{{-- <section id="about-us-section" class="lg:pt-20 mx-4 md:mx-20 lg:mx-20 overflow-hidden">
    <div class="px-4 sm:px-8 md:px-16 lg:px-28 py-10 relative overflow-hidden">

        <!-- Image Column -->
        <div class="relative w-full md:w-[420px] lg:w-[400px] float-none lg:float-left mb-10 lg:mb-8 lg:mr-10">

            <!-- Main Image -->
            <img id="about-us-1"
                src="{{ $aboutUs->image_one ? asset($aboutUs->image_one) : asset('assets/frontend/images/about-us/studying.jpg') }}"
                alt="Main Image" class="w-full h-64 sm:h-[28rem] md:h-[26rem] rounded-lg object-cover">

            <!-- Top-left small image -->
            <img id="about-us-2"
                src="{{ $aboutUs->image_two ? asset($aboutUs->image_two) : asset('assets/frontend/images/about-us/homepage.jpg') }}"
                alt="Top Left"
                class="absolute -top-6 -left-6 w-24 h-24 sm:w-40 sm:h-40 md:w-32 md:h-32 lg:w-40 lg:h-40 rounded-lg object-cover shadow-xl border-4 border-white">

            <!-- Bottom-right small image -->
            <img id="about-us-3"
                src="{{ $aboutUs->image_three ? asset($aboutUs->image_three) : asset('assets/frontend/images/about-us/upcomingschool.jpg') }}"
                alt="Bottom Right"
                class="absolute -bottom-6 -right-6 w-24 h-24 sm:w-40 sm:h-40 md:w-32 md:h-32 lg:w-40 lg:h-40 rounded-lg object-cover shadow-xl border-4 border-white">
        </div>

        <!-- Content Column -->
        <div class="">
            <div class="items-center justify-start space-x-3 my-6 flex">
                <span class="w-3 h-3 bg-primary rounded-full"></span>
                <span class="w-3 h-3 bg-primary rounded-full"></span>
                <span class="text-secondary font-bold text-xl capitalize">{{ __('homepage.about_us') }}</span>
                <span class="w-3 h-3 bg-primary rounded-full"></span>
                <span class="w-3 h-3 bg-primary rounded-full"></span>
            </div>

            <h2 class="text-3xl sm:text-4xl md:text-[40px] font-extrabold text-black leading-tight mb-6">
                {{ app()->getLocale() == 'en' ? $aboutUs->title_en : $aboutUs->title_np ?? $aboutUs->title_en }}
            </h2>

            <div
                class="text-base sm:text-lg text-gray-600 leading-relaxed mb-6 text-justify @if ($isHome) line-clamp-6 @endif">
                {!! Helper::stripInlineStyle(
                    app()->getLocale() == 'en' ? $aboutUs->description_en : $aboutUs->description_np ?? $aboutUs->description_en,
                ) !!}
            </div>

            @if ($displayButton)
                <a href="{{ route('about-us') }}" target="_blank"
                    class="w-[150px] tracking-wide flex items-center gap-2 shadow-xl text-base bg-secondary backdrop-blur-md lg:font-semibold relative px-4 py-2 overflow-hidden rounded-full group text-white
                        before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0
                        before:rounded-full before:bg-primary hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700">

                    {{ __('homepage.about_us') }}

                    <svg class="w-8 h-8 justify-end group-hover:rotate-90 bg-white text-white ease-linear duration-300 rounded-full border border-white group-hover:border-none p-2 rotate-45"
                        viewBox="0 0 16 19">
                        <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054
                                            0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711
                                            6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                            class="fill-gray-800 text-white">
                        </path>
                    </svg>
                </a>
            @endif
        </div>

        <div class="clear-both"></div>
    </div>
</section> --}}

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            gsap.registerPlugin(ScrollTrigger);
            const isMobile = window.innerWidth < 768;

            // Wrap animations in the section container to prevent scrollbar
            const section = document.querySelector("#about-us-section");

            // MAIN IMAGE
            gsap.from("#about-us-1", {
                y: isMobile ? 100 : 150,
                opacity: 0,
                duration: 0.9,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 70%",
                }
            });

            // TOP LEFT IMAGE
            gsap.from("#about-us-2", {
                x: isMobile ? -80 : -120,
                y: isMobile ? -80 : -120,
                opacity: 0,
                duration: 0.9,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 70%",
                }
            });

            // BOTTOM RIGHT IMAGE
            gsap.from("#about-us-3", {
                x: isMobile ? 80 : 120,
                y: isMobile ? 80 : 120,
                opacity: 0,
                duration: 0.9,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 70%",
                }
            });

            // TITLE
            gsap.from("#about-us-section h2", {
                x: -80,
                opacity: 0,
                duration: 0.8,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 75%",
                }
            });

            // DOTS
            gsap.from("#about-us-section .flex span", {
                scale: 0,
                opacity: 0,
                duration: 0.4,
                stagger: 0.08,
                ease: "back.out(1.7)",
                scrollTrigger: {
                    trigger: section,
                    start: "top 75%",
                }
            });

            // DESCRIPTION
            gsap.from("#about-us-section .text-gray-600", {
                y: 80,
                opacity: 0,
                duration: 0.9,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%",
                }
            });

            // BUTTON
            gsap.from("#about-us-section a", {
                scale: 0.6,
                opacity: 0,
                duration: 0.7,
                ease: "back.out(1.7)",
                scrollTrigger: {
                    trigger: section,
                    start: "top 85%",
                }
            });

        });
    </script>
@endpush
