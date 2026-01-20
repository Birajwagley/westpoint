@php
    use App\Enum\MenuTypeEnum;
@endphp

<!-- MOBILE MENU -->
<div id="mobile-menu" class="navbar-menu relative z-50 hidden">
    <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
    <nav class="fixed top-0 right-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
        <!-- Logo + Close -->
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="mr-auto flex items-center gap-6">
                <img src="{{ $setting->primary_logo ?? '' }}" alt="WPHS" class="h-14 object-contain">
                <img src="{{ $setting->experience_logo ?? '' }}" alt="WPHS" class="h-14 object-contain">
            </a>
            <button id="close-menu" class="navbar-close">
                <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-primary" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Menu Items -->
        <ul>
            @foreach ($menus as $i => $parent)
                <li x-data="{ open: false }">
                    @if ($parent->children->isEmpty())
                        <a href="{{ $parent->type == MenuTypeEnum::SLUG->value ? route('page-builder', $parent->slug) : $parent->external_link }}"
                            class="block p-4 text-sm font-semibold text-gray-700 hover:text-primary rounded">
                            {{ app()->getLocale() == 'en' ? $parent->name_en : $parent->name_np ?? $parent->name_en }}
                        </a>
                    @else
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-4 text-sm font-semibold text-gray-700 rounded hover:text-primary focus:outline-none">
                            <span
                                class="capitalize">{{ app()->getLocale() == 'en' ? $parent->name_en : $parent->name_np ?? $parent->name_en }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': open }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="ml-4 border-l border-gray-200">
                            @foreach ($parent->children as $children)
                                <li x-data="{ openChild: false }">
                                    @if ($children->children->isEmpty())
                                        <a href="{{ $children->type == MenuTypeEnum::SLUG->value ? route('page-builder', $children->slug) : $children->external_link }}"
                                            class="block p-3 pl-4 text-sm text-gray-700 hover:text-primary">
                                            {{ app()->getLocale() == 'en' ? $children->name_en : $children->name_np ?? $children->name_en }}
                                        </a>
                                    @else
                                        <button @click="openChild = !openChild"
                                            class="flex items-center justify-between w-full p-3 pl-4 text-sm text-gray-700 rounded hover:text-primary focus:outline-none">
                                            <span>{{ app()->getLocale() == 'en' ? $children->name_en : $children->name_np ?? $children->name_en }}</span>
                                            <svg class="w-4 h-4 transition-transform"
                                                :class="{ 'rotate-90': openChild }" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                        @if ($children->children->isNotEmpty())
                                            <ul x-show="openChild" x-transition class="ml-4 border-l border-gray-200">
                                                @foreach ($children->children as $child)
                                                    <li>
                                                        <a href="{{ $child->type == MenuTypeEnum::SLUG->value ? route('page-builder', $child->slug) : $child->external_link }}"
                                                            class="block p-3 pl-4 text-sm text-gray-700 hover:text-primary">
                                                            {{ app()->getLocale() == 'en' ? $child->name_en : $child->name_np ?? $child->name_en }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</div>
