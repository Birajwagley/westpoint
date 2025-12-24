@can($permission)
    <div x-data="{ open: false }" class="relative inline-flex">
        <a href="{{ $route }}"
            class="inline-flex items-center gap-1 sm:gap-1.5 md:gap-2 px-2 py-2
                rounded-lg shadow-sm
                font-semibold text-primary
                border border-primary
                hover:bg-primary hover:text-white
                focus:outline-none focus:ring-2 focus:ring-secondary"
            aria-label="Add">

            <i class="fa fa-plus"></i>

            Add
        </a>
    </div>
@endcan
