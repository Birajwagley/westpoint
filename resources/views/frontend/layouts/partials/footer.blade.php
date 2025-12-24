@php
    use App\Helpers\Helper;
@endphp

@push('styles')
    <style>
        .footer-image img {
            transform: translateZ(0);
            /* helps fix clipping in some browsers */
        }
    </style>
@endpush

<footer id="footer-section" class="bg-primary text-white relative !bottom-0 overflow-hidden">
    <!-- Main Footer Content -->
    <div class="relative py-12 px-6 pb-40 lg:pb-20 -mb-20 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">

            <!-- Left Section - Logos and Description -->
            <div id="footer-lefty" class="footer-lefty lg:col-span-3">
                <!-- Logos -->
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $setting->primary_logo ? $setting->primary_logo : asset('assets/frontend/images/footer/main logo.png') }}"
                        alt="GBBS" class="w-20 h-20">
                    <img src="{{ $setting->experience_logo ? $setting->experience_logo : asset('assets/frontend/images/footer/50years.png') }}"
                        alt="GBBS" class="w-20 h-20">
                </div>
                <!-- Description -->
                <a href="{{ route('about-us') }}" target="__blank" class="text-gray-200 text-sm leading-relaxed">
                    {!! Str::limit(
                        Helper::stripInlineStyle(
                            app()->getLocale() == 'en' ? $aboutUs->description_en : $aboutUs->description_np ?? $aboutUs->description_en,
                        ),
                        300,
                        '...',
                    ) !!}

                </a>
            </div>

            <!-- Center Section (Rows 2 & 3) -->
            <div id="footer-center" class="footer-center lg:col-span-9 flex flex-col gap-10">

                <!-- Row 2: Call + Social Media -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Call Us -->
                    <div class="flex items-start gap-3">
                        <img src="{{ asset('assets/frontend/images/homepage/Callsupport.png') }}" alt="Call Support"
                            class="w-8 h-8 mt-1">
                        <div>
                            <h3 class="text-yellow-400 font-semibold text-lg mb-2">{{ __('homepage.contact_us_247') }}
                            </h3>
                            <div class="flex flex-col">
                                <a href="tel:{{ json_decode($setting->contact1)->contact ?? '' }}"
                                    class="text-gray-200 text-md">{{ json_decode($setting->contact1)->contact ?? '' }}
                                </a>
                                <a href="tel:{{ json_decode($setting->contact2)->contact ?? '' }}"
                                    class="text-gray-200 text-md">{{ json_decode($setting->contact2)->contact ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-yellow-400 font-semibold text-lg mb-4">{{ __('homepage.follow_us') }}</h3>
                        <div class="flex items-center gap-3">
                            @if ($setting->facebook)
                                <a href="{{ $setting->facebook ?? 'void:;' }}" target="_blank"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-lg fa-facebook-f text-white"></i>
                                </a>
                            @endif

                            @if ($setting->instagram)
                                <a href="{{ $setting->instagram ?? 'void:;' }}" target="_blank"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-lg fa-instagram text-white"></i>
                                </a>
                            @endif

                            @if ($setting->linkedin)
                                <a href="{{ $setting->linkedin ?? 'void:;' }}" target="_blank"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-lg fa-linkedin-in text-white"></i>
                                </a>
                            @endif

                            @if ($setting->x)
                                <a href="{{ $setting->x ?? 'void:;' }}" target="_blank"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-lg fa-x-twitter text-white"></i>
                                </a>
                            @endif

                            @if ($setting->youtube)
                                <a href="{{ $setting->youtube ?? 'void:;' }}" target="_blank"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-lg fa-youtube text-white"></i>
                                </a>
                            @endif
                        </div>
                    </div>


                </div>

                <!-- Row 3: Quick links + Newsletter -->
                <div id="footer-rigty" class="footer-rigty grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-yellow-400 font-semibold text-lg mb-4">
                            {{ __('homepage.quick_links') }}
                        </h3>
                        <div class="grid grid-cols-2 gap-6">
                            @foreach ($quickLinks as $links)
                                <ul class="space-y-3">
                                    @foreach ($links as $link)
                                        <li>
                                            <a href="{{ $link->menus != null ? route($menu->slug) : $link->url }}"
                                                target="_blank"
                                                class="text-gray-200 text-sm hover:text-yellow-400 flex items-center gap-2">
                                                <i class="fas fa-arrow-right text-xs"></i>
                                                {{ app()->getLocale() == 'en' ? $link->name_en : $link->name_np ?? $link->name_en }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-yellow-400 font-semibold text-lg mb-2">{{ __('homepage.subscribe_us') }}</h3>
                        <p class="text-gray-200 text-sm mb-4">{{ __('homepage.stay_in_touch') }}</p>
                        <div class="flex gap-2">
                            <form class="space-y-4 w-full" action="{{ route('news-letter.subscription') }}"
                                method="POST" id="newsLetterForm">
                                @csrf

                                <input type="email" placeholder="Email" id="newsLetterEmail" name="email"
                                    class="w-full flex-1 px-4 py-2 rounded bg-white text-gray-800 placeholder-gray-500 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">

                                <div>
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="button" id="newsLetterBtn"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-custom-green px-6 py-2 rounded font-semibold text-sm transition">
                                    {{ __('homepage.submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Image -->
    <div class=" bottom-0 left-0 right-0 w-full z-0 footer-image h-[20vh] md:h-fit">
        <img src="{{ asset('assets/frontend/images/homepage/area.png') }}" alt="School Building"
            class="w-full h-full object-cover object-bottom">
    </div>
</footer>

@push('scripts')
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                errorToast("{{ $errors->first() }}");
            @endif
        });

        $('#newsLetterBtn').click(function(e) {
            e.preventDefault();

            let email = $('#newsLetterEmail').val();
            let recaptcha = grecaptcha.getResponse();

            if (email === "" || recaptcha.length === 0) {
                errorToast('Please enter your email address and complete the reCAPTCHA verification.');
            } else {
                $('#newsLetterForm').submit();
            }
        });

        gsap.registerPlugin(ScrollTrigger);

        gsap.from(".footer-lefty", {
            x: -300,
            duration: 1,
            opacity: 0,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#footer-section",
                start: "top 90%",
            },
        });

        gsap.from(".footer-center", {
            y: -100,
            duration: 1,
            opacity: 0,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#footer-section",
                start: "top 90%",
            },
        });

        gsap.from(".footer-rigty", {
            x: 300,
            duration: 1,
            opacity: 0,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#footer-section",
                start: "top 90%",
            },
        });

        gsap.from(".footer-image", {
            y: 300,
            opacity: 0,
            duration: 1,
            ease: "power3.linear",
            scrollTrigger: {
                trigger: "#footer-section",
                start: "top 90%",
            },
        });
    </script>
@endpush
