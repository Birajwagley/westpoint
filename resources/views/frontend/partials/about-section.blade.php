@php
    use App\Helpers\Helper;
@endphp

<div>
    <a href="{{ route('about-us') }}">
        <h3 class="font-bold text-lg text-primary border-l-4 border-primary pl-3">
            {{ __('pages.about_us') }}
        </h3>

        <div class="mt-2 pl-3 text-gray-700 text-sm line-clamp-4">
            {!! Helper::stripInlineStyle(
                app()->getLocale() == 'en'
                    ? $aboutUs->description_en ?? ''
                    : $aboutUs->description_np ?? ($aboutUs->description_en ?? ''),
            ) !!}
        </div>
    </a>
    {{-- Social Icons --}}
    <div class="flex gap-3 mt-4 pl-3">
        @if ($socials->facebook)
            <a href="{{ $socials->facebook }}" target="_blank"
                class="group flex items-center justify-center w-9 h-9 border border-primary rounded-full hover:bg-primary transition duration-200">
                <i class="fa-brands fa-facebook-f text-primary group-hover:text-white fa-lg"></i>
            </a>
        @endif

        @if ($socials->instagram)
            <a href="{{ $socials->instagram }}" target="_blank"
                class="group flex items-center justify-center w-9 h-9 border border-primary rounded-full hover:bg-primary transition duration-200">
                <i class="fa-brands fa-instagram text-primary group-hover:text-white fa-lg"></i>
            </a>
        @endif

        @if ($socials->x)
            <a href="{{ $socials->x }}" target="_blank"
                class="group flex items-center justify-center w-9 h-9 border border-primary rounded-full hover:bg-primary transition duration-200">
                <i class="fa-brands fa-x-twitter text-primary group-hover:text-white fa-lg"></i>
            </a>
        @endif

        @if ($socials->linkedin)
            <a href="{{ $socials->linkedin }}" target="_blank"
                class="group flex items-center justify-center w-9 h-9 border border-primary rounded-full hover:bg-primary transition duration-200">
                <i class="fa-brands fa-linkedin-in text-primary group-hover:text-white fa-lg"></i>
            </a>
        @endif

        @if ($socials->youtube)
            <a href="{{ $socials->youtube }}" target="_blank"
                class="group flex items-center justify-center w-9 h-9 border border-primary rounded-full hover:bg-primary transition duration-200">
                <i class="fa-brands fa-youtube text-primary group-hover:text-white fa-lg"></i>
            </a>
        @endif
    </div>
</div>
