@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')


    <section class="parallax-container flex justify-center items-center p-20 relative overflow-hidden">
        <img src="{{ asset('assets/frontend/images/rough/parallax-bg.jpg') }}"
            class="absolute inset-0 w-full h-full opacity-10 z-0" alt="" />

        <div class="z-10 relative">
            <div
                class="text-black lg:text-3xl opacity-90 flex flex-col lg:flex-row lg:space-x-44 items-center space-y-10 lg:space-y-0">
                <div class="pl-5 lg:pl-0 flex flex-col space-y-5">
                    <p class="text-xl max-w-sm lg:max-w-none lg:text-3xl uppercase">
                        An investment in knowledge pays the best interest
                    </p>
                    <p class="uppercase font-bold">- Benjamin Franklin</p>
                </div>

                <div class="flex flex-col space-y-2">
                    <div class="flex space-x-2">
                        <div
                            class="w-[150px] h-[150px] lg:w-[300px] lg:h-[300px] rounded-tl-full bg-[#005aab] flex justify-center lg:items-center">
                            <div class="flex lg:flex-col lg:space-y-4 lg:pl-12 items-center">
                                <img src="{{ asset('assets/frontend/images/rough/lightbulb.png') }}"
                                    class="hidden w-20 lg:block" alt="" />
                                <p class="text-white text-sm lg:text-xl pl-8 lg:pl-0 lg:px-8 text-center">
                                    Our Expertise is earned through our experience
                                </p>
                            </div>
                        </div>
                        <div class="w-[150px] h-[150px] lg:w-[300px] lg:h-[300px] rounded-tr-full">
                            <img src="{{ asset('assets/frontend/images/rough/circle1-1.jpg') }}"
                                class="w-full rounded-tr-full" alt="" />
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-[150px] h-[150px] lg:w-[300px] lg:h-[300px] rounded-bl-full">
                            <img src="{{ asset('assets/frontend/images/rough/circle2-1.jpg') }}"
                                class="w-full rounded-bl-full" alt="" />
                        </div>
                        <div
                            class="w-[150px] h-[150px] lg:w-[300px] lg:h-[300px] bg-[#005aab] flex justify-center lg:items-center rounded-br-full">
                            <div class="flex flex-col space-y-4 items-center lg:pr-12">
                                <img src="{{ asset('assets/frontend/images/rough/leadership.png') }}"
                                    class="hidden w-20 lg:block" alt="" />
                                <p class="text-white lg:text-xl pr-8 lg:px-8 text-center">
                                    Our Team for your management
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FULL WIDTH HERO WITH ROUGH TORN EDGES -->
    <div class="w-screen overflow-hidden mt-0">

        <div class="mask-torn w-screen bg-cover bg-center min-h-[500px]"
            style="background-image:url('https://images.unsplash.com/photo-1505935428862-770b6f24f629?auto=format&fit=crop&w=1800&q=80');">

            <div class="w-full h-full flex flex-col justify-center items-center text-white text-center px-6 py-24 md:py-32">
                <h1 class="text-4xl md:text-6xl font-bold max-w-4xl">
                    Every dollar counts: invest in a brighter future
                </h1>
                <p class="mt-4 text-lg opacity-95 max-w-2xl">
                    Adipiscing elit, sed do eiusmod tempor incididunt.
                </p>
            </div>

        </div>
    </div>


    <style>
        /* FULL WIDTH, NON-UNIFORM TORN MASK (base64 svg — safe for Blade) */
        .mask-torn {
            -webkit-mask-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDQwIiBoZWlnaHQ9IjgwMCIgdmlld0JveD0iMCAwIDE0NDAgODAwIj48cGF0aCBkPSJNMCwxMCBDMTAsNDAgNzAsMTAgMTEwLDMwIEMxNzAsNTAgMjIwLDEwIDI5MCwzMCBDMzYwLDUwIDQyMCwxMCA0ODAsNDAgQzU0MCw3MCA2MDAsMTAgNjcwLDMwIEM3NDAsNTAgODIwLDEwIDkwMCwzMCBDOTgwLDUwIDEwNjAsMTAgMTE0MCwzMCBDMTIyMCw1MCAxMzAwLDEwIDEzODAsMzAgQzE0MjAsNTAgMTQwMCwxMCAxNDQwLDIwIEwxNDQwLDc1MCBDMTM5MCw3MjAgMTMxMCw3ODAgMTI1MCw3NDAgQzExOTAsNzAwIDExMjAsNzg1IDEwNTAsNzQwIEM5ODAsNzAwIDkxMCw3NzAgODQwLDc0MCBDNzYwLDcwMCA3MDAsNzc1IDYzMCw3NDAgQzU2MCw3MDAgNTAwLDc3MCA0MzAsNzQwIEMzNjAsNzEwIDI5MCw3ODAgMjIwLDczMCBDMTUwLDY4MCA4MCw3NzAgMCw3MzAgWiIgZmlsbD0iYmxhY2siLz48L3N2Zz4=");
            mask-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDQwIiBoZWlnaHQ9IjgwMCIgdmlld0JveD0iMCAwIDE0NDAgODAwIj48cGF0aCBkPSJNMCwxMCBDMTAsNDQgNzAsMTAgMTEwLDM1IEMxNzAsNTkgMjIwLDEwIDI5MCwzNSBDMzYwLDU5IDQyMCwxMCA0ODAsMzUgQzU0MCw1OSA2MDAsMTAgNjcwLDM1IEM3NDAsNTkgODIwLDEwIDkwMCwzNSBDOTgwLDU5IDEwNjAsMTAgMTE0MCwzNSBDMTIyMCw1OSAxMzAwLDEwIDEzODAsMzUgQzE0MjAsNTkgMTQwMCwxMCAxNDQwLDI1IEwxNDQwLDc2MCBDMTM5MCw3MjggMTMxMCw3OTAgMTI1MCw3NDUgQzExOTAsNzAwIDExMjAsNzkwIDEwNTAsNzQ1IEM5ODAsNzAwIDkxMCw3OTAgODQwLDc0NSBDNzYwLDcwMCA3MDAsNzc1IDYzMCw3NDUgQzU2MCw3MTUgNTAwLDc5MCA0MzAsNzQ1IEMzNjAsNzAxIDI5MCw3OTAgMjIwLDc0NSBDMTUwLDcwMSA4MCw3ODQgMCw3NDUgWiIgZmlsbD0iYmxhY2siLz48L3N2Zz4=");

            /* FULL WIDTH STRETCH */
            -webkit-mask-size: cover;
            mask-size: cover;
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-position: top;
            mask-position: top;
        }
    </style>

    <section class="relative w-full h-[100vh] overflow-hidden">
        <div class="grid grid-cols-12 h-full"> <!-- Left slider -->
            <div class="col-span-12 lg:col-span-9 relative overflow-hidden">
                <div class="swiper leftSwiper h-full">
                    <div class="swiper-wrapper"> <!-- Slides injected by JS --> </div> <!-- Optional navigation -->
                    <div class="swiper-button-next text-white"></div>
                    <div class="swiper-button-prev text-white"></div>
                </div> <!-- Left text -->
                <div class="absolute left-10 lg:left-20 top-1/2 -translate-y-1/2 text-white max-w-xl lg:max-w-2xl z-10">
                    <h1 id="heroTitle"
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-[64px] font-bold leading-snug sm:leading-tight">
                    </h1> <a id="heroBtn" href="#"
                        class="inline-block mt-6 sm:mt-8 lg:mt-10 bg-red-600 px-6 py-3 sm:px-8 sm:py-4 text-xs sm:text-sm font-semibold tracking-wide rounded-md"></a>
                </div> <!-- Slide counter -->
                <div
                    class="absolute bottom-6 sm:bottom-8 lg:bottom-12 left-10 lg:left-20 text-white text-xs sm:text-sm tracking-widest z-10">
                    <span id="currentSlide">01</span> <span class="opacity-50"> / 10</span> </div>
            </div> <!-- Right content -->
            <div
                class="col-span-12 lg:col-span-3 relative bg-primary text-white text-white flex items-center justify-center sm:justify-start overflow-visible">
                <div class="relative w-full px-6 sm:px-10 py-8 sm:py-14">
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-center gap-2 sm:gap-3"> <span class="w-8 sm:w-10 h-[2px] bg-red-500"></span>
                            <p id="rightTitle"
                                class="uppercase text-[10px] sm:text-xs tracking-[0.15em] sm:tracking-[0.25em] text-gray-300">
                            </p>
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold leading-snug"></h3>
                        <p id="rightDesc1" class="text-xs sm:text-sm leading-relaxed text-gray-300"></p>
                        <p id="rightDesc2" class="text-xs sm:text-sm leading-relaxed text-gray-400"></p>
                    </div>
                    <div class="relative -mr-4 sm:-mr-10 mt-4 sm:mt-8">
                        <p class="mb-2 text-[10px] sm:text-xs uppercase tracking-widest text-gray-400"> Explore Highlights
                        </p>
                        <div class="swiper rightSwiper">
                            <div class="swiper-wrapper"> <!-- Thumbnails injected via JS --> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Swiper JS & CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // Slides data (unchanged) const slidesData = [{ img: "https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=1800&q=80", title: "Sustainable<br>Energy<br>Projects", btn: "Learn More", rightTitle: "Sustainability", desc1: "We design and implement large-scale renewable energy projects that minimize environmental impact while maximizing efficiency and output. From solar farms to wind power stations, every project is carefully planned to meet local energy demands sustainably.", desc2: "Our team works closely with communities and stakeholders to ensure that sustainable solutions are practical, scalable, and aligned with global energy goals. We strive for long-term impact in creating greener, cleaner energy systems." }, { img: "https://images.unsplash.com/photo-1567427018141-0584cfcbf1a2?auto=format&fit=crop&w=1800&q=80", title: "Advanced<br>Control<br>Systems", btn: "Explore", rightTitle: "Automation", desc1: "Our advanced industrial control systems are engineered to optimize operations across complex energy and manufacturing infrastructures. Using state-of-the-art sensors and AI-powered analytics, we ensure operational precision, reliability, and safety at every stage.", desc2: "From predictive maintenance to automated monitoring, our solutions reduce downtime and increase productivity, empowering industries to achieve higher efficiency while minimizing human error and operational risks." }, { img: "https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=1800&q=80", title: "High-Tech<br>Research<br>Facilities", btn: "Discover", rightTitle: "R&D Labs", desc1: "Our research and development labs are equipped with cutting-edge technology to drive innovation in energy systems, industrial design, and sustainability. We explore new materials, advanced processes, and next-generation solutions that set industry standards.", desc2: "Collaborating with experts worldwide, we aim to solve complex energy challenges, accelerate technological adoption, and deliver practical innovations that benefit both industry and society at large." }, { img: "https://images.unsplash.com/photo-1532712936745-29c1f6b3f8d7?auto=format&fit=crop&w=1800&q=80", title: "Industrial<br>Safety<br>Protocols", btn: "Our Approach", rightTitle: "Safety Management", desc1: "We prioritize safety in all operations, implementing strict protocols, regular audits, and employee training programs. Our safety systems are compliant with international standards and designed to prevent accidents before they occur.", desc2: "By fostering a culture of safety and accountability, we ensure that our teams, facilities, and the environment remain protected, enabling continuous operations without compromising quality or wellbeing." }, { img: "https://images.unsplash.com/photo-1509395176047-4a66953fd231?auto=format&fit=crop&w=1800&q=80", title: "Smart<br>Energy<br>Monitoring", btn: "Check Now", rightTitle: "Monitoring Solutions", desc1: "Our smart energy monitoring systems provide real-time insights into consumption patterns, operational efficiency, and potential risks. With advanced dashboards and analytics, decision-makers can optimize resources and reduce operational costs.", desc2: "The combination of IoT devices and AI-driven analytics allows for proactive interventions, predictive maintenance, and smarter energy management, ultimately enhancing sustainability and performance across industrial operations." }, { img: "https://images.unsplash.com/photo-1521790797524-b2497295b8a0?auto=format&fit=crop&w=1800&q=80", title: "Global<br>Energy<br>Networks", btn: "Connect", rightTitle: "Energy Distribution", desc1: "We manage large-scale energy distribution networks that connect producers, suppliers, and consumers across multiple regions. Our systems ensure continuous, reliable power delivery even in challenging operational environments.", desc2: "Through smart grid technology, monitoring, and automated controls, we maintain efficiency and reliability, supporting both industrial and residential energy needs while reducing losses and environmental impact." }, { img: "https://images.unsplash.com/photo-1581091870620-2b8b5d5b0e44?auto=format&fit=crop&w=1800&q=80", title: "Cutting-Edge<br>Innovation<br>Hub", btn: "Join Us", rightTitle: "Innovation Center", desc1: "Our innovation hub fosters collaboration between engineers, scientists, and industry experts. Here, breakthrough technologies in energy generation, storage, and efficiency are conceived, tested, and implemented for real-world industrial applications.", desc2: "The hub also supports pilot programs, workshops, and collaborative research, ensuring that novel ideas translate into practical, scalable solutions that drive progress in the energy sector." }, { img: "https://images.unsplash.com/photo-1505935428862-770b6f24f629?auto=format&fit=crop&w=1800&q=80", title: "Reliable<br>Logistics<br>Operations", btn: "Learn More", rightTitle: "Supply Chain", desc1: "Efficient and reliable logistics are key to industrial success. We streamline the transportation, storage, and distribution of critical resources using integrated logistics management and advanced tracking systems.", desc2: "By coordinating supply chains effectively, we reduce delays, minimize waste, and ensure that every component reaches its destination safely and on time, supporting continuous industrial operations." }, { img: "https://images.unsplash.com/photo-1573164574393-3b3b7c02f548?auto=format&fit=crop&w=1800&q=80", title: "Renewable<br>Energy<br>Integration", btn: "Explore", rightTitle: "Energy Solutions", desc1: "We specialize in integrating renewable energy sources into existing industrial and urban infrastructures. Solar, wind, and hybrid systems are designed to complement traditional energy supplies while reducing carbon footprints.", desc2: "Through careful planning, modeling, and real-time monitoring, our integration solutions maximize efficiency, reliability, and sustainability, ensuring a seamless transition to cleaner energy models." }, { img: "https://images.unsplash.com/photo-1549921296-3fa4a22d11d4?auto=format&fit=crop&w=1800&q=80", title: "Industrial<br>Digitalization<br>Solutions", btn: "Discover", rightTitle: "Digital Transformation", desc1: "We deploy advanced digital solutions to modernize industrial operations, including IoT, AI analytics, and automated monitoring systems. These technologies enable smarter decision-making, predictive maintenance, and optimized production.", desc2: "Digitalization not only increases productivity and efficiency but also enhances transparency, safety, and environmental responsibility, setting new standards for industrial performance worldwide." } ]; // Inject slides for left swiper const leftWrapper = document.querySelector('.leftSwiper .swiper-wrapper'); slidesData.forEach(slide => { const div = document.createElement('div'); div.className = 'swiper-slide relative'; div.innerHTML = <img src="${slide.img}" class="w-full h-full object-cover"> <div class="absolute inset-0 bg-black/30"></div>; leftWrapper.appendChild(div); }); // Inject thumbnails for right swiper const rightWrapper = document.querySelector('.rightSwiper .swiper-wrapper'); slidesData.forEach(slide => { const div = document.createElement('div'); div.className = 'swiper-slide w-16 h-16 sm:w-24 sm:h-24 cursor-pointer'; div.innerHTML = <img src="${slide.img}" class="w-full h-full object-cover rounded-md border-2 border-transparent">; rightWrapper.appendChild(div); }); // Initialize Swipers const rightSwiper = new Swiper(".rightSwiper", { spaceBetween: 10, slidesPerView: 3, freeMode: true, watchSlidesProgress: true, breakpoints: { 640: { slidesPerView: 4 }, 768: { slidesPerView: 3 }, } }); const leftSwiper = new Swiper(".leftSwiper", { spaceBetween: 10, navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev", }, thumbs: { swiper: rightSwiper, // link thumbnails }, on: { slideChange: function() { const idx = this.activeIndex; const data = slidesData[idx]; document.getElementById('heroTitle').innerHTML = data.title; document.getElementById('heroBtn').textContent = data.btn; document.getElementById('rightTitle').textContent = data.rightTitle; document.getElementById('rightDesc1').textContent = data.desc1; document.getElementById('rightDesc2').textContent = data.desc2; document.getElementById('currentSlide').textContent = String(idx + 1).padStart(2, '0'); } } }); // Set initial content const initial = slidesData[0]; document.getElementById('heroTitle').innerHTML = initial.title; document.getElementById('heroBtn').textContent = initial.btn; document.getElementById('rightTitle').textContent = initial.rightTitle; document.getElementById('rightDesc1').textContent = initial.desc1; document.getElementById('rightDesc2').textContent = initial.desc2;
    </script>





@endsection

@push('scripts')
@endpush
