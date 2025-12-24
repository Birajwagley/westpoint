<div id="upperNav" class="hidden lg:block bg-secondary h-[50px] w-full xl:flex flex-row justify-between">
    <div class="px-8 h-full flex items-center justify-between">
        <div class="flex items-center gap-8 text-white text-sm">
            <a href="mailto:{{ isset($setting->email) ? json_decode($setting->email)->email : '' }}"
                class="flex items-center gap-2">
                @if (isset($setting->email) && isset(json_decode($setting->email)->email))
                    <i class="fa-regular fa-envelope fa-lg"></i>
                    <span>{{ json_decode($setting->email)->email }}</span>
                @endif
            </a>

            <span class="flex items-center gap-2">
                @if (isset($setting->address_en) || isset($setting->address_np))
                    <i class="fa-solid fa-location-dot fa-lg"></i>
                    <span>{{ app()->getLocale() == 'en' ? $setting->address_en : (isset($setting->address_np) ? $setting->address_np : $setting->address_en) }}</span>
                @endif
            </span>
        </div>
    </div>

    <div
        class="flex justify-evenly text-center items-center gap-4 text-white rounded-tl-[100px] bg-primary pl-20 w-[520px]">
        <span class="text-sm font-semibold">{{ __('homepage.follow_us') }}</span>

        <!-- Social icons container -->
        <!-- Facebook -->
        @if ($setting->facebook)
            <div>
                <a href="{{ $setting->facebook ?? '#' }}" target="_blank" rel="noopener noreferrer"
                    aria-label="Follow us on Facebook" class="hover:text-gray-300 transition-colors">
                    <i class="fa-brands fa-lg fa-facebook-f"></i>
                </a>
            </div>
        @endif

        <!-- Instagram -->
        @if ($setting->instagram)
            <div>
                <a href="{{ $setting->instagram ?? '#' }}" target="_blank" rel="noopener noreferrer"
                    aria-label="Follow us on Instagram" class="hover:text-gray-300 transition-colors">
                    <i class="fa-brands fa-lg fa-instagram"></i>
                </a>
            </div>
        @endif

        <!-- Linkedin -->
        @if ($setting->linkedin)
            <div>
                <a href="{{ $setting->linkedin ?? '#' }}" target="_blank" rel="noopener noreferrer"
                    aria-label="Follow us on Linkedin" class="hover:text-gray-300 transition-colors">
                    <i class="fa-brands fa-lg fa-linkedin-in"></i>
                </a>
            </div>
        @endif

        <!-- x -->
        @if ($setting->x)
            <div>
                <a href="{{ $setting->x ?? '#' }}" target="_blank" rel="noopener noreferrer" aria-label="Follow us on X"
                    class="hover:text-gray-300 transition-colors">
                    <i class="fa-brands fa-lg fa-x-twitter"></i>
                </a>
            </div>
        @endif

        <div>
            <!-- Youtube -->
            <a href="{{ $setting->youtube ?? '#' }}" target="_blank" rel="noopener noreferrer"
                aria-label="Subscribe us on Youtube" class="hover:text-gray-300 transition-colors">
                <i class="fa-brands fa-lg fa-youtube"></i>
            </a>
        </div>
    </div>
</div>
