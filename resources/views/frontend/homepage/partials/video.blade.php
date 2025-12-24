<!-- HERO VIDEO SECTION BELOW MOBILE MENU -->
<section id="video-hero"  class="relative w-full overflow-hidden ">
    <div class="relative w-full h-[60vh] sm:h-[60vh] md:h-[60vh] lg:h-[95vh] xl:h-[95vh] overflow-hidden">
        <video id="heroVideo"
               {{-- src="" --}}
               src="{{ asset('assets/frontend/video/videoplayback.mp4') }}"
               autoplay muted loop playsinline preload="auto"
               class="absolute top-0 left-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-700">
        </video>
        <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
    </div>
</section>
