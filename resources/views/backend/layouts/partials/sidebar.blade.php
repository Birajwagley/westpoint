<!-- Sidebar -->
<aside @mouseenter="sidebarHovered = true" @mouseleave="sidebarHovered = false"
    :class="{
        'w-64': !sidebarCollapsed || sidebarHovered,
        'w-20': sidebarCollapsed && !sidebarHovered,
        'translate-x-0': sidebarOpen,
        '-translate-x-full': !sidebarOpen
    }"
    :style="(sidebarCollapsed && !sidebarHovered) ? 'overflow: visible;' : 'overflow-y: auto;'"
    class="fixed inset-y-0 left-0 z-50 bg-white/10 backdrop-blur-md text-white transition-all duration-300 ease-in-out h-full lg:static flex flex-col">

    <!-- Logo & Controls -->

    <header
        class="flex items-center justify-between p-4 border-b border-white/20 md:bg-white/5 bg-gradient-to-b from-primary/80 to-primary">
        <a href="{{ env('APP_URL') }}">
            <div class="flex items-center space-x-3">
                <img x-show="!sidebarCollapsed || sidebarHovered"
                    src="{{ asset('assets/frontend/images/footer/white-logo.png') }}" alt="avatar"
                    class="h-12 object-contain" />
                <div x-show="!sidebarCollapsed || sidebarHovered" class="text-white font-semibold text-xl">
                    WPHS
                </div>
            </div>
        </a>
        <!-- Sidebar collapse toggle button with white arrow -->
        <button @click="sidebarCollapsed = !sidebarCollapsed"
            class="inline-flex items-center justify-center p-1 m-2 rounded-md text-white hover:text-slate-400 hover:bg-slate-100/20 focus:outline-none focus:ring-2 focus:ring-slate-400 transition max-w-8 max-h-8"
            aria-label="Toggle sidebar collapse" title="Toggle sidebar collapse"
            style="min-width: 32px; min-height: 32px;">
            <template x-if="sidebarCollapsed && !sidebarHovered">
                <!-- Right arrow: > -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <polyline points="9 6 15 12 9 18" />
                </svg>
            </template>
            <template x-if="!sidebarCollapsed || sidebarHovered">
                <!-- Left arrow: < -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <polyline points="15 6 9 12 15 18" />
                </svg>
            </template>
        </button>

        <!-- Mobile close button remains unchanged -->
        <button @click="sidebarOpen = false"
            class="lg:hidden p-1 rounded focus:outline-none focus:ring-2 focus:ring-slate-400 text-white hover:text-slate-400"
            aria-lab Gel="Close sidebar menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </header>


    <!-- Navigation -->
    <nav class="flex-1 px-2 py-3 overflow-y-auto border-r border-white/20  bg-primary" aria-label="Sidebar navigation">
        <!-- General Reports -->

        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('dashboard') ? 'bg-white/20 text-slate-400' : '' }}"
                    :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                    <i class="fa fa-desktop"></i>

                    <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Dashboard</span>
                </a>
            </li>
        </ul>

        @can('founder and principal')
            <ul class="space-y-2 mt-2">
                <li>
                    <a href="{{ route('message-from.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('message-from.*') ? 'bg-white/20 text-slate-400' : '' }}"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <i class="fa fa-users-viewfinder"></i>

                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Founder and
                            Principal</span>
                    </a>
                </li>
            </ul>
        @endcan

        <!-- navigation -->
        @php
            $isAuthSection =
                request()->routeIs('menu.*') ||
                request()->routeIs('page.*') ||
                request()->routeIs('drawer-navigation.*');
        @endphp

        @canany(['menu', 'page', 'drawer navigation'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-bars"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Navigation</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @can('menu')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('menu.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('menu.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-ellipsis"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Menu</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan

                        @can('page')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('page.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('page.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-regular fa-file"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Page</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan

                        @can('drawer navigation')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('drawer-navigation.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('drawer-navigation.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-ellipsis-vertical"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Drawer</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </div>
                </li>
            </ul>
        @endcanany

        {{-- teams --}}
        @php
            $isAuthSection =
                request()->routeIs('department.*') ||
                request()->routeIs('designation.*') ||
                request()->routeIs('team.*');
        @endphp

        @canany(['department', 'designation', 'teams'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-users-gear"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Teams</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['department'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('department.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('department.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-users-between-lines"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Department</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['designation'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('designation.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('designation.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-users-gear"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Designation</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['teams'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('team.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('team.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-user-group"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Team</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                    </div>
                </li>
            </ul>
        @endcanany

        {{-- Academic Structure --}}
        @php
            $isAuthSection =
                request()->routeIs('group.*') ||
                request()->routeIs('subject.*') ||
                request()->routeIs('classes.*') ||
                request()->routeIs('academic-level.*') ||
                request()->routeIs('faculty.*');
        @endphp

        @canany(['group', 'classes', 'academic level', 'faculty'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-people-roof"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Academic
                                Structure</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['group'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('group.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('group.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-layer-group"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Group</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['subject'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('subject.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('subject.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-book"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Subject</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['classes'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('classes.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('classes.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-people-roof"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Classes</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['academic level'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('academic-level.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('academic-level.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-bars-staggered"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Academic
                                            Level</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['faculty'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('faculty.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('faculty.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-id-badge"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Faculty</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                    </div>
                </li>
            </ul>
        @endcanany

        {{-- marketing contents --}}
        @php
            $isAuthSection =
                request()->routeIs('slider.*') ||
                request()->routeIs('popup.*') ||
                request()->routeIs('award-recognition.*') ||
                request()->routeIs('beyond-academic.*') ||
                request()->routeIs('alumni.*') ||
                request()->routeIs('gallery.*') ||
                request()->routeIs('volunteer.*') ||
                request()->routeIs('about us.*') ||
                request()->routeIs('link.*');
        @endphp

        @canany(['slider', 'award & recognition', 'beyond-academic', 'gallery', 'link'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-table-list"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Content</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['slider'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('slider.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('slider.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-panorama"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Slider</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                        @canany(['popup'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('popup.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('popup.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-panorama"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Popup</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['award & achivements'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('award-recognition.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('award-recognition.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-trophy"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Award/
                                            Achivements</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['beyond academic'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('beyond-academic.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('beyond-academic.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-cubes-stacked"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Beyond
                                            Academic</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['gallery'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('gallery.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('gallery.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-images"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Gallery</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['link'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('link.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('link.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-link"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Link</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['statistics'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('statistic.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                                            hover:bg-white/10 text-white
                                            {{ request()->routeIs('statistics.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-chart-simple"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Statistics</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['alumni'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('alumni.edit') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('alumni.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa-solid fa-graduation-cap"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Alumni</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['volunteer'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('volunteer.edit') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('volunteer.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-envelope"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Volunteer</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @can('about us')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('aboutus.edit') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('aboutus.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa-solid fa-info"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">About
                                            Us</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </div>
                </li>
            </ul>
        @endcanany

        {{-- publication --}}
        @php
            $isAuthSection = request()->routeIs('publication.*') || request()->routeIs('publication-category.*');
        @endphp

        @canany(['publication', 'publication category'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-envelope"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Publication</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['publication'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('publication.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('publication.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-envelope"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Publication</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['publication category'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('publication-category.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('publication-category.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-envelopes-bulk"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Publication
                                            Category</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                    </div>
                </li>
            </ul>
        @endcanany

        <!-- download -->
        @php
            $isAuthSection = request()->routeIs('download.*') || request()->routeIs('download-category.*');
        @endphp

        @canany(['download', 'download category'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-download"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Download</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['download category'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('download-category.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('download-category.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-list-check"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Download
                                            Category</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['download'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('download.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('download.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-download"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Download</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                    </div>
                </li>
            </ul>
        @endcanany

        <!-- faq -->
        @php
            $isAuthSection = request()->routeIs('faq.*') || request()->routeIs('faq-category.*');
        @endphp

        @canany(['faq', 'faq category'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa-solid fa-circle-question"></i>
                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Faq</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['faq category'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('faq-category.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('faq-category.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-list-check"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Faq
                                            Category</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['faq'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('faq.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('faq.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-circle-question"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Faq</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                    </div>
                </li>
            </ul>
        @endcanany


        <!-- applications -->
        @php
            $isAuthSection =
                request()->routeIs('admission.*') ||
                request()->routeIs('career.*') ||
                request()->routeIs('job-application.*') ||
                request()->routeIs('alumni-form.*') ||
                request()->routeIs('volunteer-form.*');
        @endphp

        @canany(['admission', 'career', 'job application', 'volunteer-form'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-folder-open"></i>

                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Applications</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @canany(['admission'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('admission.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('admission.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-briefcase"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Admission</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany
                        @canany(['careers'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('career.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('career.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-briefcase"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Career</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['job application'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('job-application.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('job-application.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-list-ul"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Job
                                            Application</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['volunteer form'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('volunteer-form.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('volunteer-form.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-envelope"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Volunteer
                                            Form</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @canany(['alumni form'])
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('alumni-form.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('alumni-form.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Alumni
                                            Form</span>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                    </div>
                </li>
            </ul>
        @endcanany

        @canany(['contact us'])
            <ul class="space-y-2 mt-2">
                <li>
                    <a href="{{ route('contact-us.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('contact-us.*') ? 'bg-white/20 text-slate-400' : '' }}"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <i class="fa fa-address-book"></i>

                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Contact Us</span>
                    </a>
                </li>
            </ul>
        @endcanany

        @canany(['testimonial'])
            <ul class="space-y-2 mt-2">
                <li>
                    <a href="{{ route('testimonial.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('testimonial.*') ? 'bg-white/20 text-slate-400' : '' }}"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <i class="fa-regular fa-comments"></i>

                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Testimonial</span>
                    </a>
                </li>
            </ul>
        @endcanany

        @canany(['subscription'])
            <ul class="space-y-2 mt-2">
                <li>
                    <a href="{{ route('subscription.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('subscription.*') ? 'bg-white/20 text-slate-400' : '' }}"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <i class="fa-solid fa-envelope-open-text"></i>

                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Subscription</span>
                    </a>
                </li>
            </ul>
        @endcanany

        <!-- Authentication -->
        @php
            $isAuthSection =
                request()->routeIs('user.*') || request()->routeIs('role.*') || request()->routeIs('permission.*');
        @endphp

        @canany(['user', 'role', 'permission'])
            <ul class="space-y-2 mt-2" x-data="{ authMenuOpen: {{ $isAuthSection ? 'true' : 'false' }} }">
                <li>
                    <button @click="authMenuOpen = !authMenuOpen"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <span class="flex items-center gap-3"
                            :class="{ 'justify-center w-full': sidebarCollapsed && !sidebarHovered }">
                            <i class="fa fa-users"></i>

                            <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">User
                                Management</span>
                        </span>
                        <svg x-show="!sidebarCollapsed || sidebarHovered" :class="{ 'rotate-180': authMenuOpen }"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="authMenuOpen" x-collapse class="pl-4 mt-2 space-y-2 text-sm text-slate-100">
                        @can('user')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('user.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('user.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-user"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Users</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan

                        @can('role')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('role.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('role.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-user-check"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Role</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan

                        @can('permission')
                            <ul class="space-y-2 mt-2">
                                <li>
                                    <a href="{{ route('permission.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors hover:bg-white/10 text-white {{ request()->routeIs('permission.*') ? 'bg-white/20 text-slate-400' : '' }}"
                                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                                        <i class="fa fa-user-lock"></i>

                                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Permission</span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </div>
                </li>
            </ul>
        @endcanany

        @canany(['setting'])
            <ul class="space-y-2 mt-2">
                <li>
                    <a href="{{ route('setting.edit') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors
                            hover:bg-white/10 text-white
                            {{ request()->routeIs('setting.*') ? 'bg-white/20 text-slate-400' : '' }}"
                        :class="{ 'justify-center': sidebarCollapsed && !sidebarHovered }">
                        <i class="fa fa-cogs"></i>

                        <span x-show="!sidebarCollapsed || sidebarHovered" class="truncate">Setting</span>
                    </a>
                </li>
            </ul>
        @endcanany
    </nav>
</aside>
