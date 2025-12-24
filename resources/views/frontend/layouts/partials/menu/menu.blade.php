@php
    use App\Enum\MenuTypeEnum;
@endphp

@push('styles')
    <style>
        nav,
        ul {
            overflow: visible !important;
        }
    </style>
@endpush

<nav id="navbar" class="fixed top-0 md:top-[50px] w-full h-[100px] transition-all duration-300 bg-transparent z-10">

    <div class="px-8 h-full flex items-center justify-around">

        {{-- Logos --}}
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}">
                <img src="{{ $setting->primary_logo ?? '' }}" alt="GBBS" class="h-16 object-contain">
            </a>
            <a href="{{ route('home') }}">
                <img src="{{ $setting->experience_logo ?? '' }}" alt="GBBS" class="h-16 object-contain">
            </a>
        </div>

        {{-- Desktop Menu --}}
        <div class="flex-1 flex justify-center">
            <div class="hidden lg:flex 2xl:gap-10 items-center capitalize">
                <ul class="flex space-x-4 gap-2" x-data="{ openMenu: null }">

                    @foreach ($menus as $i => $parent)
                        <li class="relative" @mouseenter="openMenu = {{ $i }}" @mouseleave="openMenu = null">

                            {{-- Parent without children --}}
                            @if ($parent->children->isEmpty())
                                <a href="{{ $parent->type == MenuTypeEnum::SLUG->value ? route('page-builder', $parent->slug) : $parent->external_link }}"
                                    class="group text-gray-800 2xl:text-base text-sm font-semibold hover:text-primary transition flex items-center justify-between parent-menu">
                                    <span>{{ app()->getLocale() == 'en' ? $parent->name_en : $parent->name_np ?? $parent->name_en }}</span>
                                </a>
                            @else
                                {{-- Parent with dropdown --}}
                                <button type="button"
                                    class="group text-gray-800 2xl:text-base text-sm font-semibold hover:text-primary transition flex items-center justify-between parent-menu"
                                    @focus="openMenu = {{ $i }}" @blur="openMenu = null" aria-haspopup="true"
                                    :aria-expanded="openMenu === {{ $i }}">
                                    <span>{{ app()->getLocale() == 'en' ? $parent->name_en : $parent->name_np ?? $parent->name_en }}</span>
                                    &nbsp;&nbsp;
                                    <i class="fa-solid fa-angle-down group-hover:rotate-180"></i>
                                </button>

                                {{-- Child Menu --}}
                                <ul x-show="openMenu === {{ $i }}" x-transition
                                    class="absolute left-0 mt-2 w-[250px] bg-primary text-white rounded shadow-lg z-20"
                                    @mouseenter="openMenu = {{ $i }}" @mouseleave="openMenu = null">

                                    @foreach ($parent->children as $j => $children)
                                        <li class="relative" x-data="{ openSub: false, flip: false }"
                                            @mouseenter="
                                                openSub = true;
                                                const rect = $el.getBoundingClientRect();
                                                flip = (rect.right + 250 > window.innerWidth);
                                            "
                                            @mouseleave="openSub = false">

                                            {{-- Child without submenu --}}
                                            @if ($children->children->isEmpty())
                                                <a href="{{ $children->type == MenuTypeEnum::SLUG->value ? route('page-builder', $children->slug) : $children->external_link }}"
                                                    class="w-full flex items-start px-4 py-2 hover:text-accent cursor-pointer">
                                                    <span class="capitalize flex-1 min-w-0 break-words">
                                                        {{ app()->getLocale() == 'en' ? $children->name_en : $children->name_np ?? $children->name_en }}
                                                    </span>
                                                </a>
                                            @else
                                                {{-- Child with sub-child menu --}}
                                                <button
                                                    class="w-full flex items-start px-4 py-2 hover:text-accent cursor-pointer"
                                                    @focus="openSub = true" @blur="openSub = false" aria-haspopup="true"
                                                    :aria-expanded="openSub">
                                                    <span class="capitalize flex-1 min-w-0 break-words text-left">
                                                        {{ app()->getLocale() == 'en' ? $children->name_en : $children->name_np ?? $children->name_en }}
                                                    </span>
                                                    <i class="fa-solid fa-angle-right ml-2 mt-1"
                                                        :class="flip ? 'rotate-180' : ''"></i>
                                                </button>
                                            @endif

                                            {{-- Sub-child Menu (Auto-flip enabled ✅) --}}
                                            @if ($children->children->isNotEmpty())
                                                <ul x-show="openSub" x-transition @mouseenter="openSub = true"
                                                    @mouseleave="openSub = false"
                                                    :class="flip
                                                        ?
                                                        'absolute right-full top-0 mt-0 mr-1 w-[250px] bg-secondary text-white rounded shadow-lg z-30' :
                                                        'absolute left-full top-0 mt-0 ml-1 w-[250px] bg-secondary text-white rounded shadow-lg z-30'">

                                                    @foreach ($children->children as $child)
                                                        <li>
                                                            <a href="{{ $child->type == MenuTypeEnum::SLUG->value ? route('page-builder', $child->slug) : $child->external_link }}"
                                                                class="w-full flex items-start px-4 py-2 hover:text-accent cursor-pointer">
                                                                <span class="capitalize flex-1 min-w-0 break-words">
                                                                    {{ app()->getLocale() == 'en' ? $child->name_en : $child->name_np ?? $child->name_en }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        {{-- Right Buttons --}}
        <div class="flex items-center gap-4">
            <button id="onlineAdmissionButton" data-dropdown-toggle="dropdownDelay" data-dropdown-delay="500"
                data-dropdown-trigger="hover"
                class="hidden lg:flex items-center text-white bg-secondary hover:bg-primary font-light rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                {{ __('homepage.apply_now') }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <div id="dropdownDelay" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44"
                role="menu">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="onlineAdmissionButton">
                    <li>
                        <a href="{{ route('online-admission.school-level') }}"
                            class="block px-4 py-2 hover:bg-gray-100"
                            role="menuitem">{{ __('homepage.school_level') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('online-admission.college-level') }}"
                            class="block px-4 py-2 hover:bg-gray-100"
                            role="menuitem">{{ __('homepage.college_level') }}</a>
                    </li>
                </ul>
            </div>

            {{-- Lang Switcher --}}
            <select id="languages"
                class="py-2.5 pl-[10px] border-1 border-primary rounded-lg text-sm font-bold cursor-pointer appearance-none">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                <option value="np" {{ app()->getLocale() == 'np' ? 'selected' : '' }}>NP</option>
            </select>

            {{-- Burger Menu --}}
            <div id="burger-container" class="lg:hidden flex items-center">
                <button id="burger" class="text-gray-800 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</nav>
