<!-- Mobile Top Bar -->
<header
    class="lg:hidden flex items-center justify-between px-4 py-3 bg-white shadow-sm border-b border-gray-200 rounded-md">
    <h1 class="text-lg font-semibold text-gray-800 tracking-tight">
        WPHS
    </h1>

    <button @click="sidebarOpen = !sidebarOpen"
        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        aria-label="Toggle sidebar menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</header>


<!-- Ensure Alpine.js is included -->
<script src="//unpkg.com/alpinejs" defer></script>

<section class="flex flex-wrap items-center justify-between gap-2 px-3 py-2 w-full">
    <!-- Left -->
    <div class="flex items-center gap-2 flex-wrap">
        @yield('headerWithButton')
    </div>

    <!-- Right -->
    <div class="flex items-center gap-2 relative">
        <!-- Fullscreen Button -->
        <button x-data
            @click="document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen()"
            class="w-8 h-8 flex items-center justify-center text-gray-500 rounded-full hover:bg-gray-100"
            title="Fullscreen">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2"
                    d="M8 3H5a2 2 0 00-2 2v3m0 8v3a2 2 0 002 2h3m8-18h3a2 2 0 012 2v3m0 8v3a2 2 0 01-2 2h-3" />
            </svg>
        </button>

        <!-- Avatar Dropdown -->
        <div x-data="{ open: false }" class="relative">
            @php
                $user = auth()->user();
                $thumbnail =
                    $user && $user->thumbnail_image ? asset($user->thumbnail_image) : asset('assets/backend/images/logo.png');
            @endphp

            <img @click="open = !open" @click.away="open = false" src="{{ $thumbnail }}"
                class="w-8 h-8 rounded-full border shadow cursor-pointer" alt="Avatar" />

            <!-- Dropdown -->
            <div x-show="open" x-transition
                class="absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg z-50 text-sm">
                <div class="px-3 py-2 border-b">
                    <p class="font-medium text-gray-800 truncate">{{ $user->name }}</p>
                    <p class="text-gray-500">{{ $user->username }}</p>
                </div>
                <ul class="divide-y text-gray-700">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-3 py-2 hover:bg-gray-50">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2"
                                    d="M5.1 17.8A13.9 13.9 0 0112 15c2.5 0 4.8.7 6.9 1.8M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg> Profile
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex items-center gap-2 px-3 py-2 text-red-600 hover:bg-gray-50">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<hr class="mb-4 h-0.5 rounded-full border-0 bg-gray-200 shadow-inner" />
