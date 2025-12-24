<div
    class="group relative flex flex-col items-center text-center p-6 rounded-3xl bg-white/80 backdrop-blur-md border border-gray-200 shadow-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl max-w-xs w-full">

    <div class="text-primary font-bold mb-2">
        {{ app()->getLocale() == 'en'
            ? $team->designation->name_en ?? ''
            : $team->designation->name_np ?? ($team->designation->name_en ?? '') }}
    </div>

    <div
        class="relative w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 rounded-full overflow-hidden border-4 border-primary shadow-lg">
        <img src="{{ $team->image && file_exists(public_path($team->image))
            ? asset($team->image)
            : asset('assets/frontend/images/default-avatar.png') }}"
            alt="{{ $team->name_en }}" class="w-full h-full object-cover">

        <!-- Social Icons (only if available) -->
        @if ($team->facebook || $team->linked_in)
            <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 flex space-x-3 opacity-0 group-hover:opacity-100 transition duration-300">
                @if ($team->facebook)
                    <a href="{{ $team->facebook }}" target="_blank"
                        class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center shadow">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                @endif
                @if ($team->linked_in)
                    <a href="{{ $team->linked_in }}" target="_blank"
                        class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center shadow">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                @endif
            </div>
        @endif
    </div>

    <div class="mt-6">
        <h4 class="font-semibold text-primary text-lg">
            {{ app()->getLocale() == 'en' ? $team->name_en ?? '' : $team->name_np ?? ($team->name_en ?? '') }}
        </h4>
        <p class="text-sm text-primary">
            {{ app()->getLocale() == 'en'
                ? $team->department->name_en ?? ''
                : $team->department->name_np ?? ($team->department->name_en ?? '') }}
        </p>
    </div>
</div>
