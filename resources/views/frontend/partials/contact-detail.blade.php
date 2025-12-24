<section class="relative mx-auto overflow-hidden text-white p-6 sm:p-8 md:p-12">
    <!-- Background image -->
    <img src="{{ asset('assets/frontend/images/homepage/homepg.jpg') }}" alt="Contact Background"
        class="absolute inset-0 w-full h-full object-cover opacity-90">

    <!-- Strong primary color overlay -->
    <div class="absolute inset-0 bg-primary opacity-80"></div>

    <!-- Content -->
    <div class="relative flex flex-col items-center text-center space-y-6 z-2">
        <h2 class="text-3xl font-bold">{{ __('pages.contact_us') }}</h2>
        <p class="text-white text-base max-w-3xl">
            {{ __('pages.feel_free') }}
        </p>

        <!-- Contact Info Section -->
        <div class="bg-white text-gray-800 p-6 sm:p-10 rounded-2xl w-full max-w-7xl shadow-xl">
            <div class="flex flex-col md:flex-row md:justify-between gap-8">
                <!-- Email -->
                <div class="flex items-start gap-4">
                    <div class="w-14 sm:w-20 flex-shrink-0">
                        <img src="{{ asset('assets/frontend/images/icon/email.png') }}" alt="Email icon"
                            class="w-full h-auto">
                    </div>
                    <div class="text-left space-y-2">
                        <h4 class="uppercase text-md font-bold text-primary">{{ __('pages.email_address') }}</h4>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('pages.reach_out') }}: <br>
                            <a href="mailto:{{ json_decode($setting->email1)->email ?? 'void:;' }}"
                                class="text-primary font-semibold hover:underline">{{ json_decode($setting->email1)->email ?? '' }}</a><br>
                            <a href="mailto:{{ json_decode($setting->email2)->email ?? 'void:;' }}"
                                class="text-primary font-semibold hover:underline">{{ json_decode($setting->email2)->email ?? '' }}</a>
                        </p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start gap-4">
                    <div class="w-14 sm:w-20 flex-shrink-0">
                        <img src="{{ asset('assets/frontend/images/icon/phone.png') }}" alt="Phone icon"
                            class="w-full h-auto">
                    </div>
                    <div class="text-left space-y-2">
                        <h4 class="uppercase text-md font-bold text-primary">{{ __('pages.phone_no') }}</h4>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('pages.call_us_anytime') }}: <br>
                            <a href="tel:{{ json_decode($setting->contact)->contact ?? 'void:;' }}"
                                class="text-primary font-semibold hover:underline">{{ json_decode($setting->contact)->contact ?? '' }}</a>
                        </p>
                    </div>
                </div>

                <!-- Social -->
                <div class="flex items-start gap-4">
                    <div class="w-14 sm:w-20 flex-shrink-0">
                        <img src="{{ asset('assets/frontend/images/icon/community.png') }}" alt="Social media icons"
                            class="w-full h-auto">
                    </div>
                    <div class="text-left space-y-2">
                        <h4 class="uppercase text-md font-bold text-primary">{{ __('pages.social_community') }}</h4>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('pages.stay_connected_with_us') }}:
                        </p>

                        <div class="flex flex-wrap items-center gap-3 mt-3">
                            @if (isset($setting->facebook))
                                <a href="{{ $setting->facebook }}" target="_blank"
                                    class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                    <i class="fa-brands fa-facebook-f fa-xl text-primary group-hover:text-gray-100"></i>
                                </a>
                            @endif

                            @if (isset($setting->instagram))
                                <a href="{{ $setting->instagram }}" target="_blank"
                                    class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                    <i class="fa-brands fa-instagram fa-xl text-primary group-hover:text-gray-100"></i>
                                </a>
                            @endif

                            @if (isset($setting->linkedin))
                                <a href="{{ $setting->linkedin }}" target="_blank"
                                    class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                    <i
                                        class="fa-brands fa-linkedin-in fa-xl text-primary group-hover:text-gray-100"></i>
                                </a>
                            @endif

                            @if (isset($setting->x))
                                <a href="{{ $setting->x }}" target="_blank"
                                    class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                    <i class="fa-brands fa-x-twitter fa-xl text-primary group-hover:text-gray-100"></i>
                                </a>
                            @endif

                            @if (isset($setting->youtube))
                                <a href="{{ $setting->youtube }}" target="_blank"
                                    class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                    <i class="fa-brands fa-youtube fa-xl text-primary group-hover:text-gray-100"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
