@props(['wrapperId', 'componentName'])

<button type="button"
  class="inline-flex items-center gap-1 sm:gap-1.5 md:gap-2 px-2 py-2
                rounded-lg shadow-sm
                font-semibold text-blue-700
                border border-blue-700
                hover:bg-blue-700 hover:text-white
                focus:outline-none focus:ring-2 focus:ring-blue-400 mt-2"
            aria-label="Add"

    onclick="addMore('{{ $wrapperId }}', '{{ $componentName }}')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
    </svg>
</button>

@push('scripts')
<script>
    function addMore(wrapperId, componentName) {
        let wrapper = document.getElementById(wrapperId);

        // Use Blade's "include" trick via template string
        let index = wrapper.children.length;

        // Fetch the component HTML using a hidden template
        let template = document.getElementById(componentName + '-template').innerHTML;

        // Replace placeholder index
        template = template.replace(/__INDEX__/g, index);

        wrapper.insertAdjacentHTML('beforeend', template);

        // Initialize any select2 or other JS if needed
        $('.select-single, .select-multi').select2({
            theme: 'tailwindcss-3',
        });
    }
</script>
@endpush
