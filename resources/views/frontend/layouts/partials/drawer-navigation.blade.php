@php
    use App\Enum\DrawerNavigationType;
@endphp

<div class="fixed right-0 top-1/2 -translate-y-1/2 z-50 hidden md:block">
    <ul class="space-y-2">
        @foreach ($drawerNavigations as $drawerNavigation)
            <li class="relative h-12 w-12 lg:h-16 lg:w-16 overflow-visible">
                <a href="{{ $drawerNavigation->type == DrawerNavigationType::MENU->value ? route($drawerNavigation->menu->slug) : ($drawerNavigation->type == DrawerNavigationType::EXTERNALLINK->value ? $drawerNavigation->value : 'tel:' . $drawerNavigation->value) }}"
                    class="group absolute right-0 top-0
                    h-12 w-12 lg:h-16 lg:w-16
                    bg-secondary shadow text-white rounded-l-xl
                    px-3 lg:px-5
                    flex items-center gap-3
                    overflow-hidden transition-all duration-300
                    hover:w-40 lg:hover:w-52">

                    <i
                        class="{{ $drawerNavigation->icon }}
                        text-2xl lg:text-3xl text-white group-hover:text-accent"></i>

                    <span
                        class="opacity-0 transition-opacity duration-300
                        group-hover:opacity-100 group-hover:text-accent
                        text-sm lg:text-lg whitespace-nowrap">
                        {{ app()->getLocale() == 'en'
                            ? $drawerNavigation->name_en ?? ''
                            : $drawerNavigation->name_np ?? ($drawerNavigation->name_en ?? '') }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="fixed right-0 top-1/2 -translate-y-1/2 z-50 block lg:hidden xl:hidden">
    <button id="drawerToggle" class="group bg-secondary text-white p-3 rounded-l-full shadow focus:outline-none">
        <i class="fa fa-circle-arrow-left text-white fa-xl group-hover:text-accent"></i>
    </button>
</div>

<div id="drawer"
    class="fixed right-0 top-0 h-full w-64 bg-secondary shadow z-50 transform translate-x-full transition-transform duration-300 lg:hidden xl:hidden">

    <!-- Close Button (Optional) -->
    <div class="flex justify-end p-3 sm:hidden">
        <button id="drawerClose" class="text-white text-2xl focus:outline-none"><i
                class="fa fa-times text-white fa-lg hover:text-accent"></i></button>
    </div>

    <!-- Drawer Items -->
    <ul class="mt-10 space-y-3">
        @foreach ($drawerNavigations as $drawerNavigation)
            <li class="h-12 lg:h-16">
                <a href="#"
                    class="flex items-center gap-3 px-5 h-full bg-secondary text-white rounded-l-xl
                            transition-all duration-300 hover:bg-primary/50 hover:text-accent">

                    <i class="{{ $drawerNavigation->icon }} text-2xl lg:text-3xl"></i>

                    <span class="text-base lg:text-lg">
                        {{ app()->getLocale() == 'en'
                            ? $drawerNavigation->name_en ?? ''
                            : $drawerNavigation->name_np ?? ($drawerNavigation->name_en ?? '') }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

@push('scripts')
    <script>
        const drawerToggle = document.getElementById('drawerToggle');
        const drawerClose = document.getElementById('drawerClose');
        const drawer = document.getElementById('drawer');

        // Open drawer
        drawerToggle.addEventListener('click', () => {
            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
        });

        // Close drawer
        drawerClose.addEventListener('click', () => {
            drawer.classList.add('translate-x-full');
            drawer.classList.remove('translate-x-0');
        });

        // Optional: click outside drawer to close
        document.addEventListener('click', (e) => {
            if (!drawer.contains(e.target) && !drawerToggle.contains(e.target)) {
                drawer.classList.add('translate-x-full');
                drawer.classList.remove('translate-x-0');
            }
        });
    </script>
@endpush
